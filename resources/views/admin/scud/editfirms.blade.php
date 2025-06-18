@extends('admin')

@section('title', 'Редактировать фирму')

@section('firms_edit')
    <h1>Редактирование камеры</h1>

    <form action="{{ route('admin.scud.updatefirms', $firm->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        <label>Название фирмы</label>
        <input type="text" name="Фирма" value="{{ $firm->Фирма }}" class="form-control">
        <button type="submit" class="btn btn-success mt-3">Сохранить</button>
    </form>
@endsection
