<?php
namespace App\Services\Api;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function login($email, $password)
    {
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            $user  = Auth::user();
            $token = $user->createToken('auth_token')->plainTextToken;
            return ['user' => $user, 'token' => $token];
        }

        return error('Invalid credentials.', 401);
    }

    public function register($name, $email, $password)
    {
        $user = User::create([
            'name'     => $name,
            'email'    => $email,
            'password' => $password,
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return ['user' => $user, 'token' => $token];
    }
}