<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Manual extends Model
{
    use HasFactory;

    // #マニュアル：ソフトデリート
    use SoftDeletes;

    // #マニュアル：ホワイトリストを使用した保存
    protected $fillable = ['title', 'body',
                            'image_file_name','video_url'];


    // #マニュアル：メソッド：文字数制限
    public function strlength() {
        $str = $this->body;
        $limit = 20;

        if (mb_strlen($str) > $limit ) {
            $str = mb_substr($str, 0, $limit);
            return $str . "...";
        } else {
            return $str;
        }
    }

}
