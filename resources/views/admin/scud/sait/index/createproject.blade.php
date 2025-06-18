@extends('admin')

@section('title', 'Добавить выполненную работу на главную страницу')

@section('project_create')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('admin.scud.sait.index.storeproject') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label>Изображение</label>
        <input type="file" name="image" class="form-control">

        <button type="submit" class="btn btn-success mt-3">Сохранить</button>
    </form>
@endsection
