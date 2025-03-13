<?php

namespace App\Livewire\Orders;

use App\Models\Order;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ShowOrder extends Component
{
    public Order $order;

    public function mount(Order $order):void
    {
        $this->order = $order->load('products');
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.orders.show-order');
    }
}
