<?php

namespace App\Livewire\Product;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ListProducts extends Component
{
    #[Computed]
    public function products():Collection
    {
        return Product::all();
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.product.list-products');
    }
}
