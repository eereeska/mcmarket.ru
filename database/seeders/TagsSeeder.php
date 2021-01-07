<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagsSeeder extends Seeder
{
    public function run()
    {
        DB::table('tags')->insert([
            [
                'name' => 'discussions',
                'title' => 'Обсуждения'
            ],
            [
                'name' => 'ideas',
                'title' => 'Идеи'
            ],
            [
                'name' => 'plugins',
                'title' => 'Плагины'
            ],
            [
                'name' => 'graphics',
                'title' => 'Графика'
            ],
            [
                'name' => 'building',
                'title' => 'Строительство'
            ],
            [
                'name' => 'accounts',
                'title' => 'Аккаунты'
            ],
            [
                'name' => 'news',
                'title' => 'Новости'
            ],
            [
                'name' => 'giveaways',
                'title' => 'Розыгрыши'
            ],
            [
                'name' => 'buying',
                'title' => 'Покупка'
            ],
            [
                'name' => 'selling',
                'title' => 'Продажа'
            ]
        ]);
    }
}