<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GudangController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BiodataController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SearchController;

Route::get('/', [AuthController::class, 'showLoginForm'])->name('home');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Gudang Routes
    Route::get('/gudangs', [GudangController::class, 'index'])->name('gudangs.index');
    Route::get('/gudangs/create', [GudangController::class, 'create'])->name('gudangs.create');
    Route::post('/gudangs', [GudangController::class, 'store'])->name('gudangs.store');
    Route::get('/gudangs/{gudang}', [GudangController::class, 'show'])->name('gudangs.show');
    Route::get('/gudangs/{gudang}/edit', [GudangController::class, 'edit'])->name('gudangs.edit');
    Route::put('/gudangs/{gudang}', [GudangController::class, 'update'])->name('gudangs.update');
    Route::delete('/gudangs/{gudang}', [GudangController::class, 'destroy'])->name('gudangs.destroy');

    // User Routes
    // User Routes
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
// Removed the show route
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

// User Profile Routes
Route::get('/users/{id}/profile', [UserController::class, 'profile'])->name('users.profile'); // View other user's profile
Route::get('/users/my-profile', [UserController::class, 'myProfile'])->name('users.myProfile'); // View logged-in user's profile

    // Product Routes
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

    // Biodata Routes
    Route::get('/biodata', [BiodataController::class, 'index'])->name('biodata.index');
    Route::get('/biodata/create', [BiodataController::class, 'create'])->name('biodata.create');
    Route::post('/biodata', [BiodataController::class, 'store'])->name('biodata.store');
    Route::get('/biodata/{biodata}/edit', [BiodataController::class, 'edit'])->name('biodata.edit');
    Route::put('/biodata/{biodata}', [BiodataController::class, 'update'])->name('biodata.update');
    Route::delete('/biodata/{biodata}', [BiodataController::class, 'destroy'])->name('biodata.destroy');

    // Search Route
    Route::get('/search', [SearchController::class, 'search'])->name('search');

    // Admin Routes
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/admin/settings', [AdminController::class, 'settings'])->name('admin.settings');
        Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    });
});
