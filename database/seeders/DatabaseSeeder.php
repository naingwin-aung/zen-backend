<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Category;
use App\Models\User;
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
        User::updateOrCreate(
            ['email' => 'naingwinaung1710@gmail.com'],
            [
                'name' => 'naing win aung',
                'password' => bcrypt('password'),
            ]
        );

        Admin::updateOrCreate(
            ['email' => 'zen.admin@gmail.com'],
            [
                'name' => 'Admin',
                'password' => bcrypt('password'),
            ]
        );

        Category::updateOrCreate(
            ['name' => 'Cruises'],
            [
                'slug' => '1-cruises',
            ]
        );

        $this->call([
            CountrySeeder::class,
            CitySeeder::class,
        ]);
    }
}
