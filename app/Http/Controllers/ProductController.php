<?php

namespace App\Http\Controllers;

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
}
