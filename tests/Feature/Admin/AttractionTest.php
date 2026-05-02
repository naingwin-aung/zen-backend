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

beforeEach(function () {
    $this->admin = Admin::create([
        'name' => 'Admin',
        'email' => 'admin@test.com',
        'password' => bcrypt('password'),
    ]);
});

describe('update', function () {
    it('updates attraction when payload contains new package without id', function () {
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

        $childAgeGroup = AgeGroup::create([
            'name' => 'Child',
            'min_age' => 5,
            'max_age' => 17,
        ]);

        $attraction = Product::create([
            'name' => 'Old Attraction',
            'slug' => '1-old-attraction',
            'service' => ServiceEnum::ATTRACTION->value,
            'search_keywords' => 'oldattraction, old',
            'star_rating' => 3,
        ]);

        $attraction->detail()->create([
            'what_to_expect' => 'Old expectation',
        ]);

        $attraction->schedule()->create([
            'start_date' => '2026-04-01',
            'end_date' => '2026-05-01',
            'closing_type' => null,
            'closing_dates' => [],
            'closing_days' => [],
        ]);

        $attraction->countries()->sync([$country->id]);
        $attraction->cities()->sync([$city->id]);
        $attraction->categories()->sync([$category->id]);

        $existingPackage = AttractionPackage::create([
            'product_id' => $attraction->id,
            'name' => 'Standard Package',
            'description' => 'Old package',
        ]);

        $existingPrice = AttractionPrice::create([
            'attraction_package_id' => $existingPackage->id,
            'age_group_id' => $adultAgeGroup->id,
            'price' => 50,
        ]);

        $response = $this->actingAs($this->admin, 'sanctum')
            ->putJson('/admin/attractions/'.$attraction->id, [
                'name' => 'Updated Attraction',
                'star_rating' => 4,
                'countries' => [$country->id],
                'cities' => [$city->id],
                'categories' => [$category->id],
                'search_keywords' => 'updated attraction',
                'what_to_expect' => 'Updated expectation',
                'good_to_know' => 'Bring water',
                'highlights' => 'Sunset view',
                'start_date' => '2026-04-10',
                'end_date' => '2026-05-10',
                'packages' => [
                    [
                        'id' => $existingPackage->id,
                        'name' => 'Standard Package Updated',
                        'description' => 'Updated package',
                        'prices' => [
                            [
                                'id' => $existingPrice->id,
                                'age_group_id' => $adultAgeGroup->id,
                                'price' => 60,
                            ],
                        ],
                    ],
                    [
                        'name' => 'Family Package',
                        'description' => 'No id package',
                        'prices' => [
                            [
                                'age_group_id' => $childAgeGroup->id,
                                'price' => 30,
                            ],
                        ],
                    ],
                ],
            ]);

        $response->assertSuccessful();

        expect($response->json('success'))->toBeTrue();
        $this->assertDatabaseHas('attraction_packages', [
            'product_id' => $attraction->id,
            'name' => 'Family Package',
        ]);
        $this->assertDatabaseHas('attraction_prices', [
            'attraction_package_id' => $existingPackage->id,
            'price' => 60,
        ]);
    });
});
