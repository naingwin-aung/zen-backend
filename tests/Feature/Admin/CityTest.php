<?php

use App\Models\Admin;
use App\Models\City;
use App\Models\Country;

beforeEach(function () {
    $this->admin = Admin::create([
        'name' => 'Admin',
        'email' => 'admin@test.com',
        'password' => bcrypt('password'),
    ]);
});

describe('index', function () {
    it('lists cities with pagination', function () {
        $country = Country::create(['name' => 'Egypt', 'dial_code' => '+20']);
        City::create(['name' => 'Cairo', 'slug' => 'c1cairo', 'country_id' => $country->id]);
        City::create(['name' => 'Giza', 'slug' => 'c2giza', 'country_id' => $country->id]);

        $response = $this->actingAs($this->admin, 'sanctum')
            ->getJson('/admin/cities?page=1&limit=10');

        $response->assertSuccessful()
            ->assertJsonPath('data.total', 2)
            ->assertJsonCount(2, 'data.cities');
    });

    it('searches cities by name', function () {
        $country = Country::create(['name' => 'Egypt', 'dial_code' => '+20']);
        City::create(['name' => 'Cairo', 'slug' => 'c1cairo', 'country_id' => $country->id]);
        City::create(['name' => 'Giza', 'slug' => 'c2giza', 'country_id' => $country->id]);

        $response = $this->actingAs($this->admin, 'sanctum')
            ->getJson('/admin/cities?page=1&limit=10&search=Cairo');

        $response->assertSuccessful()
            ->assertJsonPath('data.total', 1);
    });

    it('requires page and limit', function () {
        $this->actingAs($this->admin, 'sanctum')
            ->getJson('/admin/cities')
            ->assertStatus(422);
    });
});

describe('show', function () {
    it('returns a single city with country', function () {
        $country = Country::create(['name' => 'Egypt', 'dial_code' => '+20']);
        $city = City::create(['name' => 'Cairo', 'slug' => 'c1cairo', 'country_id' => $country->id]);

        $response = $this->actingAs($this->admin, 'sanctum')
            ->getJson("/admin/cities/{$city->id}");

        $response->assertSuccessful()
            ->assertJsonPath('data.city.name', 'Cairo')
            ->assertJsonPath('data.city.country.name', 'Egypt');
    });

    it('returns error for non-existent city', function () {
        $this->actingAs($this->admin, 'sanctum')
            ->getJson('/admin/cities/999')
            ->assertStatus(500);
    });
});

describe('store', function () {
    it('creates a city with slug', function () {
        $country = Country::create(['name' => 'Egypt', 'dial_code' => '+20']);

        $response = $this->actingAs($this->admin, 'sanctum')
            ->postJson('/admin/cities', [
                'name' => 'Alexandria',
                'country_id' => $country->id,
            ]);

        $response->assertSuccessful()
            ->assertJsonPath('data.city.name', 'Alexandria');

        $city = City::first();
        expect($city->slug)->toStartWith('c'.$city->id);
        expect($city->slug)->toContain('alexandria');
    });

    it('fails without required fields', function () {
        $this->actingAs($this->admin, 'sanctum')
            ->postJson('/admin/cities', [])
            ->assertStatus(422)
            ->assertJsonValidationErrors(['name', 'country_id']);
    });

    it('fails with invalid country_id', function () {
        $this->actingAs($this->admin, 'sanctum')
            ->postJson('/admin/cities', [
                'name' => 'Cairo',
                'country_id' => 999,
            ])
            ->assertStatus(422)
            ->assertJsonValidationErrors(['country_id']);
    });
});

describe('update', function () {
    it('updates a city', function () {
        $country = Country::create(['name' => 'Egypt', 'dial_code' => '+20']);
        $city = City::create(['name' => 'Cairo', 'slug' => 'c1cairo', 'country_id' => $country->id]);

        $newCountry = Country::create(['name' => 'Sudan', 'dial_code' => '+249']);

        $response = $this->actingAs($this->admin, 'sanctum')
            ->putJson("/admin/cities/{$city->id}", [
                'name' => 'Khartoum',
                'country_id' => $newCountry->id,
            ]);

        $response->assertSuccessful()
            ->assertJsonPath('data.city.name', 'Khartoum')
            ->assertJsonPath('data.city.country.name', 'Sudan');

        $city->refresh();
        expect($city->slug)->toBe('c'.$city->id.'-khartoum');
    });

    it('returns error for non-existent city', function () {
        $country = Country::create(['name' => 'Egypt', 'dial_code' => '+20']);

        $this->actingAs($this->admin, 'sanctum')
            ->putJson('/admin/cities/999', [
                'name' => 'Cairo',
                'country_id' => $country->id,
            ])
            ->assertStatus(500);
    });
});

describe('destroy', function () {
    it('deletes a city', function () {
        $country = Country::create(['name' => 'Egypt', 'dial_code' => '+20']);
        $city = City::create(['name' => 'Cairo', 'slug' => 'c1cairo', 'country_id' => $country->id]);

        $this->actingAs($this->admin, 'sanctum')
            ->deleteJson("/admin/cities/{$city->id}")
            ->assertSuccessful();

        $this->assertDatabaseMissing('cities', ['id' => $city->id]);
    });

    it('returns error for non-existent city', function () {
        $this->actingAs($this->admin, 'sanctum')
            ->deleteJson('/admin/cities/999')
            ->assertStatus(500);
    });
});

describe('auth', function () {
    it('requires authentication', function () {
        $this->getJson('/admin/cities?page=1&limit=10')
            ->assertUnauthorized();
    });
});
