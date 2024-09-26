<x-app-layout>
    <div class="container-fliud m-3">
        <div class="row">
            <div class="card p-3 mb-3">
                <div class="row">
                    <div class="col">
                        <h2 class="pb-0 mb-0">Отгрузка металлов
                            <a href="{{ route('shipment.create.livewire') }}" class="btn btn-primary float-end">Новая отгрузка</a>
                        </h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col p-0">
                <div class="card p-3">
                    <table class="table">
                        <thead class="table-info">
                        <tr>
                            <th>Дата</th>
                            <th>Информация</th>
                            <th>Расчет прибыли</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
{{--                            @foreach($operations as $operation)--}}
{{--                                @php--}}
{{--                                    $carts = $operation->cart--}}
{{--                                @endphp--}}
{{--                                @foreach($carts as $cart)--}}
{{--                                    {{ $cart->name }}--}}
{{--                                @endforeach--}}

{{--                            @endforeach--}}

                            @foreach($shipments as $shipment)
                                    <td>{{ $shipment->created_at }}</td>
                                    <td>
                                        @php
                                            $int = $shipment->items;
                                            $invent = json_decode($int);
                                        @endphp
                                        <table class="table table-striped table-bordered table-sm">
                                            <tbody>

                                                    @foreach($invent as $item)
                                                        <tr>
                                                        @php
                                                            $product = \App\Models\Product::find($item->shipmentProducts)
                                                        @endphp
                                                        <td>{{ $product->name }}</td>
                                                        <td>{{ $item->weightShipmentProduct }}</td>
                                                        </tr>
                                                    @endforeach
                                            </tbody>
                                        </table>
                                    </td>
                                    <td>
                                        <a href="{{ route('shipment.calculate', $shipment->id) }}" class="btn btn-behance" >Расчитать</a>
                                        <a href="{{ route('shipment.calc.livewire', $shipment->id) }}" class="btn btn-behance" >Расчитать Live</a>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-row m-2 justify-content-center">
                                            <div class="p-1">
                                                <a href = "">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill=#2d6cc3 class="bi bi-eye" viewBox="0 0 20 20">
                                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
                                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                                                    </svg>
                                                </a>
                                            </div>
                                            <div class="p-1">
                                                <a href = "">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill=#7b8189 class="bi bi-pencil" viewBox="0 0 20 20">
                                                        <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325"/>
                                                    </svg>
                                                </a>
                                            </div>
                                            <div class="p-1">
                                                <a href = "">
                                                    <svg width="22px" height="22px" xmlns="http://www.w3.org/2000/svg" fill=#ff102f class="bi bi-trash" viewBox="0 0 20 20">
                                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                                        <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="10">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="9">
                                <div class="mt-3">{{ $shipments->links() }} </div>
                            </td>
                        </tr>

                        </tfoot>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
