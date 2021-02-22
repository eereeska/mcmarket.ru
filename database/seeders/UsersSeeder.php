<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    public function run()
    {
        for ($i = 0; $i < 500; $i++) {
            DB::table('users')->insert([
                'name' => Str::random(10),
                'password' => Str::random(10),
                'ip' => Str::random(10)
            ]);
        }
    }
}