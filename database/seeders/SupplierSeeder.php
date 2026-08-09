<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /** @var array<int, array<string, string>> $suppliers */
        $suppliers = [
            [
                'name' => 'Zen Travel',
                'email' => 'supplier.zen@gmail.com',
            ],
            [
                'name' => 'Asia Attractions',
                'email' => 'supplier.asia@gmail.com',
            ],
            [
                'name' => 'Global Ticketing',
                'email' => 'supplier.global@gmail.com',
            ],
        ];

        foreach ($suppliers as $supplier) {
            Supplier::updateOrCreate(
                ['email' => $supplier['email']],
                [
                    'name' => $supplier['name'],
                    'password' => bcrypt('password'),
                ]
            );
        }
    }
}
