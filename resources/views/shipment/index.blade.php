<x-app-layout>
    <div class="container-fliud m-3">
        <div class="row">
            <div class="card p-3 mb-3">
                <div class="row">
                    <div class="col">
                        <h2 class="pb-0 mb-0">Отгрузка металлов
                            <a href="{{ route('shipment.create') }}" class="btn btn-primary float-end">Новая отгрузка</a>
                        </h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col p-0">
                <div class="card">
                    <table class="table">
                        <thead class="table-info">
                        <tr>
                            <th>Дата</th>
                            <th>ID операции</th>
                            <th>№ заказа</th>
                            <th>Наименование</th>
                            <th>Тип</th>
                            <th>Вес общий</th>
                            <th>Засор</th>
                            <th>Чистый вес</th>
                            <th>Сумма</th>
                            <th>Оформил</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="10">
                            </td>
                        </tr>

                        </tfoot>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
