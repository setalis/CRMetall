<x-app-layout>
    <div class="container-fliud m-3">
        <div class="row">
            <div class="d-flex justify-content-between">
                <div>
                    <h1 class="align-items-center mb-0">Прайс-лист металлов</h1>
                </div>
                <div class="d-flex align-items-center">
                    @can('Создать товар')
                        <button class="btn btn-primary float-end align-self-center" href="#" data-bs-toggle="modal" data-bs-target="#roleModal"> Добавить металл </button>
                    @endcan
                </div>
                <!-- Modal -->
                <div class="modal fade" id="roleModal" tabindex="-1" aria-labelledby="roleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="roleModalLabel">Добавить новый эллемент в справочник металла</h1>

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

            </div>
            <div class="card pt-2 pb-2">
                <div class="table-responsive ">
                    <table class="table table-hover table-sm rounded">
                    <thead class="table-secondary">
                    <th class="border-0 rounded-start">Изображение</th>
                    <th class="w-25">Наименование</th>
                    <th class="w-auto">Цена покупки</th>
                    <th>Цена продажи</th>
                    <th>Засор</th>
                    <th>Состояние</th>
                    <th class="border-0 rounded-end">Операции</th>
                    </thead>
                    <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>
                                <img src ="{{ asset('storage/images/'.$product->images) }}"  height="50px" alt="{{ $product->slug }}">
                            </td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->price_buy }}</td>
                            <td>{{ $product->price_sell }}</td>
                            <td>{{ $product->dirt}}</td>
                            <td>
                                @php
                                    if ($product->is_published === 'on'){
                                        echo '<span class="badge bg-success">Опубликован</span>';
                                    } else {
                                        echo '<span class="badge bg-danger">Не опубликован</span>';
                                    }
                                @endphp

                            </td>
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
                                        @can('Редактировать товар')
                                            <a href = "{{ route('product.edit', $product->id) }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill=#7b8189 class="bi bi-pencil" viewBox="0 0 20 20">
                                                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325"/>
                                                </svg>
                                            </a>
                                        @endcan
                                    </div>
                                    <div class="p-1">
                                        @can('Удалить товар')
                                        <form action=" {{ route('products.delete', $product->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class = "btn-delete-icon">
                                                <svg width="22px" height="22px" xmlns="http://www.w3.org/2000/svg" fill=#ff102f class="bi bi-trash" viewBox="0 0 20 20">
                                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                                </svg>
                                            </button>
                                        </form>
                                        @endcan
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
