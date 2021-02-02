<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FileCategoriesSeeder extends Seeder
{
    public function run()
    {
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