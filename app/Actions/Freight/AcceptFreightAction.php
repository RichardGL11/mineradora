<?php

namespace App\Actions\Freight;

use App\Models\Freight;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AcceptFreightAction
{
    public static function execute(Freight $freight):void
    {
        $driver = User::query()->where('id',Auth::id())->first();
        DB::transaction(function () use ($freight,$driver){
            $freight->driver_id = $driver->id;
            $freight->save();
        });
    }
}
