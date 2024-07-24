<x-app-layout>
    <div class="container-fluid px-0 pt-3">
        <div class="row">
            <div class="col-md-12">

                @if(session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('status') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="card mt-3">
                    @can('Создать разрешение')
                    <div class="card-header">
                        <h4>Разрешения
                            <a href="{{ url('permissions/create') }}" class="btn btn-primary float-end">Добавить разрешение</a>
                        </h4>
                    </div>
                    @endcan
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Наименование</th>
                                    <th>Действия</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($permissions as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td><strong>{{ $item->name }}</strong></td>
                                        <td>
                                            <div class="d-flex">

                                                @can('Редактировать разрешение')
                                                    <a href="{{ route('permission.edit', $item->id) }}" class="btn btn-info me-2">Редактировать</a>
                                                @endcan
{{--                                                <a href="{{ route('permission.edit', $item->id) }}" class="btn btn-info me-2">Редактировать</a>--}}
                                                @can('Удалить разрешение')
                                                    <form action="{{ route('permissions.delete', $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger">Удалить</button>
                                                @endcan
                                                </form>
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
    </div>
</x-app-layout>
