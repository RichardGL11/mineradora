<?php

namespace App\Actions\Order;

use App\Enums\OrderStatus;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Collection;

class CreateOrderAction
{
    public static function execute(Collection|Product $products, int $amount, string $id,string|int $user_id)
    {
        $order = Order::query()->create([
            'id' =>   $id,
            'user_id' => $user_id,
            'status' => OrderStatus::PENDING->value,
            'total' => $amount
        ]);


        $order->products()->attach(
            $products->mapWithKeys(function ($product) {
                return [$product->id => ['quantity' => $product->quantity]];
            })
        );
    }
}
