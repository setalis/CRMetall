<x-app-layout>
    <div class="container-fliud m-3">
        <div class="row">
            <div class="card p-3 mb-3">
                @php
                    $int = $inventory->products_inv;
                    $invent = json_decode($int);
                @endphp
                <div class="card-header d-flex flex-shrink-1">
                    <div>
                        <h2>Переучет за {{ $inventory->created_at }} </h2>
                    </div>
                    <div class="float-end">
                        <a href="{{ route('inventory.index') }}" class="btn btn-primary">Назад</a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="table-secondary">
                            <tr>
                                <th>Наименование</th>
                                <th>Кол-во фактическое</th>
                                <th>Кол-во по базе</th>
                                <th>Разница</th>
                                <th>Недостача / Избыток</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($invent as $item)
                                @php
                                    $difference = $item->product_stock - $item->product_warehouse
                                @endphp
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->product_stock }}</td>
                                    <td>{{ $item->product_warehouse }}</td>
                                    <td>{{ $difference }}</td>
                                    <td>
                                        @if($difference < 0)
                                            <span class="badge bg-warning">Недостача</span>
                                        @elseif($difference > 0)
                                            <span class="badge bg-success">Избыток</span>
                                        @else
                                            <span class="badge bg-info">Соответсвие</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
