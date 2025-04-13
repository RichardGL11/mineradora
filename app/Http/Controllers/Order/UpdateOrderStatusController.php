<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Jobs\UpdateOrderStatusJob;
use App\Models\Order;
use Illuminate\Http\Request;

class UpdateOrderStatusController extends Controller
{
    public function __invoke(Request $request):void
    {
        $array = json_decode($request->getContent(),true);
        $order = Order::query()->where('external_id', $array['data']['billing']['id'])->firstOrFail();
        UpdateOrderStatusJob::dispatch($order);
    }
}
