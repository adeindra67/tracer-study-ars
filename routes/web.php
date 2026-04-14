<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\AlumniAuthController;
use App\Http\Controllers\Alumni\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route khusus untuk Login Alumni
Route::get('/login-alumni', [AlumniAuthController::class, 'showLoginForm'])->name('alumni.login');
Route::post('/login-alumni', [AlumniAuthController::class, 'login']);
Route::post('/logout-alumni', [AlumniAuthController::class, 'logout'])->name('alumni.logout');

// Route yang hanya bisa diakses kalau Alumni sudah berhasil Login
Route::middleware('auth:alumni')->prefix('alumni')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('alumni.dashboard');
    // Tambahkan baris ini untuk memproses form:
    Route::post('/dashboard', [DashboardController::class, 'store'])->name('alumni.dashboard.store');
});

require __DIR__.'/auth.php';
