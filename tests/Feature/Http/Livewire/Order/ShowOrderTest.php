<?php

use App\Livewire\Orders\ShowOrder;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Livewire\Livewire;

it('should see all the details about my order', function () {
    $user = User::factory()->create();
    $order =  Order::factory()
        ->hasAttached(
            Product::factory()->count(5),
            ['quantity' => rand(1,20),]
        )
        ->create();

    $livewire = Livewire::actingAs($user)
        ->test(ShowOrder::class,['order' => $order])
        ->assertSet('order', $order)
        ->assertHasNoErrors();

    $livewire->assertSee($order->id);
    $livewire->assertSee($order->status);
  $livewire->assertSee(\Carbon\Carbon::make($order->created_at)->format('d/m/y H:m:s'));
    $livewire->assertSee($order->total);

    $order->products()->each(function ($product) use ($livewire) {
       $livewire->assertSee($product->pivot->quantity);
       $livewire->assertSee($product->name);
       $livewire->assertSee($product->price);
       $livewire->assertSee($product->photo);

    });
});
