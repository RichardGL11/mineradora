<?php

namespace App\Actions\Order;

use App\Enums\OrderStatus;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class UpdateOrderStatusAction
{
    public static function execute(Order $order):void
    {
        DB::transaction(function () use ($order) {
            $order->status = OrderStatus::PAYED->value;
            $order->save();
        });
    }
}
