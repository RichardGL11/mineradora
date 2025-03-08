<?php

namespace App\Actions;

use App\Enums\OrderStatus;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class CreateOrderAction
{
    public static function execute(Collection|Product $products, int $amount)
    {
        $order = Order::query()->create([
            'user_id' => Auth::id(),
            'status' => OrderStatus::PENDING->value,
            'total' => $amount
        ]);

        $order->products()->attach(
            $products->pluck('id')->mapWithKeys(function ($id, $index) use ($products) {
                return [$id => ['quantity' => $products[$index]->quantity]];
            })
        );
    }
}
