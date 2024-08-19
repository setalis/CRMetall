<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Cash;
use App\Models\Operation;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $cash = Cash::all()->last();
        $products = Product::query()->paginate(10);
        $operations = Operation::query()->latest();
        $carts = Cart::query()->whereDate('created_at', '=', Carbon::now())->get();
        $operations_day = Operation::query()->whereDate('created_at', '=', Carbon::now())->get();
        $productsStatistic = collect([]);
        $cashDay = collect([]);

        foreach ($products as $product){
            $productsStatistic->push(
                [
                    'id' => $product->id,
                    'name' => $product->name,
                    'weight_plus' => 0,
                    'weight_minus' => 0,
                    'weight_all' => 0,
                ]
            );
            $cashDay->push([

            ]);
        }
        $cashDay = 0;
        foreach ($productsStatistic as $key => $item)
        {
            foreach ($carts as $cart)
            {
                if ($item['id'] == $cart->product_id)
                {
                    if ($cart->operation->type == 1)
                    {
                        $item['weight_plus'] += $cart->weight_stock;
                    } else if($cart->operation->type == 2) {
                        $item['weight_minus'] += $cart->weight_stock;
                    }
//                    $item['weight'] = $item['weight_plus'] - $item['weight_minus'];
                    $pr = $productsStatistic[$key];
                    $pr['weight_all'] = $item['weight_plus'] - $item['weight_minus'];
                    $pr['weight_plus'] = $item['weight_plus'];
                    $pr['weight_minus'] = $item['weight_minus'];
                    $productsStatistic[$key] = $pr;
                }
            }
        }


        return view('admin.index', compact('cash', 'products', 'operations', 'productsStatistic', 'carts', 'operations_day'));
    }
}
