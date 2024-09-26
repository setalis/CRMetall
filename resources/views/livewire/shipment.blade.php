<div>
    <div class="row">
        <div class="col">
            <div class="card p-3 d-flex">
                <h2 @class('p-0 m-0')>Отгрузка
                    <a href="" @class('btn btn-primary float-end')>Добавить отгрузку</a>
                </h2>
            </div>
            <div class="card p-3 mb-3">
                <tr>

                </tr>
                <table>
                    <thead @class('table-primary')>
                        <tr>
                            <th>Дата</th>
                            <th>Металлы</th>
                        </tr>
                    </thead>
                    @foreach($shipments as $shipment)
                        <tr>
                            <td>{{ $shipment->created_at }}</td>

                            <td>{{ $shipment->items }}</td>

                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
