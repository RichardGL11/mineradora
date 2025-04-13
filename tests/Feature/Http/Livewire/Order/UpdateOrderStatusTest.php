<?php

use App\Enums\OrderStatus;
use App\Models\Order;
use function Pest\Laravel\postJson;

it('should update order status by webhook payload', function () {
    $order = Order::factory()->create([
       'status' => OrderStatus::PENDING,
       'external_id'=> "bill_pzxKC0GDqRtKz42fgFue2Lz6"
   ]);
    $payload = [ "data" => [
       "billing" => [
           "amount" => 7400,
           "couponsUsed" => [
           ],
           "customer" => [
               "id" => "cust_qgBsXKrt1CwSQgQmrngH6uj6",
               "metadata" => [
                   "cellphone" => "1111111111",
                   "email" => "test@example.com",
                   "name" => "Test User",
                   "taxId" => "94685349016"
               ]
           ],
           "frequency" => "ONE_TIME",
           "id" => "bill_pzxKC0GDqRtKz42fgFue2Lz6",
           "kind" => [
               "PIX"
           ],
           "paidAmount" => 7400,
           "products" => [
               [
                   "externalId" => "34",
                   "id" => "prod_XTnjRWEF26qbNwXLDmf5N651",
                   "quantity" => 2
               ]
           ],
           "status" => "PAID"
       ],
       "payment" => [
           "amount" => 7400,
           "fee" => 80,
           "method" => "PIX"
       ]
   ],
       "devMode" => true,
       "event" => "billing.paid"
   ];

    postJson(route('webhook'),$payload);

    $order->refresh();
    expect($order->status)->toBe(OrderStatus::PAYED);
});
