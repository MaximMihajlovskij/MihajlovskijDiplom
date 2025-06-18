@extends('admin')

@section('title', 'Редактировать статус ожидания')

@section('action-edit')
    <h1>Редактирование статуса ожидания</h1>

    <form action="{{ route('admin.scud.updateaction', $action->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        <label>Название статуса ожидания</label>
        <input type="text" name="name_action" value="{{ $action->name_action }}" class="form-control">
        <button type="submit" class="btn btn-success mt-3">Сохранить</button>
    </form>
@endsection
