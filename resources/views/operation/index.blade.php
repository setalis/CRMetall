<x-app-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <h1 class="mt-3">Операции</h1>
            </div>
            <div class="col">
                <div class="d-flex align-items-center justify-content-end" style="height: 100%">
                    <a href="{{ route('cart.create') }}" class="btn btn-primary">Новый заказ</a>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card p-3">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead class="table-dark">
                            <tr>
                                <th>№</th>
                                <th>Дата/Время</th>
                                <th>Счет №</th>
                                <th>Тип</th>
                                <th>
                                    <div class="text-center">Информация</div>
                                </th>
                                <th>Сумма</th>
                                <th>Статус</th>
                                <th>Комментарий</th>
                                <th class="text-center">Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($operations as $operation)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $operation->created_at }}</td>
                                    <td>{{ $operation->cart_id }}</td>
                                    <td>
                                        @if($operation->type == 1)
                                            <span class="badge bg-success">Покупка</span>
                                        @elseif ($operation->type == 2)
                                            <span class="badge bg-danger">Продажа</span>
                                        @elseif ($operation->type == 3)
                                            <span class="badge bg-info">Пополнение средств</span>
                                        @elseif ($operation->type == 4)
                                            <span class="badge bg-danger">Снятие средств</span>
                                        @elseif ($operation->type == 5)
                                            <span class="badge bg-black">Перемещение</span>
                                        @elseif ($operation->type == 6)
                                            <span class="badge bg-secondary">Отгрузка</span>
                                        @endif
                                    </td>
                                    <td>
                                        @php
                                            $items = $operation->cart;
                                        @endphp
                                        @if($operation->type == 1  || $operation->type == 2 || $operation->type == 6)
                                            <table class="table table-bordered table-striped table-sm">
                                                @foreach($items as $item)
                                                    <tr>
                                                        <td style="width: 60%">{{ $item->name }}</td>
                                                        <td style="width: 20%">{{ $item->weight }} кг</td>
                                                        <td style="width: 20%">{{ $item->dirt }} %</td>
                                                        <td style="width: 20%">{{ $item->sum }} грн</td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        @elseif($operation->type == 5)
                                            @php
                                                $int = $operation->products;
                                                $invent = json_decode($int);
                                            @endphp
                                            <table class="table">
                                                {{--                                        <thead @class('table-secondary')>--}}
                                                {{--                                            <tr>--}}
                                                {{--                                                <th>Из</th>--}}
                                                {{--                                                <th>В</th>--}}
                                                {{--                                                <th>Вес</th>--}}
                                                {{--                                            </tr>--}}
                                                {{--                                        </thead>--}}
                                                @foreach($invent as $item)
                                                    <tr>
                                                        <td>{{ $item->product_from  }}</td>
                                                        <td>-></td>
                                                        <td>{{ $item->product_in }}</td>
                                                        <td>{{ $item->weight }} кг</td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        @else
                                            Без товаров
                                        @endif

                                    </td>
                                    <td>{{ $operation->sum }}</td>
                                    <td>
                                        @if($operation->status == 1)
                                            <span class="badge bg-success">Проведен</span>
                                        @else
                                            <span class="badge bg-danger">Не проведен</span>
                                        @endif
                                    </td>
                                    <td>{{ $operation->comment }}</td>
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
                                                @php
                                                    $cash = \App\Models\Cash::query()->where('operation_id', $operation->id)->first();
                                                @endphp
                                                {{--                                            @dump($cash)--}}
                                                @if($operation->type == 3 || $operation->type == 4)
                                                    <a href = "{{ route('cash.edit', $cash->id) }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill=#7b8189 class="bi bi-pencil" viewBox="0 0 20 20">
                                                            <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325"/>
                                                        </svg>
                                                    </a>
                                                @elseif($operation->type == 1 || $operation->type == 2 || $operation->type == 6)
                                                    <a href = "{{ route('operation.edit', $operation->id) }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill=#7b8189 class="bi bi-pencil" viewBox="0 0 20 20">
                                                            <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325"/>
                                                        </svg>
                                                    </a>
                                                @endif
                                            </div>
                                            <div class="p-1">
                                                <form action=" {{ route('operation.delete', $operation->id) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class = "btn-delete-icon">
                                                        <svg width="22px" height="22px" xmlns="http://www.w3.org/2000/svg" fill=#ff102f class="bi bi-trash" viewBox="0 0 20 20">
                                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                                            <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="9">
                                    <div class="mt-3">{{ $operations->links() }} </div>
                                </td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
