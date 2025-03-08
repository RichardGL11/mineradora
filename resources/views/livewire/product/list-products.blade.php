<div class="flex-row columns-3">
    @forelse($this->products as $product)

        <div class="max-w-xs overflow-hidden bg-white rounded-lg shadow-lg dark:bg-gray-800 mb-1.5">
            <div class="px-4 py-2">
                <h1 class="text-xl font-bold text-gray-800 uppercase dark:text-white">{{$product->name}}</h1>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">{{$product->description}}</p>
            </div>

            <img class="object-cover w-full h-48 mt-2" src="{{$product->image}}" alt="NIKE AIR">

            <div class="flex items-center justify-between px-4 py-2 bg-gray-900">
                <h1 class="text-lg font-bold text-white">${{$product->price}}</h1>
                <button wire:click="Cart({{$product}})" class="px-2 py-1 text-xs font-semibold text-gray-900 uppercase transition-colors duration-300 transform bg-white rounded hover:bg-gray-200 focus:bg-gray-400 focus:outline-none">Add to cart</button>
            </div>
        </div>
    @empty
        <p>No Products</p>
    @endforelse
</div>
