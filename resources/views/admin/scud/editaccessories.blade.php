@extends('admin')

@section('title', 'Редактировать аксессуар')

@section('accessories-edit')
    <h1>Редактирование аксессуара</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('admin.scud.updateaccessories', $accessorie) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        <label>Название</label>
        <input type="text" name="name" value="{{ $accessorie->name }}" class="form-control">

        <label class="fw-bold mt-2">Турникет</label>
        <div class="input-group">
            <select name="turniket_id" class="form-select border border-primary rounded">
                <option value="" disabled selected>Выберите турникет</option>
                @foreach($turnikets as $turniket)
                    <option value="{{ $turniket->id }}" {{ $accessorie->turniket_id == $turniket->id ? 'selected' : '' }}>
                        {{ $turniket->name_turniket }}
                    </option>
                @endforeach
            </select>
        </div>

        <label class="fw-bold mt-2">Видеокамера</label>
        <div class="input-group">
            <select name="camera_id" class="form-select border border-primary rounded">
                <option value="" disabled selected>Выберите видеокамеру</option>
                @foreach($cameras as $camera)
                    <option value="{{ $camera->id }}" {{ $accessorie->camera_id == $camera->id ? 'selected' : '' }}>
                        {{ $camera->name_camera }}
                    </option>
                @endforeach
            </select>
        </div>

        <label class="fw-bold mt-2">Шлагбаум</label>
        <div class="input-group">
            <select name="barrier_id" class="form-select border border-primary rounded">
                <option value="" disabled selected>Выберите шлагбаум</option>
                @foreach($barriers as $barrier)
                    <option value="{{ $barrier->id }}" {{ $accessorie->barrier_id == $barrier->id ? 'selected' : '' }}>
                        {{ $barrier->name_barrier }}
                    </option>
                @endforeach
            </select>
        </div>

        <label>Фото</label>
        <input type="file" name="image" class="form-control">
        @if($accessorie->image)
            <img src="{{ asset('storage/' . $accessorie->image) }}" width="100">
        @endif

        <label>Количество в наличии</label>
        <input type="number" name="quantity" value="{{ $accessorie->quantity }}" class="form-control">

        <label>Прибавить количество аксессуаров</label>
        <input type="number" name="add_quantity" value="0" class="form-control">

        <label>Описание</label>
        <textarea name="description"></textarea>

        <label>Цена</label>
        <input type="number" name="price" value="{{ $accessorie->price }}" class="form-control">

        <button type="submit" class="btn btn-success mt-3">Сохранить</button>
    </form>
@endsection
