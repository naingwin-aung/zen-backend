<?php

use App\Models\Admin;
use App\Models\Supplier;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    $this->admin = Admin::create([
        'name' => 'Admin',
        'email' => 'admin@test.com',
        'password' => bcrypt('password'),
    ]);
});

describe('index', function () {
    it('lists suppliers with pagination', function () {
        Supplier::create([
            'name' => 'Universal Studios',
            'email' => 'universal@example.com',
            'password' => bcrypt('password'),
        ]);

        Supplier::create([
            'name' => 'Ocean Park',
            'email' => 'ocean@example.com',
            'password' => bcrypt('password'),
        ]);

        $response = $this->actingAs($this->admin, 'sanctum')
            ->getJson('/admin/suppliers?page=1&limit=10');

        $response->assertSuccessful()
            ->assertJsonPath('data.total', 2)
            ->assertJsonCount(2, 'data.suppliers');
    });

    it('searches suppliers by name or email', function () {
        Supplier::create([
            'name' => 'Universal Studios',
            'email' => 'universal@example.com',
            'password' => bcrypt('password'),
        ]);

        Supplier::create([
            'name' => 'Ocean Park',
            'email' => 'ocean@example.com',
            'password' => bcrypt('password'),
        ]);

        $response = $this->actingAs($this->admin, 'sanctum')
            ->getJson('/admin/suppliers?page=1&limit=10&search=ocean');

        $response->assertSuccessful()
            ->assertJsonPath('data.total', 1)
            ->assertJsonPath('data.suppliers.0.name', 'Ocean Park');
    });

    it('requires authentication', function () {
        $this->getJson('/admin/suppliers?page=1&limit=10')
            ->assertUnauthorized();
    });
});

describe('show', function () {
    it('returns a supplier', function () {
        $supplier = Supplier::create([
            'name' => 'Ocean Park',
            'email' => 'ocean@example.com',
            'password' => bcrypt('password'),
        ]);

        $this->actingAs($this->admin, 'sanctum')
            ->getJson('/admin/suppliers/'.$supplier->id)
            ->assertSuccessful()
            ->assertJsonPath('data.supplier.name', 'Ocean Park')
            ->assertJsonMissingPath('data.supplier.password');
    });

    it('fails when the supplier does not exist', function () {
        $this->actingAs($this->admin, 'sanctum')
            ->getJson('/admin/suppliers/999')
            ->assertServerError()
            ->assertJsonPath('success', false);
    });
});

describe('store', function () {
    it('creates a supplier', function () {
        $response = $this->actingAs($this->admin, 'sanctum')
            ->postJson('/admin/suppliers', [
                'name' => 'Ocean Park',
                'email' => 'ocean@example.com',
                'password' => 'password',
            ]);

        $response->assertSuccessful()
            ->assertJsonPath('data.supplier.email', 'ocean@example.com');

        $this->assertDatabaseHas('suppliers', [
            'name' => 'Ocean Park',
            'email' => 'ocean@example.com',
        ]);
    });

    it('stores the profile image', function () {
        Storage::fake('local');

        $this->actingAs($this->admin, 'sanctum')
            ->postJson('/admin/suppliers', [
                'name' => 'Ocean Park',
                'email' => 'ocean@example.com',
                'password' => 'password',
                'profile' => UploadedFile::fake()->image('profile.jpg'),
            ])->assertSuccessful();

        expect(Supplier::first()->getRawOriginal('profile'))->not->toBeNull();
    });

    it('rejects a duplicated email', function () {
        Supplier::create([
            'name' => 'Ocean Park',
            'email' => 'ocean@example.com',
            'password' => bcrypt('password'),
        ]);

        $this->actingAs($this->admin, 'sanctum')
            ->postJson('/admin/suppliers', [
                'name' => 'Another',
                'email' => 'ocean@example.com',
                'password' => 'password',
            ])->assertJsonValidationErrors('email');
    });

    it('validates the required fields', function () {
        $this->actingAs($this->admin, 'sanctum')
            ->postJson('/admin/suppliers', [])
            ->assertJsonValidationErrors(['name', 'email', 'password']);
    });
});

describe('update', function () {
    it('updates a supplier', function () {
        $supplier = Supplier::create([
            'name' => 'Ocean Park',
            'email' => 'ocean@example.com',
            'password' => bcrypt('password'),
        ]);

        $this->actingAs($this->admin, 'sanctum')
            ->putJson('/admin/suppliers/'.$supplier->id, [
                'name' => 'Ocean Park Updated',
                'email' => 'ocean@example.com',
            ])->assertSuccessful()
            ->assertJsonPath('data.supplier.name', 'Ocean Park Updated');

        $this->assertDatabaseHas('suppliers', [
            'id' => $supplier->id,
            'name' => 'Ocean Park Updated',
        ]);
    });

    it('keeps the current password when it is not given', function () {
        $supplier = Supplier::create([
            'name' => 'Ocean Park',
            'email' => 'ocean@example.com',
            'password' => bcrypt('password'),
        ]);

        $password = $supplier->password;

        $this->actingAs($this->admin, 'sanctum')
            ->putJson('/admin/suppliers/'.$supplier->id, [
                'name' => 'Ocean Park',
                'email' => 'ocean@example.com',
            ])->assertSuccessful();

        expect($supplier->fresh()->password)->toBe($password);
    });

    it('allows keeping its own email', function () {
        $supplier = Supplier::create([
            'name' => 'Ocean Park',
            'email' => 'ocean@example.com',
            'password' => bcrypt('password'),
        ]);

        $this->actingAs($this->admin, 'sanctum')
            ->putJson('/admin/suppliers/'.$supplier->id, [
                'name' => 'Ocean Park',
                'email' => 'ocean@example.com',
            ])->assertSuccessful();
    });
});

describe('destroy', function () {
    it('soft deletes a supplier', function () {
        $supplier = Supplier::create([
            'name' => 'Ocean Park',
            'email' => 'ocean@example.com',
            'password' => bcrypt('password'),
        ]);

        $this->actingAs($this->admin, 'sanctum')
            ->deleteJson('/admin/suppliers/'.$supplier->id)
            ->assertSuccessful();

        $this->assertSoftDeleted('suppliers', ['id' => $supplier->id]);
    });

    it('fails when the supplier does not exist', function () {
        $this->actingAs($this->admin, 'sanctum')
            ->deleteJson('/admin/suppliers/999')
            ->assertServerError()
            ->assertJsonPath('success', false);
    });
});
