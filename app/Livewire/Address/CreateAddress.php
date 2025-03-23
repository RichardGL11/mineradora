<?php

namespace App\Livewire\Address;

use App\Models\Address;
use Illuminate\Support\Arr;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Features\SupportRedirects\Redirector;

class CreateAddress extends Component
{
    #[Validate('required|string|min:8|max:8')]
    public ?string $cep = null;
    #[Validate('required|string|min:3|max:255')]
    public ?string $street = null;
    #[Validate('required|string|min:3|max:255')]
    public ?string $neighborhood = null;
    #[Validate('required|string|min:3|max:255')]
    public ?string $city = null;
    #[Validate('required|string|size:2')]
    public ?string $state = null;
    #[Validate('required|string|min:1')]
    public ?string $number = null;
    public function updatedCep(string $cep)
    {
        session()->remove('error');
        $http = \Illuminate\Support\Facades\Http::get("https://viacep.com.br/ws/$cep/json/")->json();
        if(Arr::has($http,'erro') or $http == null){
            $this->resetExcept($this->cep);
           return  session()->flash('error','CEP does not exists');
        }
        $this->cep = $cep;
        $this->street = $http['logradouro'];
        $this->neighborhood = $http['bairro'];
        $this->city = $http['localidade'];
        $this->state = $http['uf'];
    }

    public function save():Redirector
    {
        $this->validate();
        Address::query()->create([
            'cep' => $this->cep,
            'street' => $this->street,
            'neighborhood' => $this->neighborhood,
            'city' => $this->city,
            'state' => $this->state,
            'number' => (int) $this->number,
            'user_id' => auth()->user()->id
        ]);
        return redirect()->to('/dashboard');
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.address.create-address');
    }
}
