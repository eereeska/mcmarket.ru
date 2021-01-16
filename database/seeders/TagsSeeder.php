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
                'title' => 'Обсуждения',
                'icon' => 'comments'
            ],
            [
                'name' => 'ideas',
                'title' => 'Идеи',
                'icon' => 'idea'
            ],
            [
                'name' => 'plugins',
                'title' => 'Плагины',
                'icon' => 'plugin'
            ],
            [
                'name' => 'graphics',
                'title' => 'Графика',
                'icon' => 'graphic'
            ],
            [
                'name' => 'building',
                'title' => 'Строительство',
                'icon' => 'building'
            ],
            [
                'name' => 'accounts',
                'title' => 'Аккаунты',
                'icon' => 'users'
            ],
            [
                'name' => 'news',
                'title' => 'Новости',
                'icon' => 'news'
            ],
            [
                'name' => 'giveaways',
                'title' => 'Розыгрыши',
                'icon' => 'gift'
            ],
            [
                'name' => 'buying',
                'title' => 'Покупка',
                'icon' => 'arrow-down'
            ],
            [
                'name' => 'selling',
                'title' => 'Продажа',
                'icon' => 'arrow-up'
            ]
        ]);
    }
}