<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    public function run()
    {
        DB::table('roles')->insert([
            [
                'name' => 'member',
                'title' => 'Участник'
            ],
            [
                'name' => 'moderator',
                'title' => 'Модератор'
            ],
            [
                'name' => 'admin',
                'title' => 'Администратор'
            ]
        ]);
    }
}