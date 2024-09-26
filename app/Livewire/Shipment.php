<?php

namespace App\Livewire;

use Livewire\Component;
//use App\Models\Shipment;

class Shipment extends Component
{
    public $shipments = [];
    public $shipment = '';

    public function mount(){
        $this->shipments = \App\Models\Shipment::all();
    }

    public function render()
    {
        return view('livewire.shipment');
    }
}
