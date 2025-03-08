<?php

use App\Livewire\ShoppingCart\ShoppingCart;
use Livewire\Livewire;

it('should add a product to the shopping cart',function() {
    $product1 =\App\Models\Product::factory()->create();
    $product2 =\App\Models\Product::factory()->create();

   $livewire = Livewire::actingAs(\App\Models\User::factory()->create())
    ->test(ShoppingCart::class)
    ->call('addToCart', $product1)
    ->call('addToCart', $product2);

   $livewire->assertSee($product1->name);
   $livewire->assertSee($product1->price);
   $livewire->assertSee($product1->description);
   $livewire->assertSee($product2->name);
   $livewire->assertSee($product2->price);
   $livewire->assertSee($product2->description);

});

it('should remove a product to the shopping cart',function() {
    $product1 =\App\Models\Product::factory()->create();
    $product2 =\App\Models\Product::factory()->create();

   $livewire = Livewire::actingAs(\App\Models\User::factory()->create())
    ->test(ShoppingCart::class)
    ->call('addToCart', $product1)
    ->call('addToCart', $product2);

   $livewire->assertSee($product1->name);
   $livewire->assertSee($product1->price);
   $livewire->assertSee($product1->description);
   $livewire->assertSee($product2->name);
   $livewire->assertSee($product2->price);
   $livewire->assertSee($product2->description);

   $livewire->call('removeFromCart', $product1->id);
   $livewire->assertdontsee($product1->name);
   $livewire->assertdontsee($product1->description);
});
