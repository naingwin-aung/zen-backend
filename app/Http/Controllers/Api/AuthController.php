<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Http\Controllers\Controller;
use App\Services\Api\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(public AuthService $service)
    {
        //
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        try {
            ['user' => $user, 'token' => $token] = $this->service->login($request->email, $request->password);

            return success(['user' => $user, 'token' => $token], 'Login successful.');
        } catch (Exception $e) {
            return error($e->getMessage());
        }
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        try {
            ['user' => $user, 'token' => $token] = $this->service->register($request->name, $request->email, $request->password);

            return success(['user' => $user, 'token' => $token], 'Registration successful.', 201);
        } catch (Exception $e) {
            return error($e->getMessage());
        }
    }

    public function user()
    {
        try {
            return success([
                'user' => auth()->user(),
            ], 'User retrieved successfully.');
        } catch (Exception $e) {
            return error($e->getMessage());
        }
    }

    public function logout()
    {
        try {
            auth()->user()->currentAccessToken()->delete();

            return success(message: 'Logged out successfully.');
        } catch (Exception $e) {
            return error($e->getMessage());
        }
    }
}
