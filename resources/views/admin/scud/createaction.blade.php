@extends('admin')

@section('title', 'Добавить статус ожидания')

@section('action_create')
    <form action="{{ route('admin.scud.storeaction') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label>Название статуса ожидания</label>
        <input type="text" name="name_action" class="form-control">
        <button type="submit" class="btn btn-success mt-3">Сохранить</button>
    </form>
@endsection
