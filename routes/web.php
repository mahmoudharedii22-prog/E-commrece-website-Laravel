<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function () {
    Route::get('/register', 'showRegistrationForm')->name('register.form');
    Route::post('/register', 'register')->name('register');
    Route::get('/login', 'showLoginForm')->name('login.form');
    Route::post('/login', 'login')->name('login');
});

Route::get('/home', [HomeController::class, 'index'])->name('home.index');
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{category:slug}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/{product}', [CartController::class, 'addToCart'])->name('cart.store');
    Route::delete('/cart/{cart}', [CartController::class, 'removeFromCart'])->name('cart.destroy');
    Route::put('/cart/{cart}', [CartController::class, 'update'])->name('cart.update');
    Route::get('/orders/checkout', [OrderController::class, 'checkOut'])->name('orders.checkout');
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile.show');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::post('/addresses', [AddressController::class, 'store'])->name('addresses.store');
    Route::post('/addresses/{address}/default', [AddressController::class, 'makeAsDefault'])->name('addresses.default');
});
