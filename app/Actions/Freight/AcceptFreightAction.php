<?php

namespace App\Actions\Freight;

use App\Enums\FreightStatus;
use App\Models\Freight;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AcceptFreightAction
{
    public static function execute(Freight $freight):void
    {
        $driver = User::query()->where('id',Auth::id())->first();
        $ActiveFreights = Freight::query()->where('status','=',FreightStatus::TRANSIT->value)
                    ->where(function ($query) use ($driver) {
                             $query->where('driver_id','=',$driver->id);
                    })->count();
        if($ActiveFreights == 0)return;

        DB::transaction(function () use ($freight,$driver){
            $freight->driver_id = $driver->id;
            $freight->save();
        });
    }
}
