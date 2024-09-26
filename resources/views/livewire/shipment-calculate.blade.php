<div>
    <div class="card">
        Calculate LiveWire
{{--        @dump($item_shipment, $items)--}}
        @php
            $int = $item_shipment->items;
            $invent = json_decode($items);
//            $invent = $items;
        @endphp
{{--        @dump($invent)--}}
{{--                            @dump($data_shipment_now, $data_shipment_previous)--}}
        <form action="">
            @foreach($invent as $key=>$item_ship)
                @php

                    $product_shipment_price_buy = \App\Models\Cart::where('product_id', $item_ship->shipmentProducts)
                    ->where('created_at', '>=', new Carbon\Carbon($data_shipment_previous))
                    ->where('created_at', '<=', new Carbon\Carbon($data_shipment_now))
                    ->get();
                    $product_shipment_price_buy->avg('price')
                @endphp
                @dump($item_ship, $product_shipment_price_buy, $key)
                <div class="row">
                    <div class="col-md-2">
                        <div class="mb-3">
                            @php
                                $product = \App\Models\Product::find($item_ship->shipmentProducts)
                            @endphp
                            <div>{{ $product->name }}</div>
                            <input type="hidden" class="form-control" id="exampleFormControlInput1" placeholder="" value="{{ $item_ship->shipmentProducts }}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Вес со склада</label>
                            <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="" value="{{ $item_ship->weightShipmentProduct }}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Цена закупки</label>
                            <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="" value="{{ $product_shipment_price_buy->avg('price')}}"  step="0.01">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label" >Вес на заводе</label>
                            <input wire:model.live="weight_calculate.{{$key}}"
{{--                                   wire:change="changeWeight(weight_calculate.{{$key}})"--}}
                                   type="number"
                                   class="form-control"
                                   id=""
                                   name="weight_calculate.{{$key}}"
                                   placeholder="" >
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="mb-3">
                            <label for="" class="form-label">Цена продажи</label>
                            <input wire:model.live="price_calculate.{{$key}}"
                                    type="number" class="form-control" id="" placeholder="" value="{{ $price_calculate }}">
                        </div>
                    </div>
                </div>
                @dump($weight_calculate)
            @endforeach

            <div class="row">
                <div class="col-md-2">
                    <div class="mb-3">
                        <label for="" class="form-label">Дата отгрузки</label>
                        <input type="text" class="form-control" id="" placeholder="" value="{{ $data_shipment_now }}">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
