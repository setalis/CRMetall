<?php

namespace App\Http\Controllers;

use App\Models\Cash;
use App\Models\Operation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CashController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sum_cash = 0;
        $operations = Operation::query()->get();
        $cashes = Cash::query()->latest()->paginate(15);

        foreach ($operations as $item_operation){
            if($item_operation->type == 1){
                $sum_cash =- $item_operation->sum;
            } else {
                $sum_cash =+ $item_operation->sum;
            }
        }

        return view('cash.index', compact('cashes', 'sum_cash' ));
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
//        dd($request);
        $data = $request->validate([
            'type_operation'=> 'required',
            'sum_operation'=> 'required|min:1',
            'comment' => 'max:255',
            'user_id' => 'required',
        ]);

//        dd($data);

        $operation = Operation::create([
            'type' => $data['type_operation'],
            'user_id' => $data['user_id'],
            'cart_id' => '',
            'sum'=> $data['sum_operation'],
            'status'=> '1',
            'comment'=> $data['comment'],
        ]);

        $cash_last = Cash::all()->last();
        $summary_cash = 0;
        if($cash_last){
            if($operation->type == 3){
                $summary_cash = $cash_last->summary_cash + $data['sum_operation'];
            } elseif($operation->type == 4) {
                $summary_cash = $cash_last->summary_cash - $data['sum_operation'];
            }
        } else{
            $summary_cash = $data['sum_operation'];
        }

        $cash = Cash::create([
            'type_operation' => $data['type_operation'],
            'sum_operation' => $data['sum_operation'],
            'summary_cash' => $summary_cash,
            'operation_id' => $operation->id,
        ]);

//        $cashes = Cash::query()->latest()->paginate(15);
        return redirect()->route('cash.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cash $cash)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cash $item)
    {
        return view('cash.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cash $item)
    {
        $data = $request->validate([
            'type_operation'=> 'required',
            'sum_operation'=> 'required|min:1',
            'comment' => 'max:255',
            'user_id' => 'required',
        ]);

        $difference_cash = $data['sum_operation'] - $item->sum_operation;

        $item->summary_cash = $item->summary_cash + $difference_cash;
        $item->type_operation = $data['type_operation'];
        $item->sum_operation = $data['sum_operation'];

        $item->save();

        $cashes = Cash::where('id', '>', $item->id)->get();
        foreach ($cashes as $cash) {
            $cash->summary_cash = $cash->summary_cash + $difference_cash;
            $cash->save();
        }

        $operation = $item->operation;
        $operation->sum = $data['sum_operation'];
        $operation->save();

        return redirect()->route('cash.index');
//        dd($data, $difference_cash);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cash $item)
    {
        $item->delete();
        $operation = Operation::find($item->operation_id);
        $operation->delete();

        $cashes = Cash::where('id', '>', $item->id)->get();
        foreach ($cashes as $cash) {
            if($item->type_operation == 3 || $item->type_operation == 1){
                $cash->summary_cash = $cash->summary_cash - $item->sum_operation;
                $cash->save();
            } elseif($item->type_operation == 4 || $item->type_operation == 2){
                $cash->summary_cash = $cash->summary_cash + $item->sum_operation;
                $cash->save();
            }


        }
        return redirect()->route('cash.index');
    }
}
