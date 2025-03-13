<div>
    @forelse($this->orders as $order)
        <div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl m-5">
            <div class="p-8">
                <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">Order id: {{$order->id}}</div>
                <p class="block mt-1 text-lg leading-tight font-medium text-black">Created At {{\Carbon\Carbon::make($order->created_at)->format('d/m/y H:m:s')}}</p>
                <p class="mt-2 text-gray-500">Total Order R$: {{$order->total}}</p>
                <p class="block mt-1 mb-3 text-lg leading-tight font-medium text-black">Status: {{$order->status}}</p>
            </div>
        </div>
        @empty
        <p>You dont have orders yet</p>
    @endforelse
</div>
