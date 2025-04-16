<?php

namespace App\Livewire\Driver;

use App\Jobs\RequestPaymentJob;
use App\Models\Wallet;
use App\Services\PaymentGateway\Asaas\Enums\PixKeyTypeEnum;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Component;

class RequestPayment extends Component
{
    public Wallet $wallet;
    public  $cases;
    public PixKeyTypeEnum $type;
    public string $key;
    public float $amount;

    public function mount():void
    {
        $wallet = Wallet::query()->where('driver_id',Auth::id())->firstOrFail();
        $this->wallet = $wallet;
        $this->cases = PixKeyTypeEnum::cases();
    }

    public function requestPayment(): Redirector|RedirectResponse|null
    {
        $this->validate([
            'key' => 'required|string',
            'amount' => 'required|numeric',
            'type' => ['required', Rule::enum(PixKeyTypeEnum::class)],
        ]);

        if ((float)$this->wallet->amount < $this->amount) {
            return session()->flash('amount','Insuficient Amount');
        }

        RequestPaymentJob::dispatch(wallet:$this->wallet,pixKeyType:$this->type,amount:$this->amount,key:$this->key);
        return redirect('/dashboard');
    }
    #[Layout('layouts.app')]
    public function render(): View
    {
        return view('livewire.driver.request-payment');
    }
}
