<x-app-layout>
    <div class="container-fluid px-0 pt-3">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Редактировать разрешение
                            <a href="{{ url('permissions') }}" class="btn btn-danger float-end">Назад</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('permissions.update', $item->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="mb-3">
                                <label for="name">Наименование</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ $item->name }}" />
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-info">Изменить разрешение</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
