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


            <div class="" >
                <div class="">
                    <form action="{{ route('cash.update', $item->id) }}" method="POST" name = "updateCash">
                        @csrf
                        @method('PATCH')
                    <div class="content">
                        <div class="header">

                        </div>
                        <div class="">
                                <div class="mb-3">
                                    <label for="type_operation" class="form-label">Введите сумму пополнения</label>
                                    <select class="form-select" aria-label="Default select example" name ="type_operation">
                                        <option selected>Выбрать тип операции</option>
                                        <option value="3" @if($item->type_operation == 3) selected @endif>Пополнение кассы</option>
                                        <option value="4" @if($item->type_operation == 4) selected @endif>Снятие средств из кассы</option>
                                    </select>
                                    @error('type_operation')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="sum_operation" class="form-label">Введите сумму пополнения</label>
                                    <input type="number" class="form-control" name = "sum_operation" id="sum_operation" value="{{ $item->sum_operation }}">
                                    @error('sum_operation')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                @php
                                    $operation = \App\Models\Operation::find($item->operation_id);
                                @endphp
                                <div class="mb-3">
                                    <label for="comment" class="form-label">Комментарий</label>
                                    <textarea class="form-control" name = "comment" id="comment">{{ $operation->comment }}</textarea>
                                    @error('comment')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <input type="hidden" value = "{{ Auth::user()->id }}" name = "user_id">
                        </div>
                        <div class="modal-footer">
                            <a href="{{ route('cash.index') }}" type="button" class="btn btn-secondary" >Закрыть</a>
                            <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>


        </div>
</x-app-layout>
