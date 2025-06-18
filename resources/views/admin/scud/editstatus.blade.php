@extends('admin')

@section('title', 'Редактировать статус')

@section('status_edit')
    <h1>Редактирование статуса</h1>

    <form action="{{ route('admin.scud.updatestatus', $status->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        <label>Название фирмы</label>
        <input type="text" name="СтатусСрочности" value="{{ $status->СтатусСрочности }}" class="form-control">
        <button type="submit" class="btn btn-success mt-3">Сохранить</button>
    </form>
@endsection
