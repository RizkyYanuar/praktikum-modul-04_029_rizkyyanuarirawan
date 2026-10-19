<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\StatelessController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\RoleController;

Route::get('/', [ProductController::class, 'dashboardView'])->name('dashboard');

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{id_barang}', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/cart/update/{id_barang}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{id_barang}', [CartController::class, 'remove'])->name('cart.remove');

    Route::post('/checkout', [OrderController::class, 'checkout'])->name('checkout');

    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');

    Route::patch(
        '/admin/users/{user}/role',
        [RoleController::class, 'update']
    )
        ->middleware(['auth', 'can:manage-roles'])
        ->name('admin.users.role.update');
});

// RUTE UNTUK PRAKTIKUM 4b

Route::get('/cartnew', [StatelessController::class, 'index']);
Route::post('/cartnew/add', [StatelessController::class, 'add'])->name('cart.add');
Route::post('/cartnew/update', [StatelessController::class, 'update'])->name('cart.update');
