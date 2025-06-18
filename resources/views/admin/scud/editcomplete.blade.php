@extends('admin')

@section('title', 'Редактировать статус')

@section('complete_edit')
    <h1>Редактирование камеры</h1>

    <form action="{{ route('admin.scud.updatecomplete', $completed->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        <label>Название фирмы</label>
        <input type="text" name="СтатусВыполнения" value="{{ $completed->СтатусВыполнения }}" class="form-control">
        <button type="submit" class="btn btn-success mt-3">Сохранить</button>
    </form>
@endsection
