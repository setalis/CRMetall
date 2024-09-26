<div>
    <div class="row">
        <div class="col-md-12">
            <div class="card p-3">
                <h2>Заполнить данные на отправку</h2>
            </div>
        </div>
    </div>
    <form action="{{ route('shipment.store') }}" method="post">
        <div class="row mt-3">
            <div class="col-md-3 pe-md-1">
                <div class="card p-3">
                    @csrf
                    <input name="" @class('form-control')>

                </div>
            </div>
            <div class="col-md-9">
                <div class="card p-3">
                    @csrf
                    @foreach($shipmentProducts as $key=>$shipmentProduct)
                        <div class="row mb-3">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <select class="form-select" aria-label="Default select example" name="shipmentProducts[{{ $key }}]">
                                    <option value="">Выбрать металл</option>
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <input type="number" name="weightShipmentProduct[{{$key}}]" @class('form-control') value="">
                            </div>
                            <div class="col-md-2">
                                <div class="d-grid">
                                    <button class="btn btn-danger"
                                            wire:click.prevent="deleteProduct({{ $key }})"
                                    ><strong>-</strong> Удалить металл </button>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class="card-footer p-0 pt-3 mt-3">
                        <button class="btn btn-warning btn float-end"
                             wire:click.prevent="addProduct"
                             ><strong>+</strong> Добавить металл</button>
                    </div>
                    <div class="mb-3">
                        <label for="comment" class="form-label">Комментарий</label>
                        <textarea class="form-control" id="comment" rows="3" placeholder="Комментарий" value=" "
                                  name="comment"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary float-end ">Сохранить данные</button>
                </div>
            </div>
        </div>
    </form>
</div>
