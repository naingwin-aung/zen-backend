<?php

use App\Models\User;
use Illuminate\Support\Facades\Config;
use Symfony\Component\HttpFoundation\Cookie;

it('allows credentialed cors requests from the vite localhost origin', function () {
    Config::set('cors.allowed_origins', ['http://localhost:5173']);
    Config::set('cors.supports_credentials', true);

    $response = $this->withHeaders([
        'Origin' => 'http://localhost:5173',
        'Access-Control-Request-Method' => 'GET',
        'Access-Control-Request-Headers' => 'X-Requested-With, X-XSRF-TOKEN',
    ])->options('/sanctum/csrf-cookie');

    $response->assertNoContent();
    $response->assertHeader('Access-Control-Allow-Origin', 'http://localhost:5173');
    $response->assertHeader('Access-Control-Allow-Credentials', 'true');
});

it('issues a readable csrf cookie while keeping the session cookie http only', function () {
    $response = $this->withHeader('Origin', 'http://localhost:5173')
        ->get('/sanctum/csrf-cookie');

    $response->assertNoContent();

    $xsrfCookie = collect($response->headers->getCookies())->first(
        fn (Cookie $cookie): bool => $cookie->getName() === 'XSRF-TOKEN'
    );
    $sessionCookie = collect($response->headers->getCookies())->first(
        fn (Cookie $cookie): bool => $cookie->getName() === config('session.cookie')
    );

    expect($xsrfCookie)->not->toBeNull();
    expect($sessionCookie)->not->toBeNull();
    expect($xsrfCookie->isHttpOnly())->toBeFalse();
    expect($sessionCookie->isHttpOnly())->toBeTrue();
});

it('logs out a session-authenticated sanctum user cleanly', function () {
    $user = User::query()->create([
        'first_name' => 'Test',
        'last_name' => 'User',
        'email' => 'test@example.com',
        'password' => bcrypt('password'),
    ]);

    $response = $this->actingAs($user, 'web')->postJson('/api/logout');

    $response->assertOk()
        ->assertJson([
            'success' => true,
            'message' => 'Logged out successfully.',
        ]);

    expect(auth('web')->check())->toBeFalse();
});

it('keeps session authentication available for api user checks after login', function () {
    $password = 'password123';

    User::query()->create([
        'first_name' => 'Session',
        'last_name' => 'User',
        'email' => 'session-user@example.com',
        'password' => $password,
    ]);

    $headers = [
        'Origin' => 'http://localhost:5173',
        'Referer' => 'http://localhost:5173/',
        'Accept' => 'application/json',
    ];

    $this->withHeaders($headers)->get('/sanctum/csrf-cookie')->assertNoContent();

    $this->withHeaders($headers)->postJson('/api/login', [
        'email' => 'session-user@example.com',
        'password' => $password,
    ])->assertOk();

    $this->withHeaders($headers)
        ->getJson('/api/user')
        ->assertOk()
        ->assertJsonPath('data.user.email', 'session-user@example.com');
});
