<?php

use App\Livewire\ShoppingCart\ShoppingCart;
use Livewire\Livewire;
use function Pest\Laravel\actingAs;

it('should add a product to the shopping cart',function() {
    $product1 =\App\Models\Product::factory()->create();
    $product2 =\App\Models\Product::factory()->create();
   $livewire = Livewire::actingAs(\App\Models\User::factory()->create())
    ->test(ShoppingCart::class)
    ->call('addToCart', $product1)
    ->call('addToCart', $product2);

    $request = \Pest\Laravel\get('/shopping-cart');


   $request->assertSee($product1->name);
   $request->assertSee($product1->price);
   $request->assertSee($product1->description);
   $request->assertSee($product2->name);
   $request->assertSee($product2->price);
   $request->assertSee($product2->description);

});

it('should remove a product to the shopping cart',function() {
    $product1 =\App\Models\Product::factory()->create();
    $product2 =\App\Models\Product::factory()->create();

   $livewire = Livewire::actingAs(\App\Models\User::factory()->create())
    ->test(ShoppingCart::class)
    ->call('addToCart', $product1)
    ->call('addToCart', $product2);
    $request = \Pest\Laravel\get('/shopping-cart');

    $request->assertSee($product1->name);
    $request->assertSee($product1->price);
    $request->assertSee($product1->description);
    $request->assertSee($product2->name);
    $request->assertSee($product2->price);
    $request->assertSee($product2->description);

   $livewire->call('removeFromCart', $product1->id);
   $livewire->assertdontsee($product1->name);
   $livewire->assertdontsee($product1->description);
});
test('Only the user can see their shopping Cart',function() {
    $product1 =\App\Models\Product::factory()->create();
    $product2 =\App\Models\Product::factory()->create();
    $user1 = \App\Models\User::factory()->create();
    $user2 = \App\Models\User::factory()->create();

    actingAs($user1);

   $livewire = Livewire::test(ShoppingCart::class)
    ->call('addToCart', $product1)
    ->call('addToCart', $product2);
    $request = \Pest\Laravel\get('/shopping-cart');


    $request->assertSee($product1->name);
    $request->assertSee($product1->price);
    $request->assertSee($product1->description);
    $request->assertSee($product2->name);
    $request->assertSee($product2->price);
    $request->assertSee($product2->description);

    $livewire2 = Livewire::actingAs($user2)
                ->test(ShoppingCart::class);

    $livewire2->assertDontSee($product1->name);
    $livewire2->assertDontSee($product1->price);
    $livewire2->assertDontSee($product1->description);
    $livewire2->assertDontSee($product2->name);
    $livewire2->assertDontSee($product2->price);
    $livewire2->assertDontSee($product2->description);

});

test('calculates the total of the shopping cart products', function () {
    $product1 =\App\Models\Product::factory()->create(['price' => 5]);
    $product2 =\App\Models\Product::factory()->create(['price' => 200]);

    $livewire = Livewire::actingAs(\App\Models\User::factory()->create())
        ->test(ShoppingCart::class)
        ->call('addToCart', $product1)
        ->call('addToCart', $product2);
    $request = \Pest\Laravel\get('/shopping-cart');


    $request->assertSee($product1->name);
    $request->assertSee($product1->price);
    $request->assertSee($product1->description);
    $request->assertSee($product2->name);
    $request->assertSee($product2->price);
    $request->assertSee($product2->description);

    $total = ($product1->price + $product2->price);
    $request->assertSee($total);
});
