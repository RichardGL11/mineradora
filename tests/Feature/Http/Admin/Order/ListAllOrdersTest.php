<?php

use App\Models\Order;
use App\Models\Product;
use function Pest\Laravel\actingAs;

test('normal users cant see all the orders that have been placed', function () {

    actingAs(\App\Models\User::factory()->create());
    $request = \Pest\Laravel\get(route('orders.list.admin'));
    $request->assertStatus(403);
});

test('only administrators can see all the orders that have been placed', function () {
   $orders =  Order::factory(10)
        ->hasAttached(
            Product::factory()->count(5),
            ['quantity' => rand(1,20),]
        )
        ->create();

    actingAs(\App\Models\User::factory()->admin()->create());
    $request = \Pest\Laravel\get(route('orders.list.admin'));
    $request->assertStatus(200);

   $orders->each(function ($order) use ($request) {
       $request->assertSee($order->id);
       $request->assertSee($order->status);
       $request->assertSee($order->total);
       $request->assertSee(\Carbon\Carbon::make($order->created_at)->format('d/m/y H:m:s'));
       $request->assertSee($order->user->name);
   });
});
