<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Product;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inventories = Inventory::query()->latest()->get();
        return view('inventory.index', compact('inventories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();
        return view('inventory.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $products_inv = collect([]);
        $product = $request->product;
        $product_stock = $request->product_stock;
        $product_warehouse = $request->product_warehouse;

        for($i = 0; $i < count($product); $i++)
        {
            $products_inv->push([
                'name' => $product[$i],
                'product_stock' => $product_stock[$i],
                'product_warehouse' => $product_warehouse[$i],
            ]);
        }

        $inventories = Inventory::create([
//            'products_inv' => json_encode($products_inv),
            'products_inv' => $products_inv->toJson(),
            'cashes_inv' => 111,
        ]);

//        dd($product, $product_stock, $product_warehouse, $products_inv);

//        $products_inv = $data->
        $inventories = Inventory::query()->latest()->get();
        return view('inventory.index', compact('inventories'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Inventory $item)
    {
        $inventory = Inventory::find($item->id);
        $product = Product::find(1);
        return view('inventory.show', compact('inventory', 'product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Inventory $inventory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Inventory $inventory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inventory $item)
    {
//        dd($item);
        $item->delete();
        return redirect()->route('inventory.index');
    }
}
