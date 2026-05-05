<?php

namespace Database\Factories;

use App\Enums\ServiceEnum;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->words(3, true);

        return [
            'name' => ucwords($name),
            'slug' => Str::slug($name),
            'service' => ServiceEnum::ATTRACTION->value,
            'search_keywords' => $this->faker->words(5, true),
            'star_rating' => $this->faker->randomFloat(1, 3.0, 5.0),
        ];
    }
}
