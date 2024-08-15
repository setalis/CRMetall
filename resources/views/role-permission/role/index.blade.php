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
                            @can('Создать роль')
                                <a href="{{ route('role.create') }}" class="btn btn-primary float-end">Добавить новую роль</a>
                            @endcan
                        </h4>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Наименование</th>
                                <th>Разрешения</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($roles as $item)
                                @php
                                    $permissions_role = $item->permissions;
                                @endphp
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td><h6 style="font-weight: bold">{{ $item->name }}</h6> </td>
                                    <td class="">
                                        <div class="row">
                                            <div class="col-md-8 d-flex flex-wrap align-items-center">
                                                @foreach($permissions_role as $permission)
                                                    <span class="badge bg-info m-1">{{ $permission->name }}</span>
                                                @endforeach
                                            </div>
                                            <div class="col-md-4 d-flex align-items-center">
                                                <a href="{{ route('add-permission-to-role', $item->id) }}" class="btn btn-warning me-2">Добавить/Редактировать разрешения</a>
                                            </div>
                                        </div>

                                    </td>
                                    <td>
                                        <div class="d-flex">
{{--                                            <a href="{{ route('add-permission-to-role', $item->id) }}" class="btn btn-warning me-2">Добавить/Редактировать разрешения</a>--}}
                                            @can('Редактировать роль')
                                                <a href="{{ route('role.edit', $item->id) }}" class="btn btn-info me-2">Редактировать</a>
                                            @endcan
                                            @can('Удалить роль')
                                                <form action="{{ route('role.delete', $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger">Удалить</button>
                                                </form>
                                            @endcan
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
