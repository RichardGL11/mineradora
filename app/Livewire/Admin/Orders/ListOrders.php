<?php

namespace App\Livewire\Admin\Orders;

use Livewire\Attributes\Layout;
use Livewire\Component;

class ListOrders extends Component
{
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.admin.orders.list-orders');
    }
}
