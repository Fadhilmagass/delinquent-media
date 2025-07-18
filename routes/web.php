<?php

use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;
use App\Livewire\Article\ArticleForm;
use App\Livewire\Article\ArticleIndex;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

// Group route untuk Admin Panel
Route::prefix('admin')
    ->middleware(['auth', 'role:admin|editor']) // Hanya bisa diakses admin atau editor
    ->name('admin.')
    ->group(function () {

        // Route untuk daftar artikel
        Route::get('/articles', ArticleIndex::class)->name('articles.index');

        // Route untuk membuat artikel baru
        Route::get('/articles/create', ArticleForm::class)->name('articles.create');

        // Route untuk mengedit artikel
        Route::get('/articles/{article}/edit', ArticleForm::class)->name('articles.edit');
    });

// Article
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{article:slug}', [ArticleController::class, 'show'])->name('articles.show');

require __DIR__ . '/auth.php';
