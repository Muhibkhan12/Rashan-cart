<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Customer\OrderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Guest routes (only when NOT logged in)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    // Login
    Route::get('/login',  [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    // Register
    Route::get('/register',  [RegisterController::class, 'showRegister'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);

    // Forgot / reset password
    Route::get('/forgot-password',  [AuthController::class, 'showForgot'])->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'sendReset'])->name('password.email');
    Route::get('/reset-password/{token}', [AuthController::class, 'showReset'])->name('password.reset');
    Route::post('/reset-password',        [AuthController::class, 'reset'])->name('password.update');

    // Invitation
    Route::get('/activate',  [RegisterController::class, 'showInvite'])->name('invite.form');
    Route::post('/activate', [RegisterController::class, 'activate'])->name('invite.accept');
});

/*
|--------------------------------------------------------------------------
| Authenticated routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    /*
    |----------------------------------------------------------------------
    | Customer area
    |----------------------------------------------------------------------
    */

    // Dashboard & static pages
    Route::view('/customer/dashboard',  'customer.dashboard')->name('customer.dashboard');
    Route::view('/customer/deliveries', 'customer.deliveries')->name('customer.deliveries');
    Route::view('/customer/savings',    'customer.savings')->name('customer.savings');
    Route::view('/customer/profile',    'customer.profile')->name('customer.profile');

    // Shop → create order (same form, friendly URL)
    Route::get('/customer/shop', [OrderController::class, 'create'])->name('customer.shop');

    // Orders CRUD (real DB data)
    Route::get('/customer/orders',              [OrderController::class, 'index'])->name('customer.orders');
    Route::get('/customer/orders/create',       [OrderController::class, 'create'])->name('customer.orders.create');
    Route::post('/customer/orders',             [OrderController::class, 'store'])->name('customer.orders.store');
    Route::post('/customer/orders/{id}/cancel', [OrderController::class, 'cancel'])->name('customer.orders.cancel');

    /*
    |----------------------------------------------------------------------
    | Other roles
    |----------------------------------------------------------------------
    */
    Route::view('/admin/dashboard',    'dashboards.admin')->name('admin.dashboard');
    Route::view('/supplier/dashboard', 'dashboards.supplier')->name('supplier.dashboard');
    Route::view('/rider/dashboard',    'dashboards.rider')->name('rider.dashboard');
});

/*
|--------------------------------------------------------------------------
| Root redirect
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    if (! auth()->check()) {
        return redirect()->route('login');
    }

    return match (auth()->user()->role->name) {
        'admin', 'procurement' => redirect()->route('admin.dashboard'),
        'supplier'             => redirect()->route('supplier.dashboard'),
        'rider', 'delivery'    => redirect()->route('rider.dashboard'),
        default                => redirect()->route('customer.dashboard'),
    };
});