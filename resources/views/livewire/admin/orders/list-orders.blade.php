<div>
    @forelse($this->orders as $order)
        <div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl m-5">
            <div class="p-8">
                <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">Order id: {{$order->id}}</div>
                <p class="block mt-1 text-lg leading-tight font-medium text-black">Created At {{\Carbon\Carbon::make($order->created_at)->format('d/m/y H:m:s')}}</p>
                <p class="mt-2 text-gray-500">Total Order R$: {{$order->total}}</p>
                <p class="mt-2 text-gray-500">Client:{{$order->user->name}}.</p>
                <p class="block mt-1 mb-3 text-lg leading-tight font-medium text-black">Status: {{$order->status}}</p>
                <a href="{{route('orders.show.admin', $order)}}" class="mt-2 px-6 py-2 font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-blue-600 rounded-lg hover:bg-blue-500 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-80">
                    See details
                </a>
            </div>
        </div>
    @empty
        <p>There is no order yet</p>
    @endforelse

</div>
