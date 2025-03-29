<?php

namespace App\Events;

use App\Models\Freight;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrderDeliveredEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public Freight $freight)
    {}
}
