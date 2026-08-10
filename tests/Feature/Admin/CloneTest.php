<?php

use App\Enums\ServiceEnum;
use App\Models\Admin;
use App\Models\AgeGroup;
use App\Models\AttractionPackage;
use App\Models\AttractionPrice;
use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\Language;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    Storage::fake(config('filesystems.default'));

    $this->admin = Admin::create([
        'name' => 'Admin',
        'email' => 'admin@test.com',
        'password' => bcrypt('password'),
    ]);
});

describe('simple resources', function () {
    it('clones a country with its data', function () {
        $country = Country::create(['name' => 'Egypt', 'slug' => 'co1-egypt', 'dial_code' => '+20']);

        $this->actingAs($this->admin, 'sanctum')
            ->getJson("/admin/countries/{$country->id}/clone")
            ->assertSuccessful()
            ->assertJsonPath('data.country.name', 'Egypt')
            ->assertJsonPath('data.country.dial_code', '+20')
            ->assertJsonPath('data.country.clone_from', $country->id);
    });

    it('clones a city keeping its country', function () {
        $country = Country::create(['name' => 'Egypt', 'dial_code' => '+20']);
        $city = City::create(['name' => 'Cairo', 'slug' => 'c1-cairo', 'country_id' => $country->id]);

        $this->actingAs($this->admin, 'sanctum')
            ->getJson("/admin/cities/{$city->id}/clone")
            ->assertSuccessful()
            ->assertJsonPath('data.city.name', 'Cairo')
            ->assertJsonPath('data.city.country_id', $country->id)
            ->assertJsonPath('data.city.country.name', 'Egypt');
    });

    it('clones a category with every translation', function () {
        $category = Category::create([
            'name' => ['en' => 'Adventure', 'my' => 'စွန့်စားခန်း'],
            'slug' => '1-adventure',
        ]);

        $this->actingAs($this->admin, 'sanctum')
            ->getJson("/admin/categories/{$category->id}/clone")
            ->assertSuccessful()
            ->assertJsonPath('data.category.name.en', 'Adventure')
            ->assertJsonPath('data.category.name.my', 'စွန့်စားခန်း');
    });

    it('clones an age group with its range', function () {
        $ageGroup = AgeGroup::create(['name' => ['en' => 'Adult'], 'min_age' => 18, 'max_age' => 65]);

        $this->actingAs($this->admin, 'sanctum')
            ->getJson("/admin/age-groups/{$ageGroup->id}/clone")
            ->assertSuccessful()
            ->assertJsonPath('data.age_group.name.en', 'Adult')
            ->assertJsonPath('data.age_group.min_age', 18)
            ->assertJsonPath('data.age_group.max_age', 65);
    });

    it('clears the unique code when cloning a language', function () {
        $language = Language::create(['name' => 'Myanmar', 'code' => 'my']);

        $this->actingAs($this->admin, 'sanctum')
            ->getJson("/admin/languages/{$language->id}/clone")
            ->assertSuccessful()
            ->assertJsonPath('data.language.name', 'Myanmar')
            ->assertJsonPath('data.language.code', null);
    });

    it('returns an error for a missing record', function () {
        $this->actingAs($this->admin, 'sanctum')
            ->getJson('/admin/countries/999/clone')
            ->assertStatus(500);
    });

    it('requires authentication', function () {
        $country = Country::create(['name' => 'Egypt', 'dial_code' => '+20']);

        $this->getJson("/admin/countries/{$country->id}/clone")
            ->assertUnauthorized();
    });
});

