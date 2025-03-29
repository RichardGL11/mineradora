<?php

namespace App\Jobs;

use App\Actions\Order\CreateOrderAction;
use App\Models\Product;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class CreateOrderJob implements ShouldQueue
{
    use Queueable;
    private readonly string|int $user_id;

    /**
     * Create a new job instance.
     */
    public function __construct(private readonly Collection|Product $product, private readonly int $amount,private readonly string $id)
    {
        $this->user_id = Auth::id();
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        CreateOrderAction::execute($this->product, $this->amount,$this->id, $this->user_id);
    }
}
