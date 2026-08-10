<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\AgeGroup;
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
                'first_name' => 'naing win',
                'last_name' => 'aung',
                'title' => 'Mr',
                'password' => bcrypt('password'),
                'country_id' => 116,
                'dial_id' => 116,
                'phone_number' => '09777777777',
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
            ['name->en' => 'Activities'],
            [
                'name' => [
                    'en' => 'Activities',
                    'mm' => 'လှုပ်ရှားမှုများ',
                ],
                'slug' => '1-activities',
            ]
        );

        AgeGroup::updateOrCreate(
            ['name->en' => 'Adult'],
            [
                'name' => [
                    'en' => 'Adult',
                    'mm' => 'လူကြီး',
                ],
                'min_age' => 12,
            ]
        );

        AgeGroup::updateOrCreate(
            ['name->en' => 'Child'],
            [
                'name' => [
                    'en' => 'Child',
                    'mm' => 'ကလေး',
                ],
                'min_age' => 2,
                'max_age' => 11,
            ]
        );

        $this->call([
            LanguageSeeder::class,
            CountrySeeder::class,
            CitySeeder::class,
            SupplierSeeder::class,
            ProductSeeder::class,
        ]);
    }
}
