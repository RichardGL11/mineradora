<?php

namespace App\Livewire\Admin\Frete;

use App\Actions\CreateFreightAction;
use App\Console\Commands\GenerateFreteCommand;
use App\Models\Order;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Collection;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

class GenerateFrete extends Component
{
    public Order $order;
    public Collection|null $fretes = null;

    public function generateFrete():void
    {
        $fretes = app(GenerateFreteCommand::class)->handle($this->order->products);
        $this->fretes = $fretes;
        $this->dispatch('reload');
    }

    public function createFreteOrder(string $price):void
    {
        CreateFreightAction::execute(order:$this->order,price: $price);
    }

    #[On('reload')]
    #[Layout('layouts.app')]
    public function render():View
    {
        return view('livewire.admin.frete.generate-frete');
    }
}
