<?php

use App\Models\Admin;
use App\Models\Country;
use App\Models\User;

beforeEach(function () {
    $this->admin = Admin::create([
        'name' => 'Admin',
        'email' => 'admin@test.com',
        'password' => bcrypt('password'),
    ]);
});

describe('index', function () {
    it('lists users with pagination', function () {
        User::create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john@example.com',
            'password' => bcrypt('password'),
        ]);

        User::create([
            'first_name' => 'Jane',
            'last_name' => 'Smith',
            'email' => 'jane@example.com',
            'password' => bcrypt('password'),
        ]);

        $response = $this->actingAs($this->admin, 'sanctum')
            ->getJson('/admin/users?page=1&limit=10');

        $response->assertSuccessful()
            ->assertJsonPath('data.total', 2)
            ->assertJsonCount(2, 'data.users');
    });

    it('searches users by name or email', function () {
        User::create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john@example.com',
            'password' => bcrypt('password'),
        ]);

        User::create([
            'first_name' => 'Jane',
            'last_name' => 'Smith',
            'email' => 'jane@example.com',
            'password' => bcrypt('password'),
        ]);

        $response = $this->actingAs($this->admin, 'sanctum')
            ->getJson('/admin/users?page=1&limit=10&search=John');

        $response->assertSuccessful()
            ->assertJsonPath('data.total', 1)
            ->assertJsonPath('data.users.0.first_name', 'John');
    });

    it('requires page and limit', function () {
        $this->actingAs($this->admin, 'sanctum')
            ->getJson('/admin/users')
            ->assertStatus(422);
    });
});

describe('show', function () {
    it('returns a single user with relations', function () {
        $country = Country::create(['name' => 'Myanmar', 'dial_code' => '+95']);

        $user = User::create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john@example.com',
            'password' => bcrypt('password'),
            'country_id' => $country->id,
            'dial_id' => $country->id,
            'phone_number' => '123456789',
        ]);

        $response = $this->actingAs($this->admin, 'sanctum')
            ->getJson("/admin/users/{$user->id}");

        $response->assertSuccessful()
            ->assertJsonPath('data.user.email', 'john@example.com')
            ->assertJsonPath('data.user.country.name', 'Myanmar')
            ->assertJsonPath('data.user.dial.name', 'Myanmar');
    });

    it('returns error for non-existent user', function () {
        $this->actingAs($this->admin, 'sanctum')
            ->getJson('/admin/users/999')
            ->assertStatus(500);
    });
});

describe('store', function () {
    it('creates a user successfully', function () {
        $country = Country::create(['name' => 'Myanmar', 'dial_code' => '+95']);

        $response = $this->actingAs($this->admin, 'sanctum')
            ->postJson('/admin/users', [
                'first_name' => 'Alice',
                'last_name' => 'Wonder',
                'title' => 'Ms',
                'email' => 'alice@example.com',
                'password' => 'secret123',
                'country_id' => $country->id,
                'dial_id' => $country->id,
                'phone_number' => '987654321',
            ]);

        $response->assertSuccessful()
            ->assertJsonPath('data.user.email', 'alice@example.com')
            ->assertJsonPath('data.user.first_name', 'Alice');

        $this->assertDatabaseHas('users', [
            'email' => 'alice@example.com',
            'first_name' => 'Alice',
        ]);
    });

    it('fails without required fields', function () {
        $this->actingAs($this->admin, 'sanctum')
            ->postJson('/admin/users', [])
            ->assertStatus(422)
            ->assertJsonValidationErrors(['email', 'password']);
    });

    it('fails with duplicate email', function () {
        User::create([
            'email' => 'existing@example.com',
            'password' => bcrypt('password'),
        ]);

        $this->actingAs($this->admin, 'sanctum')
            ->postJson('/admin/users', [
                'email' => 'existing@example.com',
                'password' => 'secret123',
            ])
            ->assertStatus(422)
            ->assertJsonValidationErrors(['email']);
    });
});

describe('update', function () {
    it('updates a user', function () {
        $user = User::create([
            'first_name' => 'OldName',
            'email' => 'old@example.com',
            'password' => bcrypt('password'),
        ]);

        $response = $this->actingAs($this->admin, 'sanctum')
            ->putJson("/admin/users/{$user->id}", [
                'first_name' => 'NewName',
                'email' => 'new@example.com',
            ]);

        $response->assertSuccessful()
            ->assertJsonPath('data.user.first_name', 'NewName')
            ->assertJsonPath('data.user.email', 'new@example.com');

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'first_name' => 'NewName',
            'email' => 'new@example.com',
        ]);
    });

    it('returns error for non-existent user', function () {
        $this->actingAs($this->admin, 'sanctum')
            ->putJson('/admin/users/999', [
                'email' => 'user@example.com',
            ])
            ->assertStatus(500);
    });
});

describe('destroy', function () {
    it('deletes a user', function () {
        $user = User::create([
            'email' => 'delete@example.com',
            'password' => bcrypt('password'),
        ]);

        $this->actingAs($this->admin, 'sanctum')
            ->deleteJson("/admin/users/{$user->id}")
            ->assertSuccessful();

        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    });

    it('returns error for non-existent user', function () {
        $this->actingAs($this->admin, 'sanctum')
            ->deleteJson('/admin/users/999')
            ->assertStatus(500);
    });
});

describe('auth', function () {
    it('requires authentication', function () {
        $this->getJson('/admin/users?page=1&limit=10')
            ->assertUnauthorized();
    });
});
