<?php

use App\Enums\OrderStatus;
use App\Livewire\Admin\Orders\ShowOrder;
use App\Models\Order;
use App\Models\Product;
use Livewire\Livewire;

it('should be able to see the details about an Order', function() {
    $order =  Order::factory()
        ->hasAttached(
            Product::factory()->count(5),
            ['quantity' => rand(1,20),]
        )
        ->create();
    $livewire = Livewire::actingAs(\App\Models\User::factory()->admin()->create())
        ->test(ShowOrder::class,['order' => $order]);

    $order->products->each(function($product) use ($livewire) {
        $livewire->assertSee($product->name);
        $livewire->assertSee($product->pivot->quantity);
        $livewire->assertSee($product->price);
    });
    $livewire->assertSee($order->total);
    $livewire->assertSee($order->status);
});

it('can see the frete button if the order has PAYED status',function() {
    $order =  Order::factory()
        ->hasAttached(
            Product::factory()->count(5),
            ['quantity' => rand(1,20),]
        )->create(['status' => OrderStatus::PAYED]);

    $livewire = Livewire::actingAs(\App\Models\User::factory()->admin()->create())
        ->test(ShowOrder::class,['order' => $order]);

    $livewire->assertSeeHtml('Generate Frete');
});
