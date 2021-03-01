<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class FakeUserSeeder extends Seeder
{
    public function run()
    {
        User::factory()->count(100)->create();
    }
}