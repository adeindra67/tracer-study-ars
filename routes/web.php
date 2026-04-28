<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\AlumniAuthController;
use App\Http\Controllers\Alumni\DashboardController;
use App\Http\Controllers\PenggunaController; // Pastikan ini di-import

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

// Route Alumni (Setelah Login)
Route::middleware('auth:alumni')->prefix('alumni')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('alumni.dashboard');
    Route::post('/dashboard', [DashboardController::class, 'store'])->name('alumni.dashboard.store');
    Route::get('/selesai', [DashboardController::class, 'selesai'])->name('alumni.selesai');
});

// ==========================================
// RUTE UNTUK PENGGUNA / HRD (ALUR BARU DOSEN)
// ==========================================
Route::prefix('pengguna')->name('pengguna.')->group(function () {
    // Tahap 1 & 2: Halaman Pencarian & Halaman Hasil (Gunakan GET)
    Route::get('/', [PenggunaController::class, 'index'])->name('index');
    Route::get('/hasil', [PenggunaController::class, 'hasil'])->name('hasil');
    
    // Tahap 3: Halaman Verifikasi (Gunakan Parameter ID di URL agar tidak error)
    Route::get('/verifikasi/{alumni_no}', [PenggunaController::class, 'verifikasi'])->name('verifikasi');
    Route::post('/verifikasi/{alumni_no}', [PenggunaController::class, 'prosesVerifikasi'])->name('verifikasi.proses');
    
    // Tahap 4: Halaman Kuesioner (Sesi Utama)
    Route::get('/dashboard', [PenggunaController::class, 'dashboard'])->name('dashboard');
    Route::post('/store', [PenggunaController::class, 'store'])->name('store');
    Route::get('/selesai', [PenggunaController::class, 'selesai'])->name('selesai');
});

require __DIR__.'/auth.php';