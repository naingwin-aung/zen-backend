<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run() : void
    {
        $filePath = database_path('seeders/countries.json');

        if (! file_exists($filePath)) {
            $this->command->error("File not found: {$filePath}");
            return;
        }

        $countries = json_decode(file_get_contents($filePath), true);

        if (null === $countries) {
            $this->command->error('Invalid JSON in countries.json');
            return;
        }

        foreach ($countries as $country) {
            $country = Country::updateOrCreate([
                'name'     => $country['name'],
            ], [
                'dial_code' => $country['dial_code'],
            ]);

            $country->slug = 'co' . $country->id . '-' . Str::slug($country->name);
            $country->update();
        }
    }
}
