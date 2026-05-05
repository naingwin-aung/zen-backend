<?php

use App\Enums\ServiceEnum;
use App\Models\Admin;
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

    $this->country = Country::create([
        'name' => 'Singapore',
        'slug' => 'singapore',
        'dial_code' => '+65',
    ]);

    $this->city = City::create([
        'country_id' => $this->country->id,
        'name' => 'Singapore City',
        'slug' => 'singapore-city',
    ]);

    $this->category = Category::create([
        'name' => 'Activities',
        'slug' => '1-activities',
    ]);
});

describe('GET admin/products', function () {
    it('requires authentication', function () {
        $this->getJson('/admin/products?page=1&limit=10')
            ->assertStatus(401);
    });

    it('requires page and limit parameters', function () {
        $this->actingAs($this->admin, 'sanctum')
            ->getJson('/admin/products')
            ->assertStatus(422)
            ->assertJsonValidationErrors(['page', 'limit']);
    });

    it('returns paginated list of products', function () {
        Product::factory()->count(5)->create([
            'service' => ServiceEnum::ATTRACTION->value,
        ]);

        $response = $this->actingAs($this->admin, 'sanctum')
            ->getJson('/admin/products?page=1&limit=10')
            ->assertOk()
            ->assertJsonStructure([
                'success',
                'message',
                'data' => [
                    'total',
                    'is_load_more',
                    'products' => [
                        '*' => [
                            'id',
                            'name',
                            'slug',
                            'service',
                            'star_rating',
                            'categories',
                            'images',
                            'countries',
                            'cities',
                        ],
                    ],
                ],
            ]);

        expect($response->json('data.total'))->toBe(5)
            ->and($response->json('success'))->toBeTrue();
    });

    it('returns products with correct relationships attached', function () {
        $product = Product::create([
            'name' => 'Universal Studios Singapore',
            'slug' => '99-universal-studios-singapore',
            'service' => ServiceEnum::ATTRACTION->value,
            'star_rating' => 4.8,
        ]);

        $product->categories()->sync([$this->category->id]);
        $product->countries()->sync([$this->country->id]);
        $product->cities()->sync([$this->city->id]);
        $product->images()->create(['url' => 'https://i.pinimg.com/736x/example.jpg']);

        $response = $this->actingAs($this->admin, 'sanctum')
            ->getJson('/admin/products?page=1&limit=10')
            ->assertOk();

        $product = collect($response->json('data.products'))
            ->firstWhere('name', 'Universal Studios Singapore');

        expect($product)->not->toBeNull()
            ->and($product['categories'])->toHaveCount(1)
            ->and($product['categories'][0]['name'])->toBe('Activities')
            ->and($product['countries'])->toHaveCount(1)
            ->and($product['countries'][0]['name'])->toBe('Singapore')
            ->and($product['cities'])->toHaveCount(1)
            ->and($product['images'])->toHaveCount(1);
    });

    it('filters products by search keyword', function () {
        Product::create([
            'name' => 'Desert Safari Dubai',
            'slug' => '100-desert-safari-dubai',
            'service' => ServiceEnum::ATTRACTION->value,
            'search_keywords' => 'desertsafaridubai, desert, safari, dubai',
            'star_rating' => 4.8,
        ]);

        Product::create([
            'name' => 'Elephant Sanctuary Thailand',
            'slug' => '101-elephant-sanctuary-thailand',
            'service' => ServiceEnum::ATTRACTION->value,
            'search_keywords' => 'elephantsanctuarythailand, elephant, sanctuary',
            'star_rating' => 4.9,
        ]);

        $response = $this->actingAs($this->admin, 'sanctum')
            ->getJson('/admin/products?page=1&limit=10&search=safari')
            ->assertOk();

        expect($response->json('data.total'))->toBe(1)
            ->and($response->json('data.products.0.name'))->toBe('Desert Safari Dubai');
    });

    it('paginates correctly and returns is_load_more flag', function () {
        Product::factory()->count(15)->create([
            'service' => ServiceEnum::ATTRACTION->value,
        ]);

        $response = $this->actingAs($this->admin, 'sanctum')
            ->getJson('/admin/products?page=1&limit=10')
            ->assertOk();

        expect($response->json('data.total'))->toBe(15)
            ->and($response->json('data.is_load_more'))->toBeTrue();
    });
});
