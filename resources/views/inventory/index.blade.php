<x-app-layout>
    <div class="container-fliud m-3">
        <div class="row">
            <div class="card p-3 mb-3">
                <div class="d-flex">
                    <div class="col">
                        <h2>Список всех переучетов</h2>
                    </div>
                    <div class="col">
                        <a href="{{ route('inventory.create') }}" class="btn btn-primary float-end">Новй переучет</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="card p-3">
                    <div class="card-header p-1">
                        <h3>Склад</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead class="table-secondary">
                            <tr>
                                <th>Дата инвентаризации</th>
                                <th>Недостача, кг</th>
                                <th>Избыток, кг</th>
                                <th>Комментарий</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($inventories as $key => $inventory)
                                @php
                                    $int = $inventory->products_inv;
                                    $invent = json_decode($int);
                                @endphp

                                <tr>
                                    <td>{{ $inventory->created_at }}</td>
                                    <td>
                                        @foreach($invent as $item)
                                            @php
                                                $shortage = false;
                                                $difference = $item->product_stock - $item->product_warehouse;
                                            @endphp

                                            @if($difference < 0)
                                                @php
                                                    $shortage = true
                                                @endphp
                                            @endif

                                            @if($shortage === true)
                                                <span class="badge bg-danger">{{ $item->name }}</span>
                                            @endif
                                        @endforeach

                                    </td>
                                    <td>
                                        @foreach($invent as $item)
                                            @php
                                                $shortage = false;
                                                $excess = false;
                                                $equals = false;
                                                $difference = $item->product_stock - $item->product_warehouse;
                                            @endphp

                                            @if ($difference > 0 )
                                                @php $excess = true @endphp
                                            @endif


                                            @if($excess === true)
                                                <span class="badge bg-success">{{ $item->name }}</span>
                                            @endif
                                        @endforeach
                                    </td>
                                    <td></td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('inventory.show', $inventory->id) }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="#2d6cc3" class="bi bi-eye" viewBox="0 0 20 20">
                                                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"></path>
                                                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"></path>
                                                </svg>
                                            </a>
                                            <form action=" {{ route('inventory.delete', $inventory->id) }}" method="post">
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
                                    </td>
                                </tr>

                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <td ></td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>

                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-3">
                    <div class="card-header p-1">

                        <h3>Касса</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
