<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Auth\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        \App\Models\User::factory()->create([
            'name'  => 'admin',
            'email' => 'admin@mail.com',
            'password' => bcrypt('123456')
        ]);

        \App\Models\Team::factory()->create([
            'name' => 'admin'.'\'s Team',
            'user_id' => 1,
            'personal_team' => true,
        ]);

        // \App\Models\Team::factory(10)->create();
        // \App\Models\User::factory(10)->create();
        \App\Models\Note::factory(30)->create();
    }
}
