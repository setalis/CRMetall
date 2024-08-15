<x-app-layout>
    <div class="container-fluid px-0 pt-3">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Создать разрешение
                            <a href="{{ route('role.index') }}" class="btn btn-danger float-end">Назад</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        @can('Создать роль')
                            <form action="{{ route('role.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="name">Наименование</label>
                                    <input type="text" name="name" id="name" class="form-control" />
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-info">Создать роль</button>
                                </div>
                            </form>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
