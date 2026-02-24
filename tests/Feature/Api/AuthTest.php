<?php

use App\Models\User;

describe('register', function () {
    it('registers a new user successfully', function () {
        $response = $this->postJson('/api/register', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertStatus(201)
            ->assertJson([
                'success' => true,
                'message' => 'Registration successful.',
            ])
            ->assertJsonStructure([
                'success',
                'message',
                'data' => [
                    'user' => ['id', 'name', 'email'],
                    'token',
                ],
            ]);

        $this->assertDatabaseHas('users', [
            'email' => 'john@example.com',
            'name' => 'John Doe',
        ]);
    });

    it('fails when required fields are missing', function () {
        $response = $this->postJson('/api/register', []);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['name', 'email', 'password']);
    });

    it('fails when email is already taken', function () {
        User::factory()->create(['email' => 'taken@example.com']);

        $response = $this->postJson('/api/register', [
            'name' => 'Jane Doe',
            'email' => 'taken@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['email']);
    });

    it('fails when password is too short', function () {
        $response = $this->postJson('/api/register', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'short',
            'password_confirmation' => 'short',
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['password']);
    });

    it('fails when password confirmation does not match', function () {
        $response = $this->postJson('/api/register', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password123',
            'password_confirmation' => 'different123',
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['password']);
    });

    it('fails when email format is invalid', function () {
        $response = $this->postJson('/api/register', [
            'name' => 'John Doe',
            'email' => 'not-an-email',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['email']);
    });
});

describe('login', function () {
    it('logs in with valid credentials', function () {
        User::factory()->create([
            'email' => 'john@example.com',
            'password' => 'password',
        ]);

        $response = $this->postJson('/api/login', [
            'email' => 'john@example.com',
            'password' => 'password',
        ]);

        $response->assertOk()
            ->assertJson([
                'success' => true,
                'message' => 'Login successful.',
            ])
            ->assertJsonStructure([
                'success',
                'message',
                'data' => [
                    'user' => ['id', 'name', 'email'],
                    'token',
                ],
            ]);
    });

    it('fails with invalid credentials', function () {
        User::factory()->create([
            'email' => 'john@example.com',
            'password' => 'password',
        ]);

        $response = $this->postJson('/api/login', [
            'email' => 'john@example.com',
            'password' => 'wrong-password',
        ]);

        $response->assertServerError();
    });

    it('fails when required fields are missing', function () {
        $response = $this->postJson('/api/login', []);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['email', 'password']);
    });

    it('fails when email format is invalid', function () {
        $response = $this->postJson('/api/login', [
            'email' => 'not-an-email',
            'password' => 'password',
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['email']);
    });
});

describe('user', function () {
    it('returns the authenticated user', function () {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->getJson('/api/user');

        $response->assertOk()
            ->assertJson([
                'success' => true,
                'message' => 'User retrieved successfully.',
                'data' => [
                    'user' => [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                    ],
                ],
            ]);
    });

    it('returns unauthenticated when no token is provided', function () {
        $response = $this->getJson('/api/user');

        $response->assertUnauthorized();
    });
});

describe('logout', function () {
    it('logs out the authenticated user', function () {
        $user = User::factory()->create();
        $token = $user->createToken('auth_token')->plainTextToken;

        $response = $this->withHeader('Authorization', "Bearer {$token}")
            ->postJson('/api/logout');

        $response->assertOk()
            ->assertJson([
                'success' => true,
                'message' => 'Logged out successfully.',
            ]);

        $this->assertDatabaseCount('personal_access_tokens', 0);
    });

    it('returns unauthenticated when no token is provided', function () {
        $response = $this->postJson('/api/logout');

        $response->assertUnauthorized();
    });
});
