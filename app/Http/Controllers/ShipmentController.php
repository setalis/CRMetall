<?php

namespace App\Http\Controllers;

use App\Models\Operation;
use App\Models\Product;
use App\Models\Shipment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shipments = Shipment::query()
            ->latest()
            ->paginate(10);
        $operations = Operation::query()->where('type', 6)->get();

        return view('shipment.index', compact('shipments', 'operations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();
        return view('shipment.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $items_collect = collect([]);
        foreach ($request->shipmentProducts as $key => $item){
            $items_collect->push([
                'shipmentProducts' => $request->shipmentProducts[$key],
                'weightShipmentProduct' => $request->weightShipmentProduct[$key],
            ]);
        }
        $shipment = Shipment::create([
            'items' => $items_collect,
        ]);

        foreach ($items_collect as $prod){
            $product = Product::find($prod['shipmentProducts']);
            $product->count -= $prod['weightShipmentProduct'];
            $product->save();
        }

        $comment = $request->comment;
        $operation = Operation::create([
            'type' => 6,
            'user_id' => Auth::user()->id,
            'cart_id' => '',
            'products' => '',
            'sum' => '',
            'comment' => $comment,
            'status' => 1,
        ]);

        return redirect()->route('shipment.index');
    }

    public function calculate(Shipment $item)
    {
        $data_shipment_now = $item->created_at;
        $shipment_previous = Shipment::where('id', '<', $item->id)->latest('id')->first();
        $data_shipment_previous = $shipment_previous->created_at;

        return view('calculate.create', compact('item', 'data_shipment_now', 'shipment_previous', 'data_shipment_previous'));
    }


    /**
     * Display the specified resource.
     */
    public function show(Shipment $shipment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Shipment $shipment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Shipment $shipment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shipment $shipment)
    {
        //
    }
}
