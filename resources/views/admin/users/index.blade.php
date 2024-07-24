<x-app-layout>
    <div class="d-flex">
        <a href="{{ route('user.create') }}" class="btn btn-gray-800 d-inline-flex align-items-center me-2 my-3">
            <svg class="icon icon-xs me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
            Создать пользователя</a>
        </a>
    </div>
    @if(session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div>
        <div class="card border-0 shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class = "table table-sm table-centered table-nowrap mb-0 rounded">
                    <thead>
                        <th>Имя</th>
                        <th>Email</th>
                        <th>Роли</th>
                        <th>Дата создания</th>
                        <th>Действия</th>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if(!empty($user->getRoleNames()))
                                    @foreach($user->getRoleNames() as $roleName)
                                        <span class="badge bg-info text-dark">{{ $roleName }}</span>
                                    @endforeach
                                @endif
                            </td>
                            <td>{{$user->created_at}}</td>
                            <td class="d-flex">
                                <a href="{{ route('user.edit', $user->id) }}" class="btn btn-secondary mx-2">Редактировать</a>
                                <form action="{{ route('user.delete', $user->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class = "btn btn-danger">Удалить</a>
                                </form>
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
