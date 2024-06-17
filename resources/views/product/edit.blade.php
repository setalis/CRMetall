<x-app-layout>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="row g-3">
                <div class="col-7">
                    <div class="card p-4">
                        <label for="nameMetall" class="form-label">Ввести наименование металла</label>
                        <input type="text" class="form-control" id="nameMetall" placeholder="Наименование" required name = "name" value="{{ $product->name }}">
                        <div class="row">
                            <div class="col-4">
                                <label for="price-buy" class="form-label mt-3">Цена покупки за 1 кг</label>
                                <input type="number" value="{{ $product->price_buy }}" class="form-control" id="price-buy" placeholder="Цена покупки" required name = "price_buy" ">
                            </div>
                            <div class="col-4">
                                <label for="price-sell" class="form-label mt-3">Цена продажи за 1 кг</label>
                                <input type="number" value="{{ $product->price_sell }}" class="form-control" id="price-sell" placeholder="Цена" required name = "price_sell" >
                            </div>
                            <div class="col-4">
                                <label for="dirt" class="form-label mt-3">Ввести % засора</label>
                                <input type="number" value="{{ $product->dirt }}" class="form-control" id="dirt" placeholder="Засор" name="dirt" >
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label for="price-discount" class="form-label mt-3">Оптовая цена</label>
                                <input type="number" value="{{ $product->price_discount }}" class="form-control" id="price-discount" placeholder="Опт. цена" name="price_discount" >
                            </div>
                            <div class="col-6">
                                <label for="weight-discount" class="form-label mt-3">Вес для опт. цены</label>
                                <input type="number" value="{{ $product->weight_discount }}" class="form-control" id="weight-discount" placeholder="Опт. вес" name="weight_discount">
                            </div>
                        </div>
                        <input type="hidden" name = "count" value = "{{ $product->count }}">
                    </div>
                </div>
                <div class="col-5">
                    <div class="card p-4">
                        <div class="col-3">
                            <img src = "{{ asset('storage/images/'.$product->images) }}" alt="" id = "file-preview" class = "img-thumbnail img-product" width="auto" height="80px">
                        </div>
                        <label for="formFile" class="form-label">Загрузить изображение</label>
                        <input class="form-control" type="file" id="formFile" name="images" accept="image/*" onchange="showFile(event)">
                        <div class="d-inline-flex">
                            <label for="is_published" class="form-label mt-3">Не опубликован</label>
                            <div class="form-check form-switch mt-3">
                                {{--                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Не опубликован / Опубликован</label>--}}
                                <input class="form-check-input" type="checkbox" id="is_published" name="is_published"
                                    @if($product->is_published)
                                        checked
                                    @endif
                                >
                                {{--                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Не опубликован / Опубликован</label>--}}
                            </div>
                            <label for="is_published" class="form-label mt-3">Опубликован</label>
                        </div>

                    </div>
                </div>
            </div>
        <div class="footer">
            <div class="row">
                <div class="col my-3">
                    <a href="{{ url()->previous() }}" type="button" class="btn btn-secondary m-2">Закрыть</a>
                    <button type="submit" class="btn btn-primary m-2">Сохранить изменения</button>
                </div>
            </div>
        </div>
    </form>
    <script>
        function showFile(event){
            let input = event.target;
            let reader = new FileReader();
            reader.onload = function(){
                let dataURL = reader.result;
                let output = document.getElementById('file-preview')
                output.src = dataURL;
            };
            reader.readAsDataURL(input.files[0]);
        }
    </script>
</x-app-layout>
