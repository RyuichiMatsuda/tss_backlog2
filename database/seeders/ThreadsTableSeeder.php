<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

// #シーダー：
use Illuminate\Support\Facades\DB;

class ThreadsTableSeeder extends Seeder
{
    // #シーダー：ユーザー
    public function run()
    {
        // $titles = ['田中一郎','山田武史','小林博士','真壁正雄'];
        $bodies = ['クレームに勘違いがありました。','キッチンが故障していました。',
                    '作業に取り掛かっています。','作業が完了しました。',];

        for ($i=0 ; $i<count($bodies) ; $i++) {
            DB::table('threads')->insert([

                'body' => $bodies[$i],
                'incident_id' => 1,
                'status_id' => 0,
            ]);
        }
     }

     
}
