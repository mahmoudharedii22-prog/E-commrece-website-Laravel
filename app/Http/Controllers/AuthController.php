<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $service;

    public function __construct(AuthService $service)
    {
        $this->service = $service;
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        $user = $this->service->login($request->validated());

        if (! $user) {
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }
        request()->session()->regenerate();

        return $user->hasRole('admin')
            ? redirect()->route('admin.index')
            : redirect()->route('home.index');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request)
    {
        $user = $this->service->register($request->validated());

        Auth::login($user);

        $request->session()->regenerate();

        return redirect()->route('login.form');
    }

    public function profile()
    {
        $user = Auth::user();
        $addresses = $user->addresses()->get();

        return view('profile.show', compact('user', 'addresses'));
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('home.index');
    }
}
