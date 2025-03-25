<?php

namespace App\Http\Controllers\Driver;

use App\Actions\Freight\AcceptFreightAction;
use App\Http\Controllers\Controller;
use App\Models\Freight;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AcceptFreigth extends Controller
{
    public function __invoke(Freight $freight): RedirectResponse
    {
        AcceptFreightAction::execute($freight);
        return redirect()->to(route('freights.driver'));
    }
}
