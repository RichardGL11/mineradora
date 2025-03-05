<?php

namespace App\Livewire\Product;

use App\Models\Product;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateProduct extends Component
{
    use WithFileUploads;
    #[Validate('bail|required|string|min:3|max:255')]
    public string $name;
    #[Validate('required|string|min:3|max:255')]
    public string $description;
    #[Validate('required|numeric|gt:0')]
    public int|float|string $price;
    #[Validate('nullable|file|mimes:jpg,jpeg,png,gif')]
    public mixed $image = null;

    public function save()
    {

        $this->validate();

        Product::query()->create([
            'name'           => $this->name,
            'description'    => $this->description,
            'price'          => $this->price,
            'image'          => $this->image,
        ]);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.product.create-product');
    }
}
