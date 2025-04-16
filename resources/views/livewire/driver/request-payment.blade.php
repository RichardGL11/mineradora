<div>
    <section class="max-w-4xl p-6 mx-auto bg-white rounded-md shadow-md dark:bg-gray-800">
        <h2 class="text-lg font-semibold text-gray-700 capitalize dark:text-white">Generate a Request</h2>
        <h2 class="text-lg font-semibold text-gray-700 capitalize dark:text-white">Your Amount: {{$this->wallet->amount}}</h2>
        <form wire:submit="requestPayment()">
            <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
                <div>
                    <label class="text-gray-700 dark:text-gray-200" for="username">Key</label>
                    <input wire:model="key" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                    <x-input-error :messages="$errors->get('key')" class="mt-2" />
                </div>
                <div>
                    <label class="text-gray-700 dark:text-gray-200" for="emailAddress">Amount</label>
                    <input wire:model="amount" id="emailAddress" type="number" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                    <x-input-error :messages="$errors->get('amount')" class="mt-2" />
                </div>
            </div>
            <select wire:model="type" class="mt-2">
                <option value="">Select...</option>
                @foreach ($cases as $case)
                    <option value="{{ $case->value }}">
                        {{ $case->name }}
                    </option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('type')" class="mt-2" />
            @if (session('amount'))
                <div class="text-red-500">
                    {{ session('amount') }}
                </div>
            @endif
            <div class="flex justify-end mt-6">
                <button class="px-8 py-2.5 leading-5 text-white transition-colors duration-300 transform bg-gray-700 rounded-md hover:bg-gray-600 focus:outline-none focus:bg-gray-600">Save</button>
            </div>

        </form>
    </section>
</div>
