<?php

namespace App\Livewire\Public\Destination;

use Livewire\Component;
use App\Models\Destination as DestinationModel;

class Destination extends Component
{
    public function render()
    {
        $destinations = DestinationModel::where('status', true)
            ->orderBy('name')
            ->get();

        return view('livewire.public.destination.destination', [
            'destinations' => $destinations,
        ]);
    }
}
