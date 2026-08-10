<?php

use App\Enums\ServiceEnum;
use App\Models\Admin;
use App\Models\AgeGroup;
use App\Models\AttractionPackage;
use App\Models\AttractionPrice;
use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\Product;
use App\Services\Admin\Checkout\Attraction\AttractionCheckoutService;

beforeEach(function () {
    $this->admin = Admin::create([
        'name' => 'Admin',
        'email' => 'admin@test.com',
        'password' => bcrypt('password'),
    ]);
});

describe('checkout', function () {
    it('calculates totals and quantity correctly for attraction checkout', function () {
        $country = Country::create([
            'name' => 'Egypt',
            'slug' => 'egypt',
            'dial_code' => '+20',
        ]);

        $city = City::create([
            'country_id' => $country->id,
            'name' => 'Cairo',
            'slug' => 'cairo',
        ]);

        $category = Category::create([
            'name' => 'Adventure',
            'slug' => 'adventure',
        ]);

        $adultAgeGroup = AgeGroup::create([
            'name' => 'Adult',
            'min_age' => 18,
            'max_age' => 65,
        ]);

        $attraction = Product::create([
            'name' => 'Attraction for Checkout',
            'slug' => 'attraction-for-checkout',
            'service' => ServiceEnum::ATTRACTION->value,
            'search_keywords' => 'checkout',
            'star_rating' => 4,
            'price' => 50,
            'is_active' => true,
        ]);

        $attraction->detail()->create([
            'what_to_expect' => 'Expectation',
        ]);

        $attraction->schedule()->create([
            'start_date' => now()->subMonth()->format('Y-m-d'),
            'end_date' => now()->addYear()->format('Y-m-d'),
            'closing_type' => null,
            'closing_dates' => [],
            'closing_days' => [],
        ]);

        $attraction->countries()->sync([$country->id]);
        $attraction->cities()->sync([$city->id]);
        $attraction->categories()->sync([$category->id]);

        $package = AttractionPackage::create([
            'product_id' => $attraction->id,
            'name' => 'Standard Package',
            'description' => 'Package description',
        ]);

        $price1 = AttractionPrice::create([
            'attraction_package_id' => $package->id,
            'age_group_id' => $adultAgeGroup->id,
            'price' => 50,
        ]);

        $response = $this->actingAs($this->admin, 'sanctum')
            ->postJson('/admin/checkout', [
                'products' => [
                    [
                        'service' => ServiceEnum::ATTRACTION->value,
                        'product_id' => $attraction->id,
                        'package_id' => $package->id,
                        'date' => now()->addDays(5)->format('Y-m-d'),
                        'quantities' => [
                            [
                                'id' => $price1->id,
                                'quantity' => 3,
                            ],
                        ],
                    ],
                ],
            ]);

        $response->assertSuccessful();

        $checkoutData = $response->json('data.data.0');
        expect($checkoutData['prices'][0]['quantity'])->toBe(3)
            ->and($checkoutData['prices'][0]['total'])->toBe(150);
    });

    it('handles stdClass objects in quantities array', function () {
        $country = Country::create([
            'name' => 'Egypt',
            'slug' => 'egypt',
            'dial_code' => '+20',
        ]);

        $city = City::create([
            'country_id' => $country->id,
            'name' => 'Cairo',
            'slug' => 'cairo',
        ]);

        $category = Category::create([
            'name' => 'Adventure',
            'slug' => 'adventure',
        ]);

        $adultAgeGroup = AgeGroup::create([
            'name' => 'Adult',
            'min_age' => 18,
            'max_age' => 65,
        ]);

        $attraction = Product::create([
            'name' => 'Attraction for Checkout 2',
            'slug' => 'attraction-for-checkout-2',
            'service' => ServiceEnum::ATTRACTION->value,
            'search_keywords' => 'checkout',
            'star_rating' => 4,
            'price' => 50,
            'is_active' => true,
        ]);

        $attraction->detail()->create([
            'what_to_expect' => 'Expectation',
        ]);

        $attraction->schedule()->create([
            'start_date' => now()->subMonth()->format('Y-m-d'),
            'end_date' => now()->addYear()->format('Y-m-d'),
            'closing_type' => null,
            'closing_dates' => [],
            'closing_days' => [],
        ]);

        $attraction->countries()->sync([$country->id]);
        $attraction->cities()->sync([$city->id]);
        $attraction->categories()->sync([$category->id]);

        $package = AttractionPackage::create([
            'product_id' => $attraction->id,
            'name' => 'Standard Package',
            'description' => 'Package description',
        ]);

        $price1 = AttractionPrice::create([
            'attraction_package_id' => $package->id,
            'age_group_id' => $adultAgeGroup->id,
            'price' => 50,
        ]);

        // Call AttractionCheckoutService directly passing stdClass objects in quantities array
        $service = new AttractionCheckoutService;
        $result = $service->handle([
            'service' => ServiceEnum::ATTRACTION->value,
            'product_id' => $attraction->id,
            'package_id' => $package->id,
            'date' => now()->addDays(5)->format('Y-m-d'),
            'quantities' => [
                (object) [
                    'id' => $price1->id,
                    'quantity' => 4,
                ],
            ],
        ]);

        expect($result['prices'][0]['quantity'])->toBe(4)
            ->and($result['prices'][0]['total'])->toBe(200.0);
    });
});
