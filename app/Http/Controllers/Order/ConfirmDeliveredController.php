<?php

namespace App\Http\Controllers\Order;

use App\Events\OrderDeliveredEvent;
use App\Http\Controllers\Controller;
use App\Models\Freight;
use App\Notifications\OrderDelivered;
use Illuminate\Http\RedirectResponse;

class ConfirmDeliveredController extends Controller
{
    public function __invoke(Freight $freight):RedirectResponse
    {
        OrderDeliveredEvent::dispatch($freight);
        return redirect('/dashboard');
    }
}
