<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function login(array $data): ?User
    {
        if (! Auth::attempt([
            'email' => $data['email'],
            'password' => $data['password'],
        ])) {
            return null;
        }

        request()->session()->regenerate();

        return Auth::user();
    }

    public function register(array $data): User
    {
        return User::create($data);

    }
}
