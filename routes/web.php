<?php

use App\Http\Controllers\Driver\AcceptFreigth;
use App\Http\Controllers\Driver\FinishFreightController;
use App\Http\Controllers\MapController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\DriverMiddleware;
use App\Livewire\Address\CreateAddress;
use App\Livewire\Admin\Frete\GenerateFrete;
use App\Livewire\Admin\Orders\ListOrders;
use App\Livewire\Admin\Orders\ShowOrder;
use App\Livewire\Driver\CreateDriver;
use App\Livewire\Driver\ListDriverFreigths;
use App\Livewire\Freight\ListFreight;
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


Route::get('/my-orders', \App\Livewire\Orders\ListOrders::class)
    ->middleware(['auth'])
    ->name('list.my.orders');

Route::get('/my-orders/{order}', \App\Livewire\Orders\ListOrders::class)
    ->middleware(['auth'])
    ->name('show.my.order');


Route::get('/orders', ListOrders::class)->middleware([AdminMiddleware::class,'auth'])->name('orders.list.admin');
Route::get('/orders/{order}', ShowOrder::class)->middleware([AdminMiddleware::class,'auth'])->name('orders.show.admin');
Route::get('/orders/{order}/freight', GenerateFrete::class)->middleware([AdminMiddleware::class,'auth'])->name('frete.create.admin');

Route::get('/freight/{freight}/map',[MapController::class,'show'])->middleware('auth')->name('freight.map');
Route::post('generate-map/{freight}',[MapController::class,'generateRoute'])->name('generate.map.admin');

Route::get('/address', CreateAddress::class)->middleware('auth')->name('address.store');

Route::get('driver', CreateDriver::class)->name('create.driver');

Route::get('freights', ListFreight::class)->middleware(DriverMiddleware::class,'auth')->name('freights.list');
Route::get('accept-freight/{freight}', AcceptFreigth::class)->middleware(DriverMiddleware::class,'auth')->name('accept.freight');
Route::get('freights-driver', ListDriverFreigths::class)->middleware(DriverMiddleware::class,'auth')->name('freights.driver');
Route::get('finish-freight/{freight}', FinishFreightController::class)->middleware(DriverMiddleware::class,'auth')->name('freights.driver.finish');
require __DIR__.'/auth.php';
