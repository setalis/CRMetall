<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Cash;
use App\Models\Operation;
use App\Models\Product;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Http\Request;

class OperationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $operations = Operation::query()
            ->latest()
            ->paginate(10);

        return view('operation.index', compact('operations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Operation $operation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Operation $operation)
    {
        $products = Product::query()->get();
        $carts = $operation->cart()->get();
        return view('operation.edit', compact('operation', 'carts', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Operation $operation)
    {
//        dump($request);

        $cart_id = $request->cartId;
        $user_id = $request->user_id;
        $type = $request->type;
        $client = $request->client;
        $product_id = $request->product_id;
        $uniq_id = $request->uniq_id;
        $name = $request->name;
        $price = $request->price;
        $dirt = $request->dirt;
        $weight = $request->weight;
        $weight_stock = $request->weight_stock;
        $sum = $request->sum;
        $sumCart = $request->summaryCart;
        $comment = $request->comment;
        $status = $request->status;
        $operation_id = $operation->id;

        $carts = Cart::query()->where('cart_id', $cart_id)->get();

        $operation->type = $type;
        $operation->user_id = $user_id;
        $operation->cart_id = $cart_id;
        $operation->products = '';
        $operation->sum = $sumCart;
        $operation->comment = $comment;
        $operation->status = $status;

        $operation->save();

        foreach ($carts as $key => $item){

            //update Cart item

            $cart = Cart::find($item->id);
            $product = Product::find($cart->product_id);
            $old_weight = $item->weight_stock;

            $item->id = $carts[$key]->id;
            $item->uniq_id= $uniq_id[$key];
            $item->operation_id = $operation_id;
            $item->cart_id = $cart_id;
            $item->product_id = $product_id[$key];
            $item->name = $name[$key];
            $item->price = $price[$key];
            $item->dirt = $dirt[$key];
            $item->weight = $weight[$key];
            $item->weight_stock = $weight_stock[$key];
            $item->sum = $sum[$key];

            $item->save();

            // Update count Product

            $product->count = $product->count - $old_weight;

            if($type == 1){
                $product->count = $product->count + $item->weight_stock;
                $product->save();
            }
            if($type == 2){
                $product->count = $product->count - $item->weight_stock;
                $product->save();
            }
        }

        $cash = Cash::query()->where('operation_id', $operation->id)->first();
        $difference_cash = $cash->sum_operation - $sumCart; // 10 - 20 = 10
        $cash->sum_operation = floatval($operation->sum);
        $cash->summary_cash = $cash->summary_cash + $difference_cash;
        $cash->type_operation = $type;
        $cash->save();

        $cash_all = Cash::query()->where('id', '>', $cash->id)->get();
        foreach ($cash_all as $item){
            dump($difference_cash);
            $item->summary_cash = $item->summary_cash + $difference_cash;
            $item->save();
        }
//        dd($cash_all);



        $operations = Operation::query()
            ->latest()
            ->paginate(10);
        return redirect('/admin/operation')->with('operations');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Operation $operation)
    {
        try {
            $items = $operation->cart()->get();
//            $item_carts = Cart::where('operation_id', $operation->id)->get();

//            dd($items);

            foreach ($items as $item){
                $product = Product::find($item->product_id);

                if($operation->type == 1){
                    $product->count = $product->count - $item->weight;
                    $product->save();
                }
                if($operation->type == 2){
                    $product->count = $product->count + $item->weight;
                    $product->save();
                }
            }
        }
        catch (Exception $e){
            echo "Відбувся виняток: " . $e->getMessage();
        }

        $currentCash = Cash::all()->last();
        $currentCash->summmary_cash =- $operation->sum;

        $operation->delete();

        return redirect()->route('operation.index');
    }
}