describe('accounts', function () {
    it('clears the unique email when cloning an admin', function () {
        $source = Admin::create([
            'name' => 'Support',
            'email' => 'support@test.com',
            'password' => bcrypt('password'),
        ]);

        $this->actingAs($this->admin, 'sanctum')
            ->getJson("/admin/admins/{$source->id}/clone")
            ->assertSuccessful()
            ->assertJsonPath('data.admin.name', 'Support')
            ->assertJsonPath('data.admin.email', null)
            ->assertJsonPath('data.admin.clone_from', $source->id);
    });

    it('copies the source profile image when creating from a clone', function () {
        $source = Admin::create([
            'name' => 'Support',
            'email' => 'support@test.com',
            'password' => bcrypt('password'),
            'profile' => storeImage('admins', UploadedFile::fake()->image('profile.jpg')),
        ]);

        $this->actingAs($this->admin, 'sanctum')
            ->postJson('/admin/admins', [
                'name' => 'Support Copy',
                'email' => 'support-copy@test.com',
                'password' => 'password',
                'clone_from' => $source->id,
            ])
            ->assertSuccessful();

        $copy = Admin::where('email', 'support-copy@test.com')->firstOrFail();
        $sourcePath = $source->getRawOriginal('profile');
        $copyPath = $copy->getRawOriginal('profile');

        expect($copyPath)->not->toBeNull()
            ->and($copyPath)->not->toBe($sourcePath);
        expect(Storage::exists($copyPath))->toBeTrue();
        expect(Storage::exists($sourcePath))->toBeTrue();
    });

    it('clears the unique email when cloning a supplier', function () {
        $supplier = Supplier::create([
            'name' => 'Ocean Park',
            'email' => 'ocean@example.com',
            'password' => bcrypt('password'),
        ]);

        $this->actingAs($this->admin, 'sanctum')
            ->getJson("/admin/suppliers/{$supplier->id}/clone")
            ->assertSuccessful()
            ->assertJsonPath('data.supplier.name', 'Ocean Park')
            ->assertJsonPath('data.supplier.email', null);
    });

    it('clones a user without its email', function () {
        $country = Country::create(['name' => 'Egypt', 'dial_code' => '+20']);
        $user = User::create([
            'first_name' => 'Jane',
            'last_name' => 'Doe',
            'title' => 'Ms',
            'email' => 'jane@example.com',
            'password' => bcrypt('password'),
            'country_id' => $country->id,
            'dial_id' => $country->id,
            'phone_number' => '123456',
        ]);

        $this->actingAs($this->admin, 'sanctum')
            ->getJson("/admin/users/{$user->id}/clone")
            ->assertSuccessful()
            ->assertJsonPath('data.user.first_name', 'Jane')
            ->assertJsonPath('data.user.email', null)
            ->assertJsonPath('data.user.country_id', $country->id)
            ->assertJsonPath('data.user.country.name', 'Egypt')
            ->assertJsonPath('data.user.phone_number', '123456');
    });
});

