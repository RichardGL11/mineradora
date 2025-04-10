<?php

use App\Console\Commands\GeneratePaymentCommand;
use App\Enums\OrderStatus;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;

it('should be able to create an order', function () {
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

    actingAs(\App\Models\User::factory()->create());

    $product = \App\Models\Product::factory(10)->create();
    app(GeneratePaymentCommand::class)->handle($product);

    assertDatabaseCount(Order::class, 1);
    assertDatabaseHas(Order::class, [
       'user_id' => Auth::id(),
       'external_id' => 'bill_6xEyXSA5aKk23XkZrYNPyTze',
       'status'  => OrderStatus::PENDING->value,
       'total'   =>  480663
    ]);

    assertDatabaseCount('order_product',10);

    $product->each(function ($product) {
        assertDatabaseHas('order_product',[
            'product_id' => $product->id,
            'quantity'   => $product->quantity
        ]);
    });
});

