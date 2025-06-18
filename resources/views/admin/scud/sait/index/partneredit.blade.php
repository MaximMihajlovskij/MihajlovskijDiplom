@extends('admin')

@section('title', 'Редактировать партнёра')

@section('partner-edit')
    <h1>Редактирование партнёра</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('admin.scud.sait.index.partnerupdate', $partner->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        <label>Название</label>
        <input type="text" name="name" value="{{ $partner->name }}" class="form-control">

        <label>Фото</label>
        <input type="file" name="image" class="form-control">
        @if($partner->image)
            <img src="{{ asset('storage/' . $partner->image) }}" width="100">
        @endif

        <button type="submit" class="btn btn-success mt-3">Сохранить</button>
    </form>
@endsection
