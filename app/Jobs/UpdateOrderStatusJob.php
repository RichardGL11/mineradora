<?php

namespace App\Jobs;

use App\Actions\Order\UpdateOrderStatusAction;
use App\Models\Order;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class UpdateOrderStatusJob implements ShouldQueue
{
    use Queueable;
    public function __construct(private readonly Order $order)
    {}

    public function handle(): void
    {
        UpdateOrderStatusAction::execute($this->order);
    }
}
