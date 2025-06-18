@extends('admin')

@section('title', 'Редактировать камеру')

@section('camera-edit')
    <h1>Редактирование камеры</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('admin.scud.updatecamera', $camera) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        <label>Название</label>
        <input type="text" name="name_camera" value="{{ $camera->name_camera }}" class="form-control">

        <label>Модель</label>
        <input type="text" name="model" value="{{ $camera->model }}" class="form-control">

        <label>Серийный номер</label>
        <input type="text" name="serial_namber" value="{{ $camera->serial_namber }}" class="form-control">

        <label>Фото</label>
        <input type="file" name="image" class="form-control">
        @if($camera->image)
            <img src="{{ asset('storage/' . $camera->image) }}" width="100">
        @endif

        <label>Цена</label>
        <input type="number" name="price" value="{{ $camera->price }}" class="form-control">

        <label>Количество в наличии</label>
        <input type="number" name="quantity" value="{{ $camera->quantity }}" class="form-control">

        <label>Прибавить количество камер</label>
        <input type="number" name="add_quantity" value="0" class="form-control">

        <label class="fw-bold mt-2">Фирма</label>
        <div class="input-group">
            <select name="firm_id" class="form-select border border-primary rounded">
                <option value="" disabled selected>Выберите фирму</option>
                @foreach($firms as $firm)
                    <option value="{{ $firm->id }}" {{ $camera->firm_id == $firm->id ? 'selected' : '' }}>
                        {{ $firm->Фирма }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success mt-3">Сохранить</button>
    </form>
@endsection
