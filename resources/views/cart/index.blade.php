<x-app-layout>
    <div class="container-fliud m-3">
{{--        <div class="row">--}}
{{--            <div class="col-md-12">--}}
{{--                <h2>Движение металлов по складу--}}
{{--                    <a href="{{ route('cart.create') }}" class="btn btn-primary float-end">Новый заказ</a>--}}
{{--                </h2>--}}
{{--            </div>--}}
{{--        </div>--}}
        <div class="row">
            <div class="card p-3 mb-3">
                <div class="row">
                    <div class="col">
                        <h2 class="pb-0 mb-0">Движение металлов по складу
                            <a href="{{ route('cart.create') }}" class="btn btn-primary float-end">Новый заказ</a>
                        </h2>
                    </div>
                    <div class="col d-flex justify-content-end align-items-center">
                        <a class="mx-3" data-bs-toggle="collapse" href="#collapseFilter" role="button" aria-expanded="false" aria-controls="collapseFilter">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-filter-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                <path d="M7 11.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m-2-3a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m-2-3a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5"/>
                            </svg> Фильтр
                        </a>
                        <a class="" href="{{ route('export-cart-exel') }}" role="button" >
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-filter-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                <path d="M7 11.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m-2-3a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m-2-3a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5"/>
                            </svg> Экспорт
                        </a>
                    </div>
                </div>
                <div class="collapse px-0 my-3" id="collapseFilter">
                    <div class="card card-body">
                        <form action="{{ route('cart.filter') }}" method="GET">
                            <div class="row">
                                <div class="col">
                                    <label for="" class="form-label">Фильтр по металлу</label>
                                    <select class="form-select" aria-label="Product select" name="product_id">
                                        @php
                                            $products = \App\Models\Product::query()->get();
                                        @endphp
                                        <option value="">Выбрать металл</option>
                                        @foreach($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="" class="form-label">Фильтр по сотруднику</label>
                                    <select class="form-select" aria-label="User select" name="user_id">
                                        @php
                                            $users = \App\Models\User::query()->get();
                                        @endphp
                                        <option value="">Выбрать сотрудника</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="" class="form-label">Фильтр по засору</label>
                                    <select class="form-select" aria-label="Dirt select" name="dirt">
                                        @php
                                            $dirts = $carts->unique('dirt')->sortBy('dirt');
                                        @endphp
                                        <option value="">Выбрать засор</option>
                                        @foreach($dirts as $dirt)
                                            <option value="{{ $dirt->dirt}}">{{ $dirt->dirt }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="" class="form-label" >Дата, от</label>
                                    <input type="datetime-local" class="form-control" placeholder="" aria-label="Date from" name="date_from">
                                </div>
                                <div class="col">
                                    <label for="" class="form-label">Дата, до</label>
                                    <input type="datetime-local" class="form-control" placeholder="" aria-label="Date to" name="date_to">
                                </div>
                                <div class="col">
                                    <label for="" class="form-label">Фильтрация по параметрам</label>
                                    <button type="submit" class="btn btn-secondary">Фильтровать</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col p-0">
                <div class="card">
                    <table class="table">
                        <thead class="table-info">
                        <tr>
                            <th>Дата</th>
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
                                <td>{{ $cart->created_at }}</td>
                                <td>{{ $cart->operation_id }}</td>
                                <td>{{ $cart->cart_id }}</td>
                                <td>{{ $cart->name }}</td>
                                <td>
                                    @if($cart->operation->type == 1)
                                        <span class="badge bg-success">Покупка</span>
                                    @elseif($cart->operation->type == 2)
                                        <span class="badge bg-danger">Продажа</span>
                                    @elseif($cart->operation->type == 5)
                                        <span class="badge bg-black">Перемещение</span>
                                    @elseif($cart->operation->type == 6)
                                        <span class="badge bg-secondary">Отгрузка</span>
                                    @endif
                                </td>
                                <td>{{ $cart->weight }}</td>
                                <td>{{ $cart->dirt }}</td>
                                <td>{{ $cart->weight_stock }}</td>
                                <td>{{ $cart->sum }}</td>
                                @php

                                    $user_cart = \App\Models\User::find($cart->user_id);
                                @endphp

                                <td>{{$user_cart['name']}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="10">
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
