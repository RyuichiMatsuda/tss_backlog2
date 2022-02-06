<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

// #シーダー：
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    // #シーダー：ユーザー
    public function run()
    {
        $names = ['サンプルユーザー'];
        $emails = ['c@t'];
        $pass="$2y$10$/DH73IkMU07UmNl35wzxdOlRhvLBMn4jzr2e30NKreiX/PXw1GLPy";

        for ($i=0 ; $i<count($names) ; $i++) {
            DB::table('users')->insert([
                'name' => $names[$i],
                'email' => $emails[$i],
                'password' => $pass,
            ]);
        }
     }

     
}
