@extends('admin')

@section('title', 'Редактировать камеру')

@section('banner-edit')
    <h1>Редактирование баннера главной страницы</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('admin.scud.updatebanner', $banner) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        <label>Изображение</label>
        <input type="file" name="image" class="form-control">
        @if($banner->image)
            <img src="{{ asset('storage/' . $banner->image) }}" width="100">
        @endif

        <button type="submit" class="btn btn-success mt-3">Сохранить</button>
    </form>
@endsection
