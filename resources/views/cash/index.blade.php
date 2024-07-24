<x-app-layout>
    <div class="container-fliud m-3">
        <div class="row">
            <div class="d-flex">
                <div class="flex-grow-1">
                    <h1>Касса</h1>
                </div>
                <div class="justify-content-end">
                    <button class="btn btn-primary mb-3" href="#" data-bs-toggle="modal" data-bs-target="#cashModal"> Пополнить кассу </button>
                </div>
            </div>

            @if ($errors->any())
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        @endforeach
                    </ul>
                </div>
            @endif


            <!-- Modal -->
            <div class="modal fade" id="cashModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="{{ route('cash.store') }}" method="POST" name = "addCash">
                        @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Пополнить наличные в кассе</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                                <div class="mb-3">
                                    <label for="type_operation" class="form-label">Введите сумму пополнения</label>
                                    <select class="form-select" aria-label="Default select example" name ="type_operation" required>
                                        <option value="">Выбрать тип операции</option>
                                        <option value="3">Пополнение кассы</option>
                                        <option value="4">Снятие средств из кассы</option>
                                    </select>
                                    @error('type_operation')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="sum_operation" class="form-label">Введите сумму пополнения</label>
                                    <input type="number" class="form-control" name = "sum_operation" id="sum_operation" >
                                    @error('sum_operation')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="comment" class="form-label">Комментарий</label>
                                    <textarea class="form-control" name = "comment" id="comment"></textarea>
                                    @error('comment')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <input type="hidden" value = "{{ Auth::user()->id }}" name = "user_id">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                            <button type="submit" class="btn btn-primary">Внести наличные</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="card pt-2 pb-2">
                <div class="table-responsive ">
                    <table class="table table-striped table-bordered">
                        <thead class="table-primary">
                            <th>ID</th>
                            <th>Дата</th>
                            <th>Тип операции</th>
                            <th>ID операции</th>
                            <th>Сумма операции</th>
                            <th>Наличные в кассе</th>
                            <th>Комментарий</th>
                            <th>Действия</th>
                        </thead>
                        <tbody>
                        @foreach($cashes as $cash)
                            <tr>
                                <td>{{ $cash->id }}</td>
                                <td>{{ $cash->created_at }}</td>
                                @if ($cash->type_operation == 1)
                                    <td><span class="badge bg-success">Покупка</span></td>
                                @elseif ($cash->type_operation == 2)
                                    <td><span class="badge bg-secondary text-dark">Продажа</span></td>
                                @elseif ($cash->type_operation == 3)
                                    <td><span class="badge bg-info text-dark">Пополнение кассы</span></td>
                                @elseif ($cash->type_operation == 4)
                                    <td><span class="badge bg-danger">Снятие средств из кассы</span></td>
                                @endif

                                <td>{{ $cash->operation_id }}</td>
                                <td>{{ $cash->sum_operation }}</td>
                                <td>{{ $cash->summary_cash }} </td>
                                @php
                                    $operation = \App\Models\Operation::find($cash->operation_id);
                                 @endphp
                                <td>
                                    {{ $operation->comment }}
                                </td>
                                <td>
                                    <div class="d-flex">
                                        @if ($cash->type_operation == 3)
                                            <a href="{{ route('cash.edit', $cash->id) }}" class= "btn btn-primary me-3">Редактировать</a>
                                        @elseif($cash->type_operation == 4)
                                            <a href="{{ route('cash.edit', $cash->id) }}" class= "btn btn-primary me-3">Редактировать</a>
                                        @else
                                            <a href="{{ route('operation.edit', $cash->operation->id) }}" class= "btn btn-primary me-3">Редактировать</a>
                                        @endif

                                        <form action="{{ route('cash.delete', $cash->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type = "submit" class= "btn btn-danger">Удалить</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    {{ $cashes->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
