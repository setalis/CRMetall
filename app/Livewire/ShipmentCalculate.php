<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\Shipment;
use Livewire\Component;

class ShipmentCalculate extends Component
{
    public $item_shipment = [];
    public $items = [];
    public $data_shipment_now;
    public $shipment_previous;
    public $data_shipment_previous;

    public $weight_calculate;
    public $price_calculate;

    public function mount($item){

        $this->item_shipment = Shipment::find($item);
        $this->data_shipment_now = $this->item_shipment->created_at;
        $this->shipment_previous = Shipment::where('id', '<', $item)->latest('id')->first();
        $this->data_shipment_previous = $this->shipment_previous->created_at;


        $this->items = $this->item_shipment->items;
        $this->weight_calculate = [''];

    }

    public function render()
    {
        return view('livewire.shipment-calculate');
    }
}
