@extends('admin')

@section('title', 'Добавить фирму')

@section('firms_create')
    <form action="{{ route('admin.scud.storefirms') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label>Название фирмы</label>
        <input type="text" name="Фирма" class="form-control">
        <button type="submit" class="btn btn-success mt-3">Сохранить</button>
    </form>
@endsection
