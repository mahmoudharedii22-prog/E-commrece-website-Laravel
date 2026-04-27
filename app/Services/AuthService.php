<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

        return Auth::user();
    }

    public function register(array $data): User
    {
        $data['password'] = Hash::make($data['password']);

        return User::create($data);

    }
}
