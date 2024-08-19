<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReportFilterRequest;
use App\Models\Cart;
use App\Models\Cash;
use App\Models\Operation;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(){

        $operations = Operation::all();
        $carts = Cart::all();
        $cashes = Cash::all();
        $products = Product::all();
        $productsStatistic = collect([]);

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
        }

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



        return view('report.index', compact('operations', 'cashes', 'carts', 'productsStatistic'));
    }

    public function reportFilter(ReportFilterRequest $request){

        $data = $request->validated();
        $query = Cart::query();
        $query_operations = Operation::query();

        if (isset($data['date_from'])){
            $query->whereDate('created_at', '>=', new Carbon($data['date_from']));
        }

        if (isset($data['date_to'])){
            $query->whereDate('created_at', '<=', new Carbon($data['date_to']));
        }

        if (isset($data['date_from'])){
            $query_operations->whereDate('created_at', '>=', new Carbon($data['date_from']));
        }

        if (isset($data['date_to'])){
            $query_operations->whereDate('created_at', '<=', new Carbon($data['date_to']));
        }

        $carts = $query->paginate(10);
        $operations = $query_operations->paginate(10);

        $cashes = Cash::all();
        $products = Product::query()->paginate(10);
//        $operations = Operation::all();
//        $carts = Cart::query()->whereDate('created_at', '=', Carbon::now())->get();
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
                    $pr = $productsStatistic[$key];
                    $pr['weight_all'] = $item['weight_plus'] - $item['weight_minus'];
                    $pr['weight_plus'] = $item['weight_plus'];
                    $pr['weight_minus'] = $item['weight_minus'];
                    $productsStatistic[$key] = $pr;
                }
            }
        }
        return view('report.index', compact('operations', 'cashes', 'productsStatistic', 'operations_day'));
    }
}
