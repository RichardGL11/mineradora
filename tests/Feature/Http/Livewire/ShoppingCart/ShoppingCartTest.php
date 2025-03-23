<?php

use App\Livewire\ShoppingCart\ShoppingCart;
use App\Models\Address;
use App\Models\Order;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Http;
use Livewire\Livewire;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;
use function PHPUnit\Framework\assertTrue;

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
it('create an Order only if the user has an address', function () {
    Http::fake([
        config('services.abacatePay.url') => Http::response([
            "error" => null,
            "data" =>[
                "products" =>  [
                    0 => [
                        'name' => 'product name',
                        'description' => 'product description',
                        'quantity' => 1,
                        'price' => 480663
                    ]
                ],
                "amount" => 480663,
                "status" => "PENDING",
                "devMode" => true,
                "methods" => 'POST',
                "frequency" => "ONE_TIME",
                "allowCoupons" => false,
                "coupons" => [],
                "createdAt" => "2025-03-08T16:16:46.489Z",
                "updatedAt" => "2025-03-08T16:16:46.489Z",
                "couponsUsed" => [],
                "url" => "https://abacatepay.com/pay/bill_6xEyXSA5aKk23XkZrYNPyTze",
                "id" => "bill_6xEyXSA5aKk23XkZrYNPyTze"
            ]]),]);
    $product1 =\App\Models\Product::factory()->create(['price' => 5]);
    $product2 =\App\Models\Product::factory()->create(['price' => 200]);
    $userWithoutAddress = \App\Models\User::factory()->create();
    $userWithAddress = \App\Models\User::factory()->create();
    $address = Address::factory()->for($userWithAddress)->create();

   Livewire::actingAs($userWithoutAddress)
        ->test(ShoppingCart::class)
        ->call('addToCart', $product1)
        ->call('addToCart', $product2)
        ->call('createOrder');

    assertTrue(Gate::forUser($userWithoutAddress)
        ->denies('create', Order::class));

    assertDatabaseCount(Order::class,0);

    Livewire::actingAs($userWithAddress)
        ->test(ShoppingCart::class)
        ->call('addToCart', $product1)
        ->call('addToCart', $product2)
        ->call('createOrder');

    assertdatabaseCount(Order::class,1);
    assertDatabaseHas(Address::class,[
        'user_id' => $userWithAddress->id,
        'street' => $address->street,
        'city' => $address->city,
        'state' => $address->state,
        'number' => $address->number,
    ]);
    expect($userWithAddress->orders()->count())->toBe(1);

});
