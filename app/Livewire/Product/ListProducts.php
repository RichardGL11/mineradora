<?php

namespace App\Livewire\Product;

use App\Models\Product;
use Illuminate\Contracts\Pagination\CursorPaginator;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class ListProducts extends Component
{
    use WithPagination;
    #[Computed]
    public function products(): CursorPaginator
    {
        return Product::query()->cursorPaginate(16);
    }

    public function Cart(Product $product):void
    {
        $this->dispatch('addToCart', ['product' => $product]);

    }
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.product.list-products');
    }
}
