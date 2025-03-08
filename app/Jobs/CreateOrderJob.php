<?php

namespace App\Jobs;

use App\Actions\CreateOrderAction;
use App\Models\Product;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Collection;

class CreateOrderJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(private readonly Collection|Product $product, private readonly int $amount)
    {
        $this->handle();
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        CreateOrderAction::execute($this->product, $this->amount);
    }
}
