<div>
    <section class="container px-4 mx-auto mt-3">
        <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">Order id: {{$order->id}}</div>
        <p class="block mt-1 text-lg leading-tight font-medium text-black">Created At {{\Carbon\Carbon::make($order->created_at)->format('d/m/y H:m:s')}}</p>
        <p class="mt-2 text-gray-500">Client:{{$order->user->name}}.</p>
        <p class="block mt-1 mb-3 text-lg leading-tight font-medium text-black">Status: {{$order->status}}</p>


        <div class="flex items-center gap-x-3 justify-between">
            <h2 class="text-lg font-medium text-gray-800  dark:text-Black">Products</h2>

            <span class="px-3 py-1 text-lg text-blue-600 bg-blue-100 rounded-full dark:bg-gray-800 dark:text-blue-400 py-1" >Total: R$ {{$order->total}}</span>
        </div>

        <div class="flex flex-col mt-6">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <div class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-800">
                            <tr>
                                <th scope="col" class="py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    <div class="flex items-center gap-x-3">

                                        <span>Name</span>
                                    </div>
                                </th>

                                <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">Quantity</th>

                                <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">Price</th>

                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                            @foreach($this->order->products as $product)
                                <tr>
                                    <td class="px-4 py-4 text-sm font-medium text-gray-700 whitespace-nowrap">
                                        <div class="inline-flex items-center gap-x-3">

                                            <div class="flex items-center gap-x-2">
                                                <img wire:key="{{$product->photo}}" class="object-cover w-10 h-10 rounded-full" src="{{$product->photo}}" alt="">
                                                <div>
                                                    <h2 wire:key="{{$product->name}}"class="font-medium text-gray-800 dark:text-white ">{{$product->name}}</h2>
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td wire:key="{{$product->quantity}}" class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">{{$product->pivot->quantity}}</td>
                                    <td wire:key="{{$product->price}}" class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                                        R$ {{$product->price}}</td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @if($order->status === \App\Enums\OrderStatus::PAYED)
        <div class="flex items-center justify-end mt-6">

            <a wire:click="generateFrete()" class="flex items-center px-5 py-2 text-sm text-gray-700 capitalize transition-colors duration-200 bg-white border rounded-md gap-x-2 hover:bg-gray-100 dark:bg-gray-900 dark:text-gray-200 dark:border-gray-700 dark:hover:bg-gray-800">
                <button>
                    Generate Frete
                </button>

                <svg  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 rtl:-scale-x-100">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                </svg>
            </a>
        </div>
        @endif
    </section>

</div>
