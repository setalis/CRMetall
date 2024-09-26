<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class ShipmentCreate extends Component
{
    public $products = [];
    public $shipmentProducts = [];

    public function mount(){
        $this->products = Product::all();
        $this->shipmentProducts = [
            ['product_id'=>'', 'weight_shipment_product'=>'' ]
        ];
    }

    public function addProduct(){
        $this->shipmentProducts[] = ['product_id'=>'', 'weight_shipment_product'=>''];
    }
    public function deleteProduct($key){
        unset($this->shipmentProducts[$key]);
        $this->shipmentProducts = array_values($this->shipmentProducts);
    }
    public function render()
    {
        return view('livewire.shipment-create');
    }
}
