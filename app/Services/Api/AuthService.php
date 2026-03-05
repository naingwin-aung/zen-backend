<?php
namespace App\Services\Api;

use App\Exceptions\MyException;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class AuthService
{
    public function login($email, $password)
    {
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            $user  = Auth::user();
            $token = $user->createToken('auth_token')->plainTextToken;
            return ['user' => $user, 'token' => $token];
        }

        throw new MyException('Invalid email or password.');
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

    public function handleCallback(string $provider, $token)
    {
        if (empty($token)) {
            throw new Exception('Token not provided.');
        }

        $providerUser = Socialite::driver($provider)->stateless()->userFromToken($token);

        $user = User::where('email', $providerUser->getEmail())->first();

        if (!$user) {
            $user = User::create([
                'name'     => $providerUser->getName(),
                'email'    => $providerUser->getEmail(),
                'password' => Hash::make(Str::random(16)),
            ]);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return [
            'user'  => $user,
            'token' => $token,
        ];
    }
}