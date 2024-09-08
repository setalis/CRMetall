<x-app-layout>
    <div class="container-fliud m-3">
        <div class="row">
            <div class="card p-3 mb-3">
                <div class="row">
                    <div class="col">
                        <h2 class="pb-0 mb-0">Заполнить данные на отгрузку металлов
{{--                            <a href="{{ route('cart.create') }}" class="btn btn-primary float-end">Новая отгрузка</a>--}}
                        </h2>
                    </div>
                </div>
            </div>
            <div class="card p-3">
                <form action="{{ route('shipment.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="products_id" class="form-label">Наименование</label>
                        <select class="form-select" aria-label="Default select example" name="products" id="product_id">
                            <option selected>Выбрать металл</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="weight" class="form-label">Вес на отправку, предварительный</label>
                        <input type="number" class="form-control" placeholder="" value="" name="weight_shipment">
                    </div>
                    <div class="mb-3">
                        <label for="weight" class="form-label">Цена за кг, предварительная</label>
                        <input type="number" class="form-control" placeholder="" value="" name="price_shipment">
                    </div>
                    <button type="submit" @class('btn btn-success')>Сохранить данные отправки</button>
                </form>
            </div>
        </div>
</x-app-layout>
