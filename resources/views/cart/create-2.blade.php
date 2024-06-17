<x-app-layout>
    <div class="container-fliud m-3">
        <div class="col-12">
            <div class="row">
                <div class="col-6">
                    <h2>Новый заказ</h2>
                </div>
                <div class="col-6">
                    <div class="d-flex gap-2 d-md-flex justify-content-md-end">
                        <div class="dropdown">
                            @php
                                $value = session('cart');
                            @endphp
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#cartModal">
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart <span class="badge text-bg-danger" id="cart-quantity">{{(($value)) ? count($value) : 0 }}</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade " id="cartModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="cartModalLabel">Корзина</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input class="form-control cartId" type="text" placeholder="ID заказа" value = "{{ $cartId }}" aria-label="default input example" name = "cartId">

                            <div class="row g-3">
                                <div class="col-6">
                                    <label for="type" class="form-label">Выбрать тип операции</label>
                                    <select class="form-select" id = "typeOperation" aria-label="Default select example" name = "type">
                                        <option value="1">Покупка</option>
                                        <option value="2">Продажа</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label for="typeDataList" class="form-label">Контрагент</label>
                                    <input class="form-control" list="datalistOptions" id="exampleDataList" placeholder="Поиск контрагента...">
                                    <datalist id="datalistOptions">
                                        <option value="Розничный покупатель">
                                        <option value="Паша">
                                        <option value="Саша">
                                        <option value="ООО Нептун">
                                    </datalist>
                                </div>
                            </div>
                            <div class="row">

                            </div>

                                <table class="table table-sm">
                                <thead>
                                    <th>Наименование</th>
                                    <th>Цена</th>
                                    <th>Вес</th>
                                    <th>Засор</th>
                                    <th>Сумма</th>
                                    <th></th>
                                </thead>
                                <tbody>
                                @php
                                    $total = 0;
                                    $totalCart = 0;
                                    $currentCartId = session()->get('currentCartId');
                                @endphp
                                @if(session('cart'))
                                    @foreach(session('cart') as $id => $item)
                                    <tr id = "{{ $id }}" >
                                        <th>
                                            <input type="text" class="form-control" id="name" placeholder="Наименование" value="{{ $item['name'] }}" name="name" required readonly>
                                        </th>
                                        <th>
                                            <input type="number" oninput="changeInput(this)" class="form-control" id="price" placeholder="Цена" value="{{ $item['price_buy'] }}" name="price" step="0.1" required>
                                        </th>
                                        <th>
                                            <input type="number" oninput="changeInput(this)" class="form-control" id="weight" placeholder="Вес" value ="0" name="weight" min="1">
                                        </th>
                                        <th>
                                            <input type="number"oninput="changeInput(this)"  class="form-control" id="dirt" placeholder="Засор" value ="{{ $item['dirt'] }}" name="dirt">
                                        </th>
                                        <th>
                                            <input type="number" class="form-control sum" id="sum" placeholder="Сумма" value ="0" min="1" step="0.1" required name="sum"  >
                                        </th>
                                        <th>
                                            <form action="{{ route('cart.delete-item') }} " method="post">
                                                @csrf
                                                <input type="hidden" name = "id-item" value = "{{ $id }}">
                                                <button type="submit" class = "btn-delete-icon">
                                                    <svg width="22px" height="22px" xmlns="http://www.w3.org/2000/svg" fill=#ff102f class="bi bi-trash" viewBox="0 0 20 20">
                                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                                        <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                                    </svg>
                                                </button>
                                            </form>
                                        </th>
                                    </tr>
                                    @endforeach
                                @endif
                                </tbody>
                                <tfoot class="table-secondary">
                                <tr>
                                    <td colspan="4" class="text-end">
                                        Итого:
                                    </td>
                                    <td class="p-3">
                                        <input type="number" class="form-control sumCart" name="sumCart" value="0" readonly>
                                    </td>
                                    <td></td>
                                </tr>
                                </tfoot>
                            </table>
                            <div class="mb-3">
                                <label for="comment" class="form-label">Комментарий</label>
                                <textarea class="form-control" id="comment" rows="3" placeholder="Комментарий" value=" " name="comment"></textarea>
                            </div>

                            <label for="exampleFormControlInput1" class="form-label">Провести операцию</label>
                            <select class="form-select" aria-label="Default select example" name="status">
                                <option value="1">Да</option>
                                <option value="0">Нет</option>
                            </select>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="d-grid gap-2 d-md-flex grid-product">
                    @foreach($products as $product)
                        <form action = "{{ route('add.product', $product->id)}}">
                            @csrf
                            <input type="hidden" value="{{ $product->id }}" name = "id">
                            <button type="submit">
                                <div class="card p-2 m-1" style="width: 12rem;" id = "{{ $product->id }}">
                                    <img src="{{ asset('storage/images/'.$product->images) }}" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <p class="card-text text-center">{{ $product->name }}</p>
                                    </div>
                                    <input type="hidden" class="product-quantity" value="1">
                                </div>
                            </button>

                        </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <script>
        const priceItem = document.querySelector('#price');
        const dirtItem = document.querySelector('#dirt');
        const weightItem = document.querySelector('#weight');
        const currentCartIdHtml = document.querySelector('.cartId');
        let sumItem = document.querySelector('#sum');
        let sumCart = document.querySelector('.sumCart');
        let itemsCart = [];
        let price = Number(priceItem.value);
        let weight = Number(weightItem.value);
        let dirt = '';
        let currentCartId = currentCartIdHtml.value;
        localStorage.setItem('currentCartId', currentCartId);
        let itemsCurrentCart = [];
        // if(localStorage.getItem('itemsCurrentCart')){
        //     itemsCurrentCart = localStorage.getItem('itemsCurrentCart');
        // } else {
        //    itemsCurrentCart = [];
        // }


        // console.log(currentCartId, itemsCart);
        function renderCartItem(){
            if(localStorage.getItem('itemsCurrentCart')){
                itemsCurrentCart = JSON.parse(localStorage.getItem('itemsCurrentCart'));
            }
            itemsCurrentCart.forEach((item) =>{
                let product = document.getElementById(item);
                let currentItem = JSON.parse(localStorage.getItem(item));
                let weight = product.querySelector('#weight');
                price = product.querySelector('#price');
                dirt = product.querySelector('#dirt');
                let sum = product.querySelector('#sum')
                weight.value = currentItem[0].weight;
                dirt.value = currentItem[0].dirt;
                price.value = currentItem[0].price;
                sum.value = currentItem[0].sumItem;
                console.log(itemsCart, product, weight, price, dirt);
            })
            totalCartSum()
            console.log(itemsCart);
            // if(localStorage.getItem(currentCartId) !== null){
            //     let $currentItem = JSON.parse(localStorage.getItem(currentCartId));
            //     let item = document.querySelector(`#${currentCartId}`);
            //     weight = item.querySelector('#weight');
            //     price = item.querySelector('#price');
            //     dirt = item.querySelector('#dirt');
            //     weight.value = $currentItem[0].weight;
            //     dirt.value = $currentItem[0].dirt;
            //     price.value = $currentItem[0].price;
            //     console.log($currentItem[0].dirt, it);
            // }
        }
        renderCartItem();

        function changeInput(elem){
            itemsCart = [];
            if(localStorage.getItem('itemsCurrentCart')){
                itemsCurrentCart = JSON.parse(localStorage.getItem('itemsCurrentCart'));
            }
            console.log(itemsCurrentCart)
            let rowItem = elem.closest("tr");
            let rowId = rowItem.id;
            console.log(itemsCurrentCart, rowId);
            if(itemsCurrentCart.includes(rowId)){

            } else {
                itemsCurrentCart.push(rowId);
            }

            localStorage.setItem('itemsCurrentCart', JSON.stringify(itemsCurrentCart));
            weight = rowItem.querySelector('#weight');
            price = rowItem.querySelector('#price');
            dirt = rowItem.querySelector('#dirt');
            sumItem = rowItem.querySelector('#sum');
            subTotal(price, weight, dirt, sumItem);

            // save localstorage inputs
            let itemRowId = [];
            itemRowId.push({
                weight: weight.value,
                dirt: dirt.value,
                price: price.value,
                sumItem: sumItem.value
            })
            localStorage.setItem(rowId, JSON.stringify(itemRowId));

        }

        function subTotal(price, weight, dirt){
            price = price.value;
            dirt = dirt.value;
            weight = weight.value;
            sumItem.value = price * (weight - ((weight/100) * dirt));
            // console.log(sumItem.value);
            totalCartSum()
        }

        function totalCartSum(){
            let tbody = document.querySelector('tbody');
            let sumArr = tbody.querySelectorAll('.sum');
            let sumArrValue = 0;
            for (let i=0; i<sumArr.length; i++){
                sumArrValue = sumArrValue + parseFloat(sumArr[i].value);
            }
            sumCart = document.querySelector('.sumCart');
            sumCart.value = sumArrValue;
            // console.log(tbody, sumArr, sumArr[0].value, sumArrValue);
        }

        // sumItem.value = summaryItem;
        // console.log(price, weight, summaryItem);
    </script>
</x-app-layout>
