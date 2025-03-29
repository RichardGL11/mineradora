<?php

namespace App\Listeners;

use App\Events\OrderDeliveredEvent;
use App\Models\Wallet;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class DriverWalletUpdateAmountListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OrderDeliveredEvent $event): void
    {
       $wallet =  Wallet::query()->where('driver_id','=',$event->freight->driver->id)->first();
        DB::Transaction(function () use ($event,$wallet) {
            $wallet->amount += $event->freight->price;
            $wallet->save();
        });
    }
}
