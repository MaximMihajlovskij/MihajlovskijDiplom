@extends('admin')

@section('title', 'Добавить баннер на главную страницу')

@section('banner_create')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('admin.scud.sait.index.storebanner') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <label>Фото</label>
        <input type="file" name="image_path" class="form-control">

        <button type="submit" class="btn btn-success mt-3">Сохранить</button>
    </form>
@endsection
