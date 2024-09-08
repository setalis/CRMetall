<x-app-layout>
    <div class="container-fliud m-3">
        <div class="col-12">
            <!-- Modal -->
            <div class="modal fade " id="cartModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                 aria-labelledby="cartModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="cartModalLabel">Каталог</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="d-grid gap-2 d-md-flex products-grid">
                                    <div class="products-grid">
                                        {{--  Render Catalog Product All --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <form action="{{ route('cart.store') }}" method="POST" id="operation-form" name="operation-form">
                @csrf

                <div class="row">
                    <div class="card m-3 p-3">
                        <div class="row">
                            <div class="col-12 col-md-9 d-flex">
                                <div class = "me-2">
                                    Счет №
                                </div>
                                <div>
                                    <input class="form-control cartId" type="text" placeholder="ID заказа" value=""
                                           aria-label="default input example" name="cartId">
                                </div>
                                <div>
                                    <label for="type" class="form-label">Менеджер: {{ Auth::user()->name }}</label>
                                    <input class="form-control" type="hidden" placeholder="Менеджер"
                                           value="{{ Auth::user()->id }}" aria-label="default input example"
                                           name="user_id">
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="d-flex gap-2 d-md-flex justify-content-md-end">
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#cartModal">
                                            <i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart <span
                                                class="badge text-bg-danger" id="cart-quantity">0</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <div class="card p-3 pt-4">
                            <div class="row g-3">
                                <div>
                                    <label for="type" class="form-label">Менеджер: {{ Auth::user()->name }}</label>
                                    <input class="form-control" type="hidden" placeholder="Менеджер"
                                           value="{{ Auth::user()->id }}" aria-label="default input example"
                                           name="user_id">
                                </div>

                                <div class="">
                                    <label for="type" class="form-label">Выбрать тип операции</label>
                                    <select class="form-select" id="typeOperation" aria-label="Default select example"
                                            name="type">
                                        <option value="1">Покупка</option>
                                        <option value="2">Продажа</option>
                                    </select>
                                </div>
                                <div class="">
                                    <label for="typeDataList" class="form-label">Контрагент</label>
                                    <input class="form-control" list="datalistOptions" id="exampleDataList"
                                           placeholder="Поиск контрагента..." name="client">
                                    <datalist id="datalistOptions">
                                        <option value="Розничный покупатель">
                                        <option value="Паша">
                                        <option value="Саша">
                                        <option value="ООО Нептун">
                                    </datalist>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-10">
                        <div class="card p-3 pt-4 ">
                            <div class="table-responsive">
                                <table class="table table-sm">
                                    <thead>
                                    <th>№</th>
                                    <th>Наименование</th>
                                    <th>Цена</th>
                                    <th>Засор</th>
                                    <th>Вес</th>
                                    <th>Чистый вес</th>
                                    <th>Сумма</th>
                                    <th>Действия</th>
                                    </thead>
                                    <tbody class="cart-table">
                                    {{--  Render Item Cart --}}
                                    </tbody>
                                    <tfoot class="table-secondary">
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>Итого:</td>
                                        <td>
                                            <input type="number" name="summaryCart" class="summaryCart form-control" value="0"
                                                   readonly/>
                                        </td>
                                        <td>
                                            <button type="button" onclick="clearCurrentCart()" class="btn btn-danger">
                                                Очистить корзину
                                            </button>
                                        </td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="mb-3">
                                <label for="comment" class="form-label">Комментарий</label>
                                <textarea class="form-control" id="comment" rows="3" placeholder="Комментарий" value=" "
                                          name="comment"></textarea>
                            </div>

                            <label for="exampleFormControlInput1" class="form-label">Провести операцию</label>
                            <select class="form-select" aria-label="Default select example" name="status">
                                <option value="1">Да</option>
                                <option value="0">Нет</option>
                            </select>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Сохранить операцию</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>

        let products = <?= json_encode($products) ?>;
        // console.log(products);

        // -------------- Cart Start ----------------- //


        let productsGrid = document.querySelector('.products-grid');
        let cartProductItems = document.querySelector('.cart-table');
        let summCartInput = document.querySelector('.summaryCart');
        let cartsList = document.querySelector('.carts-list');
        let cartIdHtml = document.querySelector('.cartId');
        let currentCartId;
        let summaryCart = 0;
        console.log(products);

        function createUniqueID() {
            return Math.random().toString(36).substr(2, 9);
        }

        // CREATE CURRENT CART
        if (!localStorage.getItem("currentCartId")) {
            currentCartId = createUniqueID();
            localStorage.setItem("currentCartId", currentCartId);
            cartIdHtml.value = currentCartId;
        } else {
            currentCartId = localStorage.getItem("currentCartId")
            cartIdHtml.value = currentCartId;
        }
        // console.log(currentCartId);

        //ADD NOW CART
        function addCart() {
            currentCartId = createUniqueID();
            localStorage.setItem("currentCartId", currentCartId)
            let cart = JSON.parse(localStorage.getItem(currentCartId)) || [];
            let btnCart = document.createElement('div');
            // console.log(btnCart)
            // btnCart.className = 'btn btn-info';
            btnCart.innerHTML = `<button class = "btn btn-info">Заказ</button>`;
            cartsList.append(btnCart);
            updateCart();
        }

        // RENDER PRODUCTS
        function cartProductsRender() {
            products.forEach(item => {
                let colItem = document.createElement('div');
                colItem.className = 'col-2';
                colItem.innerHTML = `
                <div class="card" onclick="addToCart(${item.id})">
                    <img src="/storage/images/${item.images}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5>${item.name}</h5>
                    <p class="card-text">${item.price_buy}</p>
                    </div>
                </div>
        `
                productsGrid.append(colItem);
            });
        }

        // CART ARRAY
        // let cart = JSON.parse(localStorage.getItem("CART")) || [];
        let cart = JSON.parse(localStorage.getItem(currentCartId)) || [];
        console.log(cart);
        updateCart();

        // ADD TO CART
        function addToCart(id) {
            const item = products.find((product) => product.id === id);
            let uniqueID = createUniqueID();
            cart.push({
                ...item,
                weight: 0,
                uniq_id: uniqueID,
            });
            updateCart();
            // console.log(cart);
        }

        // RENDER CART ITEMS
        function cartItemsRender() {
            cartProductItems.innerHTML = "";
            let indexItem = 1;
            summaryCart = 0;
            // console.log(summCartInput);
            cart.forEach((item) => {
                let rowItem = document.createElement('tr');
                let sum = item.price_buy * (item.weight - ((item.weight / 100) * item.dirt));
                let weightStock = item.weight - (item.weight/100 * item.dirt);
                summaryCart = summaryCart + sum;
                // summaryCart.toFixed(2)
                sum.toFixed(2);
                rowItem.innerHTML = `
                <td>
                    ${indexItem}
                    <input name = "product_id[]"  type ="hidden" value = "${item.id}" class = "id">
                    <input name = "uniq_id[]"  type ="hidden" value = "${item.uniq_id}" class = "uniq-id">
                </td>
                <td>
                    <input name="name[]" type="text" value = "${item.name}" class = "form-control name">
                </td>
                <td><input name="price[]" type="number" value = "${item.price_buy}" onchange = "changeItemCart(this)" class = "form-control price"></td>
                <td><input name="dirt[]" type="number" value = "${item.dirt}" onchange = "changeItemCart(this)" class = "form-control dirt"></td>
                <td><input name="weight[]" type="number" value = "${item.weight}" onchange = "changeItemCart(this)" class = "form-control weight"></td>
                <td><input name="weight_stock[]" type="number" value = "${weightStock.toFixed(2)}" onchange = "changeItemCart(this)" class = "form-control weight_stock"></td>
                <td><input name="sum[]" type="number" value = "${sum.toFixed(2)}" class = "form-control sum" readonly></td>
                <td>
                    <div class="d-flex flex-row">
                        <button type="button" onclick="removeItemFromCart('${item.uniq_id}')" class="btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye" viewBox="0 0 20 20">
                                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
                                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                            </svg>
                        </button>
                        <button type="button" onclick="removeItemFromCart('${item.uniq_id}')" class="btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="red" class="bi bi-trash" viewBox="0 0 20 20">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                            </svg>
                        </button>
                    </div>
                </td>
            `;
                indexItem++;
                cartProductItems.append(rowItem);
                summCartInput.value = summaryCart.toFixed(2);
            });

        }

        //SUMMARY CART
        function clearSummaryCart() {
            if (cart.length === 0) {
                summCartInput.value = 0;
            }
        }

        // REMOVE ITEM FOR CART
        function removeItemFromCart(id) {
            cart = cart.filter((item) => item.uniq_id !== id);
            clearSummaryCart()
            updateCart();
        }

        // UPDATE CART
        function updateCart() {
            cartItemsRender();

            // save cart to local storage
            localStorage.setItem(currentCartId, JSON.stringify(cart));
        }

        // CHANGE INPUTS
        function changeItemCart(elem) {
            let rowItem = elem.closest('tr');
            let priceInput = rowItem.querySelector('.price');
            let dirtInput = rowItem.querySelector('.dirt');
            let weightInput = rowItem.querySelector('.weight');
            let weightStock = rowItem.querySelector('.weight_stock');
            let uniqueID = rowItem.querySelector('.uniq-id');

            let indexArr = cart.findIndex(item => item.uniq_id === uniqueID.value);
            console.log(indexArr, cart, weightStock.value, weightStock)
            cart[indexArr].price_buy = priceInput.value;
            cart[indexArr].dirt = dirtInput.value;
            cart[indexArr].weight = weightInput.value;
            cart[indexArr].weight_stock = weightInput.value;

            updateCart()
        }

        function clearCurrentCart() {
            cart = [];
            summCartInput.value = 0;
            updateCart()
        }

        const applicantForm = document.getElementById('operation-form')
        applicantForm.addEventListener('submit', handleFormSubmit)

        function handleFormSubmit(event) {
            // Просим форму не отправлять данные самостоятельно
            const form = document.forms["operation-form"];
            event.preventDefault()
            let currentId = localStorage.getItem('currentCartId');
            localStorage.removeItem(currentId);
            localStorage.setItem('currentCartId', '');
            form.submit();
        }

        cartProductsRender();
        cartItemsRender();

        // ----------------- Cart End ------------------- //
    </script>

</x-app-layout>
