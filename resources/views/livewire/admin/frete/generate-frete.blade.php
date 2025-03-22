<div>
    @if(!is_null($this->fretes))
    @foreach($this->fretes as $frete)
            <div class="max-w-xs overflow-hidden bg-white rounded-lg shadow-lg dark:bg-gray-800 mb-1.5">
                <div class="px-4 py-2">
                    <h1 class="text-xl font-bold text-gray-800 uppercase dark:text-white">Option:<strong>{{$frete['name']}}</strong></h1>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Price R$:{{$frete['price']}}</p>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Price With Discount R$:{{$frete['discount']}}</p>
                </div>


                <div class="flex items-center justify-between px-4 py-2 bg-gray-900">
                    <button wire:click="createFreteOrder({{$frete['price']}})" class="px-2 py-1 text-xs font-semibold text-gray-900 uppercase transition-colors duration-300 transform bg-white rounded hover:bg-gray-200 focus:bg-gray-400 focus:outline-none">Create Frete</button>
                </div>
            </div>

    @endforeach
    @else
        <a wire:click="generateFrete()">Clique para gerar fretes</a>
    @endif
</div>
