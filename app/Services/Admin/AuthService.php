<?php
namespace App\Services\Admin;

use App\Exceptions\MyException;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function login($email, $password)
    {
        if (Auth::guard('admin')->attempt(['email' => $email, 'password' => $password])) {
            return ['user' => Auth::guard('admin')->user()];
        }

        throw new MyException('Invalid email or password.');
    }
}