<x-app-layout>
{{--    @dd($cashes)--}}
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <h1 class="mt-3">Отчет деятельности</h1>
            </div>
            <div class="col">
                <div class="d-flex align-items-center justify-content-end" style="height: 100%">
                    <a href="{{ route('cart.create') }}" class="btn btn-primary">Новый заказ</a>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col mx-0 px-0">
                <div class="card mb-3 p-3 mx-0">
                    <form action="{{ route('report.filter') }}" method="GET">
                        <div class="row">
                            <div class="col">
                                <label for="" class="form-label" >Дата, от</label>
                                <input type="date" class="form-control" placeholder="" aria-label="Date from" name="date_from">
                            </div>
                            <div class="col">
                                <label for="" class="form-label">Дата, до</label>
                                <input type="date" class="form-control" placeholder="" aria-label="Date to" name="date_to">
                            </div>
                            <div class="col">
                                <label for="" class="form-label">Фильтрация по параметрам</label>
                                <button type="submit" class="btn btn-secondary">Фильтровать</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="row">
                    <div class="col mx-0 px-0">
                        <div class="card mb-3 p-3">
                            <table class="table">
                                <thead class="table-info">
                                <tr>
                                    <th>Наименование</th>
                                    <th>Покупка</th>
                                    <th>Продажа</th>
                                    <th>Итого</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($productsStatistic as $prS)
                                    <tr>
                                        <td>{{ $prS['name'] }}</td>
                                        <td>{{ $prS['weight_plus'] }}</td>
                                        <td>{{ $prS['weight_minus'] }}</td>
                                        <td>{{ $prS['weight_all'] }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col mx-0 px-0">
                        @php
                            $cash_bay = 0;
                            $cash_sell = 0;
                            $cash_day = 0;
                            $cash_plus = 0;
                            $cash_minus = 0;
                        @endphp
                        @foreach ($operations as $operation)
                            @if ($operation->type == 1)
                                @php
                                    $cash_bay -= $operation->sum
                                @endphp
                            @elseif ($operation->type == 2)
                                @php
                                    $cash_sell += $operation->sum
                                @endphp
                            @elseif ($operation->type == 3)
                                @php
                                    $cash_plus += $operation->sum
                                @endphp
                            @elseif ($operation->type == 4)
                                @php
                                    $cash_minus -= $operation->sum
                                @endphp
                            @endif
                            @php
                                $cash_day = $cash_sell + $cash_bay + $cash_plus + $cash_minus
                            @endphp
                        @endforeach

                        <div class="card mb-3">
                            <div class="card-body">
                                <table class="table">
                                    <thead class="table-warning">
                                    <tr>
                                        <th>Операция</th>
                                        <th>Сумма</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Покупка металла</td>
                                        <td>{{ $cash_bay }}</td>
                                    </tr>
                                    <tr>
                                        <td>Продажа металла</td>
                                        <td>{{ $cash_sell }}</td>
                                    </tr>
                                    <tr>
                                        <td>Пополнение кассы</td>
                                        <td>{{ $cash_plus }}</td>
                                    </tr>
                                    <tr>
                                        <td>Снятие средств из кассы</td>
                                        <td>{{ $cash_minus }}</td>
                                    </tr>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td>Итого:</td>
                                        <td>{{ $cash_day }}</td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
