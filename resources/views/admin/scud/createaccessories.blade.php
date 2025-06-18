@extends('admin')

@section('title', 'Добавить аксессуар')

@section('accessories_create')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('admin.scud.storeaccessories') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label>Название</label>
        <input type="text" name="name" class="form-control">

        <label>Турникет</label>
        <select name="turniket_id" class="form-select">
            <option value="">-</option>
            @foreach($turnikets as $turniket)
                <option value="{{ $turniket->id }}">{{ $turniket->name_turniket }}</option>
            @endforeach
        </select>

        <label>Видеокамера</label>
        <select name="camera_id" class="form-select">
            <option value="">-</option>
            @foreach($cameras as $camera)
                <option value="{{ $camera->id }}">{{ $camera->name_camera }}</option>
            @endforeach
        </select>

        <label>Шлагбаум</label>
        <select name="barrier_id" class="form-select">
            <option value="">-</option>
            @foreach($barriers as $barrier)
                <option value="{{ $barrier->id }}">{{ $barrier->name_barrier }}</option>
            @endforeach
        </select>

        <label>Фото</label>
        <input type="file" name="image" class="form-control">

        <label>Количество в наличии</label>
        <input type="number" name="quantity" class="form-control">

        <label>Описание</label>
        <textarea name="description"></textarea>

        <label>Цена</label>
        <input type="number" name="price" class="form-control">

        <button type="submit" class="btn btn-success mt-3">Сохранить</button>
    </form>
@endsection
