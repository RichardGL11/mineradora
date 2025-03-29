<?php

namespace App\Http\Controllers\Driver;

use App\Actions\Freight\FinishFreightAction;
use App\Http\Controllers\Controller;
use App\Models\Freight;
use App\Notifications\OrderDelivered;
use Illuminate\Http\RedirectResponse;

class FinishFreightController extends Controller
{
    public function __invoke(Freight $freight): RedirectResponse
    {
       FinishFreightAction::execute($freight);
       $freight->user->notify(New OrderDelivered($freight));
       return redirect()->route('freights.driver');
    }
}
