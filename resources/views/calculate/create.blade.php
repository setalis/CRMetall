<x-app-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <h1 class="mt-3">Расчет прибыли (отгрузка)</h1>
            </div>
            <div class="col">
                <div class="d-flex align-items-center justify-content-end" style="height: 100%">
                    <a href="{{ route('cart.create') }}" class="btn btn-primary">Новый заказ</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-nd-12">
                <div class="card p-3 bg-success bg-opacity-10">
                    @php
                        $int = $item->items;
                        $invent = json_decode($int);
                    @endphp
{{--                    @dump($data_shipment_now, $data_shipment_previous)--}}
                    <form action="">
                    @foreach($invent as $item_ship)
                        @php
                            $product_shipment_price_buy = \App\Models\Cart::where('product_id', $item_ship->shipmentProducts)
                            ->where('created_at', '>=', new Carbon\Carbon($data_shipment_previous))
                            ->where('created_at', '<=', new Carbon\Carbon($data_shipment_now))
                            ->get();
                            $product_shipment_price_buy->avg('price')
                        @endphp
{{--                            @dump($item_ship, $product_shipment_price_buy)--}}
                            <div class="card p-3 mb-3">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="mb-3">
                                            @php
                                                $product = \App\Models\Product::find($item_ship->shipmentProducts)
                                            @endphp
                                            <div class="bg-secondary p-3"><h1 class="display-5 mb-0">{{ $product->name }}</h1></div>
                                            <input type="hidden" class="form-control" id="exampleFormControlInput1" placeholder="" value="{{ $item_ship->shipmentProducts }}">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput1" class="form-label">Вес со склада</label>
                                            <input type="number" class="form-control weight-inventory" id="exampleFormControlInput1" placeholder="" value="{{ $item_ship->weightShipmentProduct }}">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput1" class="form-label">Цена закупки</label>
                                            <input type="number" class="form-control price-inventory" id="exampleFormControlInput1" placeholder="" value="{{ $product_shipment_price_buy->avg('price')}}"  step="0.01">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput1" class="form-label">Вес на заводе</label>
                                            <input onchange="changeInputs(this)" type="number" class="form-control weight-shipment" id="exampleFormControlInput1" placeholder="" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput1" class="form-label">Цена продажи</label>
                                            <input onchange="changeInputs(this)" type="number" class="form-control price-shipment" id="exampleFormControlInput1" placeholder="" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput1" class="form-label ">Расход по наименованию</label>
                                            <input type="number" class="form-control consumption-buy" id="exampleFormControlInput1" placeholder="" value="" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput1" class="form-label ">Приход по наименованию</label>
                                            <input type="number" class="form-control profit-sell" id="exampleFormControlInput1" placeholder="" value="" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput1" class="form-label ">Чистая прибыль по наименованию</label>
                                            <input type="number" class="form-control net-profit" id="exampleFormControlInput1" placeholder="" value="" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>

                    @endforeach
                        <div class="card">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Дата отгрузки</label>
                                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="" value="{{ $data_shipment_now }}">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label ">Чистая прибыль</label>
{{--                                        <input type="text" class="form-control sum-shipment" id="exampleFormControlInput1" placeholder="" value="">--}}
                                        <h1 class="display-4 sum-shipment"></h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>

        let itemShipment = [];
        let sum = 0;
        function changeInputs(elem){
            let rowItem = elem.closest('.row');
            let weight_inventory = rowItem.querySelector('.weight-inventory');
            let price_inventory = rowItem.querySelector('.price-inventory');
            let weight_shipment = rowItem.querySelector('.weight-shipment');
            let price_shipment = rowItem.querySelector('.price-shipment');

            let consumption_buy = rowItem.querySelector('.consumption-buy');
            let profit_sell = rowItem.querySelector('.profit-sell');
            let net_profit = rowItem.querySelector('.net-profit');

            let net_profit_all = document.querySelectorAll('.net-profit');

            consumption_buy.value = weight_inventory.value * price_inventory.value
            profit_sell.value = weight_shipment.value * price_shipment.value
            net_profit.value = profit_sell.value - consumption_buy.value

            sum_shipment()
        }



        function sum_shipment(){
            sum = 0;
            let net_profit_all = document.querySelectorAll('.net-profit');
            let sum_shipment = document.querySelector('.sum-shipment');
            net_profit_all.forEach(function (elem){
                sum = sum + Number(elem.value) ;
            })
            sum_shipment.textContent = sum
            console.log(sum);
        }

    </script>
</x-app-layout>