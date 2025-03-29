<?php

namespace App\Actions\Freight;

use App\Enums\FreightStatus;
use App\Models\Freight;
use Illuminate\Support\Facades\DB;

class FinishFreightAction
{
    public static function execute(Freight $freight):void
    {
        DB::Transaction(function () use ($freight) {
            $freight->status = FreightStatus::DONE;
            $freight->save();
        });
    }
}
