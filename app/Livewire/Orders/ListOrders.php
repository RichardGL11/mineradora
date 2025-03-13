<?php

namespace App\Livewire\Orders;

use App\Models\Order;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ListOrders extends Component
{
    #[Computed]
    public function orders():Collection
    {
        return Order::query()->where('user_id', auth()->id())->with('products')->get();
    }
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.orders.list-orders');
    }
}
