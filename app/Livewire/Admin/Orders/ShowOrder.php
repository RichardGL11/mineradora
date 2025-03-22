<?php

namespace App\Livewire\Admin\Orders;

use App\Console\Commands\GenerateFreteCommand;
use App\Models\Order;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ShowOrder extends Component
{
    public Order $order;

    public function mount(Order $order):void
    {
        $this->order = $order->load('user')->load('products');
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.admin.orders.show-order');
    }
}
