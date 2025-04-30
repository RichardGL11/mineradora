<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
    <!-- Grid de Produtos -->
        @forelse($this->products as $product)

        <div class="bg-white rounded-lg shadow-md overflow-hidden transition-transform hover:shadow-lg">
            <div class="h-48 w-full overflow-hidden">
                <img src="{{$product->image}}" alt="Minério de Ferro Premium" class="w-full h-full object-cover">
            </div>
            <div class="p-4 flex flex-col h-64 mb-3">
                <div class="mb-2">
                    <span class="inline-block px-2 py-1 text-xs font-semibold bg-blue-100 text-blue-900 rounded-full">Minérios Metálicos</span>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 product-title">{{$product->name}}</h3>
                <p class="text-sm text-gray-600 mt-2 product-description line-clamp-2 min-h-[40px]">
                    {{$product->description}}
                </p>
                <div class="mt-auto">
                    <div class="flex justify-between items-center mb-3">
                        <span class="text-primary font-bold text-lg">R${{$product->price}}</span>
                    </div>
                    <div class="flex space-x-2">
                        <button wire:click="Cart({{$product}})"  class="flex-1 bg-blue-900 hover:bg-blue-900 text-white font-medium py-2 px-4 rounded-lg transition duration-300 text-sm">
                            Add to Cart
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <p>No Products</p>
    @endforelse
    {{$this->products->links()}}
</div>
