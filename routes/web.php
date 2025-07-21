<?php

use App\Livewire\Article\ArticleForm;
use Illuminate\Support\Facades\Route;
use App\Livewire\Article\ArticleIndex;
use App\Http\Controllers\BandController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ReleaseController;
use App\Livewire\Homepage;

Route::get('/', Homepage::class)->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified', 'role:admin|editor'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

// Group route untuk Admin Panel
Route::prefix('admin')
    ->middleware(['auth', 'role:admin|editor']) // Hanya bisa diakses admin
    ->name('admin.')
    ->group(function () {

        // Route untuk daftar artikel
        Route::get('/articles', ArticleIndex::class)->name('articles.index');

        // Route untuk membuat artikel baru
        Route::get('/articles/create', ArticleForm::class)->name('articles.create');

        // Route untuk mengedit artikel
        Route::get('/articles/{article}/edit', ArticleForm::class)->name('articles.edit');
    });

// Events
Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/events/{event:slug}', [EventController::class, 'show'])->name('events.show');

// Bands & Releases
Route::resource('bands', BandController::class)->parameters(['bands' => 'band:slug']);
Route::get('/releases/{release:slug}', [ReleaseController::class, 'show'])->name('releases.show');

// Article
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{article:slug}', [ArticleController::class, 'show'])->name('articles.show');

require __DIR__ . '/auth.php';
