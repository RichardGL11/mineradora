<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="max-w-xl">
                <section>
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Register Address') }}
                        </h2>
                    </header>

                    <form wire:submit="save"class="mt-6 space-y-6">
                        <div>
                            <x-input-label for="cep" :value="__('CEP')" />
                            <x-text-input wire:model.live.lazy="cep"  type="text" class="mt-1 block w-full" autocomplete="CEP" />
                            @if (session('error'))
                                <div class="alert alert-warning">
                                    {{ session('error') }}
                                </div>
                            @endif
                        </div>

                        <div>
                            <x-input-label for="street" :value="__('Street')" />
                            <x-text-input wire:model.live="street" type="text" class="mt-1 block w-full" />
                            <x-input-error :messages="$errors->get('street')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="number" :value="__('Number')" />
                            <x-text-input wire:model="number" type="number" class="mt-1 block w-full" />
                            <x-input-error :messages="$errors->get('number')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="neighborhood" :value="__('Neighborhood')" />
                            <x-text-input wire:model.live="neighborhood" id="neighborhood" name="neighborhood" type="text" class="mt-1 block w-full" />
                            <x-input-error :messages="$errors->get('neighborhood')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="city" :value="__('City')" />
                            <x-text-input wire:model.live="city" id="city" name="city" type="text" class="mt-1 block w-full" />
                            <x-input-error :messages="$errors->get('city')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="state" :value="__('State')" />
                            <x-text-input wire:model.live="state" id="state" name="state" type="text" class="mt-1 block w-full" />
                            <x-input-error :messages="$errors->get('state')" class="mt-2" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Save') }}</x-primary-button>

                            <x-action-message class="me-3" on="password-updated">
                                {{ __('Saved.') }}
                            </x-action-message>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</div>
