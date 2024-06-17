<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use JetBrains\PhpStorm\NoReturn;

class CartController extends Controller
{
    public array $cartArr = [];
    public string $currentCartId = 'cart';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('cart.index');
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

//        dd(session()->all());
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
        $name = $request->name;
        $price = $request->price;
        $dirt = $request->dirt;
        $sum = $request->sum;
        $cartId = $request->cartId;

        for($i = 0; $i < count($name); $i++){
            $data = [
                'cartId' => $cartId,
                'name' => $name[$i],
                'price' => $price[$i],
                'dirt' => $dirt[$i],
                'sum' => $sum[$i],
            ];
            dump($request);
        }

        dd($name, $price, $dirt, $sum);
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

    public function deleteItem(Request $request)
    {
        $idItem = $request->validate([
            'id-item' => ''
        ]);
        if($idItem) {
//            $currentCartId = session()->get('currentCartId');
            $cart = session()->get('cart');
//            dd($cart, $idItem['id-item']);
//            dd(isset($cart[$idItem['id-item']]));
            if(isset($cart[$idItem['id-item']])) {
                unset($cart[$idItem['id-item']]);
                session()->put('cart', $cart);
            }
        }
        return redirect()->back();
    }
}
