<?php

namespace App\Http\Controllers;

use App\Models\Manual;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
// #マニュアル：画像保存
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ManualController extends Controller
{
    // #マニュアル：ユーザー認証 
    public function __construct() {

        $this->middleware('auth');

    }

    public function index()
    {
        $manuals = Manual::select()->latest()->paginate(12);

        return view('manuals.index', compact('manuals'));
    }

    public function detail($id)
    {
        $manual = Manual::find($id);

        return view('manuals.detail', compact('manual'));
    }

    public function new()
    {
        return view('manuals.new');
    }

    public function store(Request $request)
    {   
        // #マニュアル：バリデーション
        // $this->validator($request);

        // #マニュアル：ホワイトリストを使用した保存
        $manual = new Manual($request->all());

        // #マニュアル：画像保存
        if($request->has('image_file')){
            $image_path = $this->saveImage($request->file('image_file')); 
            $manual->image_file_name = $image_path;
        }

        // #マニュアル：動画：保存
        if($request->has('video_file')){
            $video_url = $this->saveVideo($request->file('video_file')); 
            $manual->video_url = $video_url;
        }

        $manual->save();

        return redirect()->route('manuals.detail', ['id' => $manual->id]);
    }

    public function destroy(Request $request)
    {   
        $manual = Manual::find($request->id);
        $manual->delete();

        // return view('incidents.detail', compact('incident'));
        return redirect()->route('manuals.index');
    }

    // #マニュアル：動画：配信
    public function stream(Request $request) {

        $path = storage_path('app/public/manuals/video/test.mp4');

        $file_size = filesize($path);
        $fp = fopen($path, 'rb');
        $status_code = 200;
        $headers = [
            'Content-type' => 'video/mp4',
            'Accept-Ranges' => 'bytes',
            'Content-Length' => $file_size
        ];
    
        $range = $request->header('Range');
    
        if(!is_null($range)) {
    
            if(preg_match('|bytes=([0-9]+)\-|', $range, $matches)) {
    
                $start = intval($matches[1]);
    
                if(fseek($fp, $start) === 0) {
    
                    $status_code = 206;
                    $headers['Content-Length'] = $file_size - $start;
                    $headers['Content-Range'] = sprintf(
                        'bytes %d-%d/%d',
                        $start,
                        ($file_size-1),
                        $file_size
                    );
    
                }
    
            }
    
        }
    
        return response()->stream(function() use($fp) {
    
            fpassthru($fp);
    
        }, $status_code, $headers);
    
    }


    // #マニュアル：画像保存
    private function saveImage(UploadedFile $file): string
    {
        // 画像名の作成
        $tmp_fp = tmpfile();
        $meta   = stream_get_meta_data($tmp_fp);
        $tempPath = $meta["uri"];

        Image::make($file)->save($tempPath);
        //fitのチェーンを追加して、画像のサイズを変更できる。
        //Image::make($file)->fit(300, 300)->save($tempPath);

        // storagelinkで紐付けたpublic配下のmanualsフォルダに保存
        $filePath = Storage::disk('public')
            ->putFile('manuals', new File($tempPath));

        return basename($filePath);
    }


    // #マニュアル：動画：保存
    private function saveVideo(UploadedFile $file): string
    {
        // 画像名の作成
        $tmp_fp = tmpfile();
        $meta   = stream_get_meta_data($tmp_fp);
        $tempPath = $meta["uri"];

        $file->storeAs('public/manuals/video',$tempPath.".mp4");
        //fitのチェーンを追加して、画像のサイズを変更できる。
        //Image::make($file)->fit(300, 300)->save($tempPath);

        // storagelinkで紐付けたpublic配下のmanualsフォルダに保存
        $filePath = Storage::disk('public')
            ->putFile('manuals', new File($tempPath));

        return $tempPath.".mp4";
    }

    // #マニュアル：バリデーション
    public function validator(Request $request) {
        $request->validate([
            'title' => ['required', 'between:1,70'],
            'body' => ['required','min:87','max:50000'],

            // #マニュアル：画像保存
            'image_file_name' => ['file','mimes:jpeg,png,jpg,bmb','max:2048'],
        ],[

            //　以下はカスタムメッセージ
            'title.between' => 'タイトルは、70文字までです',
            'body.max' => '本文は、5000文字までです',
            'body.min' => '本文は必須です。',
        ]);
    }

}
