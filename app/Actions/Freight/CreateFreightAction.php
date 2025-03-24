<?php

namespace App\Actions\Freight;

use App\Enums\FreightStatus;
use App\Models\Freight;
use App\Models\Order;

class CreateFreightAction
{
    public static function execute(Order $order, string $price)
    {
        Freight::query()->create([
            'order_id'       => $order->id,
            'user_id'        => $order->user->id,
            'status'         => FreightStatus::TRANSIT ,
            'products_price' => $order->total,
            'price'          => (float) $price,
        ]);
    }
}
