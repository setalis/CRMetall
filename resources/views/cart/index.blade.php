<x-app-layout>
    <div class="container-fliud m-3">
        <div class="row">
            <div class="col">
                <h2>Движение металлов по складу</h2>
            </div>
            <div class="col">
                <a href="{{ route('cart.create') }}" class="btn btn-primary">Новый заказ</a>
            </div>
        </div>
        <div class="row">
            <div class="col p-0">
                <div class="card    ">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>ID операции</th>
                            <th>№ заказа</th>
                            <th>Наименование</th>
                            <th>Тип</th>
                            <th>Вес общий</th>
                            <th>Засор</th>
                            <th>Чистый вес</th>
                            <th>Сумма</th>
                            <th>Оформил</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($carts as $cart)
                            <tr>
                                <td>{{ $cart->operation_id }}</td>
                                <td>{{ $cart->cart_id }}</td>
                                <td>{{ $cart->name }}</td>
                                <td>
                                    @if($cart->operation->type == 1)
                                        <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="#286ad3" class="bi bi-clipboard2-plus" viewBox="0 0 24 24">
                                            <path d="M9.5 0a.5.5 0 0 1 .5.5.5.5 0 0 0 .5.5.5.5 0 0 1 .5.5V2a.5.5 0 0 1-.5.5h-5A.5.5 0 0 1 5 2v-.5a.5.5 0 0 1 .5-.5.5.5 0 0 0 .5-.5.5.5 0 0 1 .5-.5z"/>
                                            <path d="M3 2.5a.5.5 0 0 1 .5-.5H4a.5.5 0 0 0 0-1h-.5A1.5 1.5 0 0 0 2 2.5v12A1.5 1.5 0 0 0 3.5 16h9a1.5 1.5 0 0 0 1.5-1.5v-12A1.5 1.5 0 0 0 12.5 1H12a.5.5 0 0 0 0 1h.5a.5.5 0 0 1 .5.5v12a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5z"/>
                                            <path d="M8.5 6.5a.5.5 0 0 0-1 0V8H6a.5.5 0 0 0 0 1h1.5v1.5a.5.5 0 0 0 1 0V9H10a.5.5 0 0 0 0-1H8.5z"/>
                                        </svg>
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="bi bi-clipboard2-minus" viewBox="0 0 24 24">
                                            <path d="M9.5 0a.5.5 0 0 1 .5.5.5.5 0 0 0 .5.5.5.5 0 0 1 .5.5V2a.5.5 0 0 1-.5.5h-5A.5.5 0 0 1 5 2v-.5a.5.5 0 0 1 .5-.5.5.5 0 0 0 .5-.5.5.5 0 0 1 .5-.5z"/>
                                            <path d="M3 2.5a.5.5 0 0 1 .5-.5H4a.5.5 0 0 0 0-1h-.5A1.5 1.5 0 0 0 2 2.5v12A1.5 1.5 0 0 0 3.5 16h9a1.5 1.5 0 0 0 1.5-1.5v-12A1.5 1.5 0 0 0 12.5 1H12a.5.5 0 0 0 0 1h.5a.5.5 0 0 1 .5.5v12a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5z"/>
                                            <path d="M6 8a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1z"/>
                                        </svg>
                                    @endif

                                </td>
                                <td>{{ $cart->weight }}</td>
                                <td>{{ $cart->dirt }}</td>
                                <td>{{ $cart->weight_stock }}</td>
                                <td>{{ $cart->sum }}</td>
                                @php
                                    $cart->operation->user_id;
                                    $user = \App\Models\User::find($cart->operation->user_id);
                                @endphp
                                <td>{{ $user->name }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="6">
                                    {{ $carts->links() }}
                                </td>
                            </tr>

                        </tfoot>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
