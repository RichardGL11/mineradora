<?php

namespace App\Livewire\Admin\Orders;

use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ListOrders extends Component
{

    #[Computed]
    public function orders(): Collection
    {
        return Order::all();
    }
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.admin.orders.list-orders');
    }
}
