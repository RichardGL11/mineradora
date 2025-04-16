<?php

namespace App\Jobs;

use App\Models\Wallet;
use App\Services\PaymentGateway\Asaas\AsaasService;
use App\Services\PaymentGateway\Asaas\Enums\PixKeyTypeEnum;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class RequestPaymentJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(private readonly Wallet $wallet, private readonly PixKeyTypeEnum $pixKeyType,private readonly float $amount,private readonly string $key)
    {}

    /**
     * Execute the job.
     */
    public function handle(AsaasService $service): void
    {
        $service->payPix(pixType: $this->pixKeyType,value: $this->amount,wallet: $this->wallet,key: $this->key);
    }
}
