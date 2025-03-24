<?php

namespace App\Livewire\Freight;

use App\Models\Freight;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ListFreight extends Component
{
    #[Computed]
    public function freights():Collection
    {
        return Freight::query()->where('driver_id','=',null)->get();
    }
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.freight.list-freight');
    }
}
