<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Cash;
use App\Models\Operation;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CartController extends Controller
{
    public array $cartArr = [];
    public string $currentCartId = 'cart';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carts = Cart::query()
            ->latest()
            ->paginate(10);
        return view('cart.index', compact('carts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(session('currentCartId')){
            $cartId = session('currentCartId');
        } else {
            $cartId = (string) Str::uuid();
        }


        session()->put('currentCartId', $cartId);

        $products = Product::query()->where('is_published', 'on')->get();
        return view('cart.create', compact('products', 'cartId'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user_id = $request->user_id;
        $type = $request->type;
        $client = $request->client;
        $uniq_id = $request->uniq_id;
        $product_id = $request->product_id;
        $name = $request->name;
        $price = $request->price;
        $dirt = $request->dirt;
        $weight = $request->weight;
        $weight_stock = $request->weight_stock;
        $sum = $request->sum;
        $sumCart = $request->summaryCart;
        $cart_id = $request->cartId;
        $comment = $request->comment;
        $status = $request->status;
//        dd($request, $user_id, $type, $uniq_id, $product_id, $name);

        $operation = Operation::create([
            'type' => $type,
            'user_id' => $user_id,
            'cart_id' => $cart_id,
            'products' => '',
            'sum' => $sumCart,
            'comment' => $comment,
            'status' => $status,
        ]);

        for($i = 0; $i < count($name); $i++){

            $cart = Cart::create([
                'operation_id' => $operation->id,
                'product_id' => $product_id[$i],
                'uniq_id' => $uniq_id[$i],
                'cart_id' => $cart_id,
                'name' => $name[$i],
                'price' => $price[$i],
                'dirt' => $dirt[$i],
                'weight' => $weight[$i],
                'weight_stock' => $weight_stock[$i],
                'sum' => $sum[$i],
            ]);
//            dd($cart);
            $product = Product::find($product_id[$i]);

            if($type == 1){
                $product->count = $product->count + $cart->weight_stock;
            }
            if($type == 2){
                $product->count = $product->count - $cart->weight_stock;
            }
            $product->save();


        }

        $cash_last = Cash::all()->last();
        $summary_cash = 0;
        if($cash_last){
            if($type == 2){
                $summary_cash = $cash_last->summary_cash + $sumCart;
            } elseif($type == 1) {
                $summary_cash = $cash_last->summary_cash - $sumCart;
            }
        } else{
            if ($type == 2){
                $summary_cash = $sumCart;
            } elseif($type == 1) {
                $summary_cash = -$sumCart;
            }

        }

        $cash = Cash::create([
            'type_operation' => $type,
            'sum_operation' => $sumCart,
            'summary_cash' => $summary_cash,
            'operation_id' => $operation->id,
        ]);

        $operations = Operation::query()
            ->latest()
            ->paginate(10);
        return redirect('/admin/operation')->with('operations');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        //
    }

    public function addProductToCart(Request $request)
    {
        $uuid = (string) Str::uuid();
        $cart = session('cart', []);
//        dd($cart);
        $data = $request->validate([
            'id' => '',
        ]);

        $id = $data['id'];
        $product = Product::find($id);

        $cart = session('cart', []);
//        dd(session()->all(), $uuid);
        $cart[$uuid] = [
            'id' => $product->id,
            'name' => $product->name,
            'price_buy' => $product->price_buy,
            'price_sell' => $product->price_sell,
            'dirt' => $product->dirt,
            'count' => $product->count,
            'quantity' => 0,
            'images' => $product->images,
        ];

        session()->put('cart', $cart);
//        dd(session()->all());
        return redirect()->back();
    }

    public function deleteItem($id)
    {
    dd($id);
        if($id){
            $cart = session()->get('cart');

            if(isset($cart[$id])) {
                unset($cart[$id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product successfully deleted.');
        }




//        dump(session()->get('cart'));
//        dd(session()->get('cart'));
//        if($idItem) {
//            $currentCartId = session()->get('currentCartId');
//            $cart = session()->get('cart');
//            dd($cart, $idItem['id-item']);
//            dd(isset($cart[$idItem['id-item']]));
//            if(isset($cart[$idItem['id-item']])) {
//                unset($cart[$idItem['id-item']]);
//                session()->put('cart', $cart);
//            }
//        }
        return redirect()->back();
    }
}
