<div class="flex-row columns-3">
    @forelse($this->products as $product)
        <div class="group overflow-hidden rounded-lg border border-gray-200 bg-white transition-all duration-300 hover:shadow-md h-full flex flex-col">
            <div class="relative aspect-square w-full overflow-hidden bg-gray-100 ">
                <img src="{{$product->image}}"
                     alt="Tênis Esportivo"
                     class="h-full w-full object-cover object-center transition-transform duration-300 group-hover:scale-105">
            </div>
            <div class="flex flex-col space-y-1.5 p-4 flex-grow ">
                <p class="text-xs text-gray-500">{{$product->name}}</p>
                <h3 class="text-sm font-medium text-gray-900 line-clamp-2 min-h-[40px]">{{$product->description}}</h3>
                <div class="flex items-center justify-between mt-auto pt-2between">
                    <p class="text-sm font-semibold text-gray-900">${{$product->price}}</p>
                    <button wire:click="Cart({{$product}})" class="rounded-md bg-gray-900 px-3 py-1.5 text-xs font-medium text-white transition-colors hover:bg-gray-800">
                        Add to Cart
                    </button>
                </div>
            </div>
        </div>
    @empty
        <p>No Products</p>
    @endforelse
</div>
