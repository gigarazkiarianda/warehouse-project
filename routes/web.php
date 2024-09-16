<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GudangController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BiodataController;

/*
|---------------------------------------------------------------------------
| Web Routes
|---------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Arahkan root URL ('/') langsung ke halaman login
Route::get('/', [AuthController::class, 'showLoginForm'])->name('home');

// Rute untuk otentikasi
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rute yang memerlukan otentikasi
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        // Mengambil data pengguna dari session
        $user = auth()->user();
        return view('dashboard', compact('user'));
    })->name('dashboard');

    // Resource routes yang memerlukan otentikasi
    Route::resource('categories', CategoryController::class);
    Route::resource('gudangs', GudangController::class);
    Route::resource('users', UserController::class);
    Route::resource('stocks', StockController::class);
    Route::resource('products', ProductController::class);
    Route::resource('biodata', BiodataController::class);


    // Menggunakan middleware untuk rute tertentu
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/admin/settings', [AdminController::class, 'settings'])->name('admin.settings');
    });
});

// Rute untuk admin yang tidak memerlukan otentikasi
Route::get('/admin', [AdminController::class, 'index'])->middleware('role:admin')->name('admin.index');
