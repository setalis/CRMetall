<x-app-layout>
    <div class="container-fliud m-3">
        <div class="row">
            <div class="card p-3 mb-3">
                <h3>Новый переучет</h3>
            </div>
        </div>
        <form action="{{ route('inventory.store') }}" method="POST">
            @csrf
        <div class="row">
            <div class="col-md-8">
                <div class="card p-3 mb-3">
                    <div class="row mb-3">
                        <div class="col-md-2">
                            Наименование
                        </div>
                        <div class="col-md-5">
                            Ввести количество при переучете, кг
                        </div>
                        <div class="col-md-5">
                            Количество по базе данных
                        </div>
                    </div>
                    @foreach($products as $product)
                        <div class="row mb-3">
                            <div class="col-md-2 mb-2">
                                <input type="text" class="form-control" placeholder="Наименование" value="{{ $product->name }}" name="product[]" readonly>
                            </div>
                            <div class="col-md-5 mb-2">
                                <input type="number" class="form-control" placeholder="Количество по факту" name="product_stock[]" value="" required min="0" step="0.01">
                            </div>
                            <div class="col-md-5 mb-2">
                                <input type="number" class="form-control" placeholder="Количество по факту" value="{{ $product->count }}" name="product_warehouse[]"  readonly>
                            </div>
                        </div>
                    @endforeach


                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-3 mb-3">
                    <div class="row mb-3">
                        <div class="col">
                            Внести наличные в кассе
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <input type ="number" class="form-control" placeholder="Наличные в кассе">
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-secondary">Внести данные переучета</button>
        </div>
        </form>
    </div>
    <script>

    </script>
</x-app-layout>
