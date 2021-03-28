<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        DB::table('roles')->insert([
            [
                'name' => 'member',
                'title' => 'Участник',
                'can_access_acp' => false,
                'can_submit_new_files' => false,
                'can_approve_files' => false
            ],
            [
                'name' => 'moderator',
                'title' => 'Модератор',
                'can_access_acp' => false,
                'can_submit_new_files' => false,
                'can_approve_files' => false
            ],
            [
                'name' => 'admin',
                'title' => 'Администратор',
                'can_access_acp' => true,
                'can_submit_new_files' => true,
                'can_approve_files' => true
            ]
        ]);

        DB::table('file_categories')->insert([
            [
                'name' => 'plugins',
                'title' => 'Плагины',
                'icon' => 'plugin'
            ],
            [
                'name' => 'premade-servers',
                'title' => 'Сборки серверов',
                'icon' => 'server'
            ],
            [
                'name' => 'resourcepacks',
                'title' => 'Ресурспаки',
                'icon' => 'eye'
            ],
            [
                'name' => 'datapacks',
                'title' => 'Датапаки',
                'icon' => 'sliders-h'
            ],
            [
                'name' => 'hacked-clients',
                'title' => 'Чит-клиенты',
                'icon' => 'skull'
            ],
            [
                'name' => 'maps',
                'title' => 'Карты',
                'icon' => 'map'
            ],
            [
                'name' => 'web',
                'title' => 'Веб',
                'icon' => 'web'
            ],
            [
                'name' => 'soft',
                'title' => 'Софт',
                'icon' => 'desktop'
            ]
        ]);
    }
}