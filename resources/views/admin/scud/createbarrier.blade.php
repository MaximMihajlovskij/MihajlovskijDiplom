@extends('admin')

@section('title', 'Добавить шлагбаум')

@section('barrier_create')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('admin.scud.storebarrier') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label>Название</label>
        <input type="text" name="name_barrier" class="form-control">

        <label>Модель</label>
        <input type="text" name="model" class="form-control">

        <label>Серийный номер</label>
        <input type="text" name="serial_namber" class="form-control">

        <label>Фото</label>
        <input type="file" name="image" class="form-control">

        <label>Описание</label>
        <textarea name="description"></textarea>

        <label>Количество в наличии</label>
        <input type="number" name="quantity" class="form-control">

        <label>Цена</label>
        <input type="number" name="price" class="form-control">

        <label>Фирма</label>
        <select name="firm_id" class="form-select" required>
            @foreach($firms as $firm)
                <option value="{{ $firm->id }}">{{ $firm->Фирма }}</option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-success mt-3">Сохранить</button>
    </form>
@endsection
