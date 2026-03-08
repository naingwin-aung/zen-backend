<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory()->create([
        //     'name' => 'zen',
        //     'email' => 'zen@gmail.com',
        //     'password' => bcrypt('password'),
        // ]);

        $this->call([
            CountrySeeder::class,
        ]);
    }
}
