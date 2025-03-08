<?php

use App\Livewire\ShoppingCart\ShoppingCart;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('/shopping-cart', ShoppingCart::class)
    ->middleware(['auth'])
    ->name('shopping-cart');

Route::get('/rota', ShoppingCart::class)
    ->middleware(['auth'])
    ->name('rota');
Route::get('/deucerto',ShoppingCart::class)
    ->middleware(['auth'])
    ->name('deucerto');

require __DIR__.'/auth.php';