describe('attractions', function () {
    function makeAttraction(): array
    {
        $country = Country::create(['name' => 'Egypt', 'slug' => 'co1-egypt', 'dial_code' => '+20']);
        $city = City::create(['country_id' => $country->id, 'name' => 'Cairo', 'slug' => 'c1-cairo']);
        $category = Category::create(['name' => 'Adventure', 'slug' => '1-adventure']);
        $ageGroup = AgeGroup::create(['name' => 'Adult', 'min_age' => 18, 'max_age' => 65]);
        $supplier = Supplier::create([
            'name' => 'Ocean Park',
            'email' => 'ocean@example.com',
            'password' => bcrypt('password'),
        ]);

        $attraction = Product::create([
            'name' => 'Pyramid Tour',
            'slug' => '1-pyramid-tour',
            'service' => ServiceEnum::ATTRACTION->value,
            'supplier_id' => $supplier->id,
            'search_keywords' => 'pyramidtour, pyramid',
            'star_rating' => 4,
            'price' => 50,
        ]);

        $attraction->detail()->create(['what_to_expect' => 'A great tour']);
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
        $attraction->images()->create(['url' => storeImage('attraction_images', UploadedFile::fake()->image('one.jpg'))]);

        $package = AttractionPackage::create([
            'product_id' => $attraction->id,
            'name' => 'Standard Package',
            'description' => 'Standard',
        ]);

        AttractionPrice::create([
            'attraction_package_id' => $package->id,
            'age_group_id' => $ageGroup->id,
            'price' => 50,
        ]);

        return compact('attraction', 'country', 'city', 'category', 'ageGroup', 'supplier');
    }

    it('returns clone data without identifiers', function () {
        ['attraction' => $attraction] = makeAttraction();

        $response = $this->actingAs($this->admin, 'sanctum')
            ->getJson("/admin/attractions/{$attraction->id}/clone")
            ->assertSuccessful()
            ->assertJsonPath('data.attraction.id', null)
            ->assertJsonPath('data.attraction.slug', null)
            ->assertJsonPath('data.attraction.clone_from', $attraction->id)
            ->assertJsonPath('data.attraction.name.en', 'Pyramid Tour')
            ->assertJsonPath('data.attraction.detail.what_to_expect.en', 'A great tour')
            ->assertJsonPath('data.attraction.attraction_packages.0.id', null)
            ->assertJsonPath('data.attraction.attraction_packages.0.prices.0.id', null);

        expect($response->json('data.attraction.attraction_packages.0.name.en'))->toBe('Standard Package');
        expect($response->json('data.attraction.images'))->toHaveCount(1);
    });

    it('creates a copy that owns its own images', function () {
        ['attraction' => $attraction, 'country' => $country, 'city' => $city, 'category' => $category, 'ageGroup' => $ageGroup, 'supplier' => $supplier] = makeAttraction();

        $this->actingAs($this->admin, 'sanctum')
            ->postJson('/admin/attractions', [
                'name' => 'Pyramid Tour Copy',
                'supplier_id' => $supplier->id,
                'star_rating' => 4,
                'countries' => [$country->id],
                'cities' => [$city->id],
                'categories' => [$category->id],
                'what_to_expect' => 'A great tour',
                'start_date' => '2026-04-01',
                'end_date' => '2026-05-01',
                'clone_from' => $attraction->id,
                'packages' => [
                    [
                        'name' => 'Standard Package',
                        'description' => 'Standard',
                        'prices' => [
                            ['age_group_id' => $ageGroup->id, 'price' => 50],
                        ],
                    ],
                ],
            ])
            ->assertSuccessful();

        $copy = Product::with('images')->where('name->en', 'Pyramid Tour Copy')->firstOrFail();
        $sourcePath = $attraction->images()->first()->getRawOriginal('url');
        $copyPath = $copy->images->first()->getRawOriginal('url');

        expect($copy->images)->toHaveCount(1);
        expect($copyPath)->not->toBe($sourcePath);
        expect(Storage::exists($copyPath))->toBeTrue();
        expect(Storage::exists($sourcePath))->toBeTrue();
    });

    it('carries externally hosted images over to the copy', function () {
        ['attraction' => $attraction, 'country' => $country, 'city' => $city, 'category' => $category, 'ageGroup' => $ageGroup, 'supplier' => $supplier] = makeAttraction();

        $attraction->images()->delete();
        $attraction->images()->create(['url' => 'https://example.com/remote.jpg']);

        $this->actingAs($this->admin, 'sanctum')
            ->postJson('/admin/attractions', [
                'name' => 'Pyramid Tour Copy',
                'supplier_id' => $supplier->id,
                'countries' => [$country->id],
                'cities' => [$city->id],
                'categories' => [$category->id],
                'what_to_expect' => 'A great tour',
                'start_date' => '2026-04-01',
                'end_date' => '2026-05-01',
                'clone_from' => $attraction->id,
                'packages' => [
                    [
                        'name' => 'Standard Package',
                        'prices' => [
                            ['age_group_id' => $ageGroup->id, 'price' => 50],
                        ],
                    ],
                ],
            ])
            ->assertSuccessful();

        $copy = Product::with('images')->where('name->en', 'Pyramid Tour Copy')->firstOrFail();

        expect($copy->images)->toHaveCount(1);
        expect($copy->images->first()->getRawOriginal('url'))->toBe('https://example.com/remote.jpg');
    });

    it('skips images dropped from the clone form', function () {
        ['attraction' => $attraction, 'country' => $country, 'city' => $city, 'category' => $category, 'ageGroup' => $ageGroup, 'supplier' => $supplier] = makeAttraction();

        $droppedImageId = $attraction->images()->first()->id;

        $this->actingAs($this->admin, 'sanctum')
            ->postJson('/admin/attractions', [
                'name' => 'Pyramid Tour Copy',
                'supplier_id' => $supplier->id,
                'star_rating' => 4,
                'countries' => [$country->id],
                'cities' => [$city->id],
                'categories' => [$category->id],
                'what_to_expect' => 'A great tour',
                'start_date' => '2026-04-01',
                'end_date' => '2026-05-01',
                'clone_from' => $attraction->id,
                'old_images' => [$droppedImageId],
                'images' => [UploadedFile::fake()->image('new.jpg')],
                'packages' => [
                    [
                        'name' => 'Standard Package',
                        'prices' => [
                            ['age_group_id' => $ageGroup->id, 'price' => 50],
                        ],
                    ],
                ],
            ])
            ->assertSuccessful();

        $copy = Product::with('images')->where('name->en', 'Pyramid Tour Copy')->firstOrFail();

        expect($copy->images)->toHaveCount(1);
        expect($attraction->images()->count())->toBe(1);
    });

    it('still requires images when not cloning', function () {
        ['country' => $country, 'city' => $city, 'category' => $category, 'ageGroup' => $ageGroup, 'supplier' => $supplier] = makeAttraction();

        $this->actingAs($this->admin, 'sanctum')
            ->postJson('/admin/attractions', [
                'name' => 'No Image Attraction',
                'supplier_id' => $supplier->id,
                'countries' => [$country->id],
                'cities' => [$city->id],
                'categories' => [$category->id],
                'what_to_expect' => 'A great tour',
                'start_date' => '2026-04-01',
                'end_date' => '2026-05-01',
                'packages' => [
                    [
                        'name' => 'Standard Package',
                        'prices' => [
                            ['age_group_id' => $ageGroup->id, 'price' => 50],
                        ],
                    ],
                ],
            ])
            ->assertStatus(422)
            ->assertJsonValidationErrors(['images']);
    });
});
