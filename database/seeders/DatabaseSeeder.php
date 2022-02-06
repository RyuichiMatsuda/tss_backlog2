<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

// #シーダー：
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{


    public function run()
    {
        $this->call([
            // #シーダー：ユーザー
            UsersTableSeeder::class,
            IncidentsTableSeeder::class,
            ThreadsTableSeeder::class,
        ]);
    }
}
