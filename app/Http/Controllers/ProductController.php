<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Operation;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.products.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
//        dd($request);

        $data = request()->validate([
            'name'=> 'required|unique:products|max:255',
            'price_buy' => 'required',
            'price_sell' => '',
            'price_discount' => '',
            'weight_discount' => '',
            'dirt' => '',
            'count' => '',
            'slug' => '',
            'is_published'=> '',
            'images'=> 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if($request->hasFile('images'))
        {
            $image = $request->file('images');
            $imageName = $image->getClientOriginalName();
            $image->move(public_path('storage/images'),$imageName);
            $data["images"] = $imageName;
        }

        $slug = Str::slug($data['name'], '-');
        $data = Arr::add($data, 'slug', $slug);
        $product = Product::create($data);


        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $data = request()->validate([
            'name'=> 'required|max:255',
            'price_buy' => 'required',
            'price_sell' => '',
            'price_discount' => '',
            'weight_discount' => '',
            'dirt' => '',
            'count' => '',
            'slug' => '',
            'is_published' => '',
            'images' => '',
        ]);

        if($request->hasFile('images'))
        {
            $image = $request->file('images');
            $imageName = $image->getClientOriginalName();
            $image->move(public_path('storage/images'),$imageName);
            $data["images"] = $imageName;
        }

        $slug = Str::slug($data['name'], '-');
        $data = Arr::add($data, 'slug', $slug);
//        dd($data);
        $item = Product::find($product->id);

        $item->name = $data['name'];
        $item->price_buy = $data['price_buy'];
        $item->price_sell = $data['price_sell'];
        $item->price_discount = $data['price_discount'];
        $item->weight_discount = $data['weight_discount'];
        $item->dirt = $data['dirt'];
        $item->slug = $data['slug'];
        if (array_key_exists('is_published', $data)){
            $item->is_published = $data['is_published'];
        } else {
            $item->is_published = '';
        }
        if(array_key_exists('images', $data)){
            $item->images = $data['images'];
        }

        $item->save();

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $currentImage = $product->images;
        $product->delete();
        Storage::disk('public')->delete('images/'.$currentImage);
        return redirect()->route('products.index');
    }

    public function stock()
    {
        $products = Product::query()->get();
        return view('stock.index', compact('products'));
    }
    public function resetCount($id)
    {

        $product = Product::find($id);
        $product->count = 0;
        $product->save();
        return redirect()->route('stock.index');
    }

    public function addMetallDell(Request $request)
    {
//        dd($request);
        $data = request()->validate([
            'type' => '',
            'from_id' => '',
            'in_id' => '',
            'weight' => 'required',
            'comment' => 'text',
        ]);

        $from_id = intval($data['from_id']);
        $in_id = intval($data['in_id']);
        $product_from = Product::find($from_id);
        $product_in = Product::find($in_id);
        $product_from->count = $product_from->count - $data['weight'];
        $product_in->count = $product_in->count + $data['weight'];
        $product_from->save();
        $product_in->save();

        $products_move = collect([]);
        $products_move->push([
            'product_from' => $product_from->name,
            'product_in' => $product_in->name,
            'weight' => $data['weight'],
        ]);

        $user_id = $request->user_id;
        $comment = $request->comment;
        $operation = Operation::create([
            'type' => $data['type'],
            'user_id' => $user_id,
            'cart_id' => '',
            'products' => $products_move,
            'sum' => '',
            'comment' => $comment,
            'status' => '',
        ]);



        $cart = Cart::create([
            'operation_id' => $operation->id,
            'cart_id' => '',
            'uniq_id' => '',
            'product_id' => $data['from_id'],
            'name' => $product_from->name,
            'price' => '',
            'dirt' => '',
            'weight' => $data['weight'],
            'weight_stock' => $data['weight'],
            'sum' => '',
            'user_id' => $user_id,
        ]);

        Cart::create([
            'operation_id' => $operation->id,
            'cart_id' => '',
            'uniq_id' => '',
            'product_id' => $data['in_id'],
            'name' => $product_in->name,
            'price' => '',
            'dirt' => '',
            'weight' => $data['weight'],
            'weight_stock' => $data['weight'],
            'sum' => '',
            'user_id' => $user_id,
        ]);

        return redirect()->route('stock.index');
    }

}
