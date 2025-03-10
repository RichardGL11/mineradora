<?php

use App\Http\Middleware\AdminMiddleware;
use App\Livewire\Admin\Orders\ListOrders;
use App\Livewire\Admin\Orders\ShowOrder;
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


Route::get('/orders', ListOrders::class)->middleware([AdminMiddleware::class,'auth'])->name('orders.list.admin');
Route::get('/orders/{order}', ShowOrder::class)->middleware([AdminMiddleware::class,'auth'])->name('orders.show.admin');

require __DIR__.'/auth.php';
