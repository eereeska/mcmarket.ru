<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $this->call([
            RolesSeeder::class,
            TagsSeeder::class
        ]);

        for ($i = 0; $i < 100; $i++) {
            DB::table('threads')->insert([
                'author_id' => 1,
                'title' => Str::random(15),
                'body' => Str::random(15000),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
