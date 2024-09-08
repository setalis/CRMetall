<x-app-layout>
    <div class="container-fliud m-3">
        <div class="row">
            <div>
                <h1>Прайс-лист металлов</h1>
                <button class="btn btn-primary mb-3" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal"> Добавить металл </button>
                <button class="btn btn-primary mb-3" href="#" data-bs-toggle="modal" data-bs-target="#addMetallDellModal"> Отложить в деловой металл </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Добавить новый эллемент в справочник металла</h1>

                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action=" {{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                                <div class="modal-body">
                                    @csrf
                                    <div class="row">
                                        <div class="col-7">
                                            <label for="nameMetall" class="form-label">Ввести наименование металла</label>
                                            <input type="text" class="form-control" id="nameMetall" placeholder="Наименование" required name = "name">
                                            <div class="row">
                                                <div class="col-4">
                                                    <label for="price-buy" class="form-label mt-3">Цена покупки за 1 кг</label>
                                                    <input type="number" class="form-control" id="price-buy" placeholder="Цена покупки" required name = "price_buy">
                                                </div>
                                                <div class="col-4">
                                                    <label for="price-sell" class="form-label mt-3">Цена продажи за 1 кг</label>
                                                    <input type="number" class="form-control" id="price-sell" placeholder="Цена" required name = "price_sell">
                                                </div>
                                                <div class="col-4">
                                                    <label for="dirt" class="form-label mt-3">Ввести % засора</label>
                                                    <input type="number" class="form-control" id="dirt" placeholder="Засор" name="dirt" value = "">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <label for="price-discount" class="form-label mt-3">Оптовая цена</label>
                                                    <input type="number" class="form-control" id="price-discount" placeholder="Опт. цена" name="price_discount" value = "">
                                                </div>
                                                <div class="col-6">
                                                    <label for="weight-discount" class="form-label mt-3">Вес для опт. цены</label>
                                                    <input type="number" class="form-control" id="weight-discount" placeholder="Опт. вес" name="weight_discount" value = "">
                                                </div>
                                            </div>


                                            <input type="hidden" name = "count" value = "0">
                                        </div>
                                        <div class="col-5">
                                            <img src = "/" alt="" id = "file-preview" class = "img-product$product" height="80px">
                                            <label for="formFile" class="form-label">Загрузить изображение</label>
                                            <input class="form-control" type="file" id="formFile" name="images" accept="image/*" onchange="showFile(event)">
                                            <div class="d-inline-flex">
                                                <label for="is_published" class="form-label mt-3">Не опубликован</label>
                                                <div class="form-check form-switch mt-3">
                                                    {{--                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Не опубликован / Опубликован</label>--}}
                                                    <input class="form-check-input" type="checkbox" id="is_published" name="is_published" >
                                                    {{--                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Не опубликован / Опубликован</label>--}}
                                                </div>
                                                <label for="is_published" class="form-label mt-3">Опубликован</label>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <div class="row">
                                        <div class="col my-3">
                                            <button type="button" data-bs-dismiss="modal" aria-label="Close" class="btn btn-secondary m-2" data-bs-dismiss="modal">Закрыть</button>
                                            <button type="submit" class="btn btn-primary m-2">Сохранить новый эллемент</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
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
                </div>

                <div class="modal fade" id="addMetallDellModal" tabindex="-1" aria-labelledby="addMetallDellModal" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Отложить металл в деловой</h1>

                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action=" {{ route('stock.move-metal') }}" method="POST" enctype="multipart/form-data">
                                <div class="modal-body">
                                    @csrf
                                    <div class="row">
                                        <input type="hidden" class="form-control" id="" placeholder="" name = "type" value = "5">
                                        <input type="hidden" class="form-control" id="" placeholder="" name = "user_id" value = "{{ Auth::user()->id }}">
                                        <div class="col-md-5">
                                            <select class="form-select" aria-label="Default select example" name = "from_id">
                                                <option selected>Open this select menu</option>
                                                @foreach($products as $item)
                                                    <option value="{{$item->id}}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-5">
                                            <select class="form-select" aria-label="Default select example" name = "in_id">
                                                <option selected>Open this select menu</option>
                                                @foreach($products as $item)
                                                    <option value="{{$item->id}}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="form-label">Сколько металла отложить в деловой</label>
                                                <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="Кол-во металла" name = "weight">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <div class="row">
                                        <div class="col my-3">
                                            <button type="button" data-bs-dismiss="modal" aria-label="Close" class="btn btn-secondary m-2" data-bs-dismiss="modal">Закрыть</button>
                                            <button type="submit" class="btn btn-primary m-2">Сохранить новый эллемент</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
            <div class="card pt-2 pb-2">
                <div class="table-responsive ">
                    <table class="table table-hover table-sm rounded">
                        <thead class="table-secondary">
                        <th class="border-0 rounded-start">Изображение</th>
                        <th>Наименование</th>
                        <th>Кол-во на складе</th>
                        <th class="border-0 rounded-end">Операции</th>
                        </thead>
                        <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>
                                    <img src ="{{ asset('storage/images/'.$product->images) }}"  height="50px" alt="{{ $product->slug }}">
                                </td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->count }}</td>
                                <td>
                                    <div class="d-flex flex-row m-2">
                                        <div class="p-1">
                                            <a href = "">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill=#2d6cc3 class="bi bi-eye" viewBox="0 0 20 20">
                                                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
                                                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <div class="p-1">
                                            <form action=" {{ route('stock.reset', $product->id) }}" method="get">
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
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
