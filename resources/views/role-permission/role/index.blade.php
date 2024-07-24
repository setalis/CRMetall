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
                    <div class="card-header">
                        <h4>Роли пользователей
                            <a href="{{ route('role.create') }}" class="btn btn-primary float-end">Добавить новую роль</a>
                        </h4>
                    </div>
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
                            @foreach($roles as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td><strong>{{ $item->name }}</strong></td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('add-permission-to-role', $item->id) }}" class="btn btn-warning me-2">Добавить/Редактировать разрешения</a>
                                            <a href="{{ route('role.edit', $item->id) }}" class="btn btn-info me-2">Редактировать</a>
                                            <form action="{{ route('role.delete', $item->id) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger">Удалить</button>
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
