<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

// Admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', function () {
        // Hanya user dengan peran 'admin' yang bisa mengakses ini
        return 'Selamat datang di Dashboard Admin!';
    })->name('dashboard');
});

require __DIR__ . '/auth.php';
