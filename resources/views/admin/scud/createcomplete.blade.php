@extends('admin')

@section('title', 'Добавить статус')

@section('complete_create')
    <form action="{{ route('admin.scud.storecomplete') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label>Название фирмы</label>
        <input type="text" name="СтатусВыполнения" class="form-control">
        <button type="submit" class="btn btn-success mt-3">Сохранить</button>
    </form>
@endsection
