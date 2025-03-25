<?php

namespace App\Livewire\Freight;

use App\Models\Freight;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ListDriverFreigths extends Component
{
    #[Computed]
    public function freights():Collection
    {
        return Freight::query()->where('driver_id', Auth::id())->get();
    }

    #[Layout('layouts.app')]
    public function render():View
    {
        return view('livewire.freight.list-driver-freigths');
    }
}
