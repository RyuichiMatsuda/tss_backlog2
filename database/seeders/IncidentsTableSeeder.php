<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

// #シーダー：
use Illuminate\Support\Facades\DB;

class IncidentsTableSeeder extends Seeder
{
    // #シーダー：インシデント
    public function run()
    {
        $titles = ['田中一郎','山田武史','小林博士','真壁正雄'];
        $bodies = ['スロープの手すりが壊れました。','トイレが故障しました。',
                    '雨漏りがしています。','換気扇から異音がする。',];

        for ($i=0 ; $i<count($titles) ; $i++) {
            DB::table('incidents')->insert([
                'title' => $titles[$i],
                'body' => $bodies[$i],
                'user_id' => 1,
                'status_id' => 0,
            ]);
        }
     }

     
}
