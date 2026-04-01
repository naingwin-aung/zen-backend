<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Country;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Seeding cities from worldcities.csv...');

        $file = database_path('seeders/worldcities.csv');

        if (! file_exists($file)) {
            $this->command->error("File not found: {$file}");

            return;
        }

        $handle = fopen($file, 'r');
        $header = fgetcsv($handle);

        $batch = [];
        $batchSize = 1000;

        while (($row = fgetcsv($handle)) !== false) {
            $data = array_combine($header, $row);

            $country = Country::where('name', $data['country'])->first();

            if (! $country) {
                Log::info("Country not found for city: {$data['city']} (Country: {$data['country']})");

                continue;
            }

            $batch[] = [
                'name' => $data['city'],
                'slug' => Str::slug($data['city']),
                'country_id' => $country->id,
                'created_at' => now(),
                'updated_at' => now(),
            ];

            if (count($batch) >= $batchSize) {
                City::insertOrIgnore($batch);
                $batch = [];
            }
        }

        if (! empty($batch)) {
            City::insertOrIgnore($batch);
        }

        fclose($handle);

        City::query()->update(['slug' => DB::raw("CONCAT('c', id, '-', slug)")]);

        $this->command->info('Cities seeded successfully!');
    }
}
