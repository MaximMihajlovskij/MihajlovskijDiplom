@extends('admin')

@section('title', 'Редактировать камеру')

@section('repaircamera-edit')
    <h1>Редактирование заявки</h1>
    <form action="{{ route('admin.scud.updaterepaircamera', $repaircamera->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <label class="fw-bold mt-2">Статус выполнения</label>
        <div class="input-group">
            <select name="complete_id" class="form-select border border-primary rounded">
                <option value="" disabled selected>Выберите статус выполнения</option>
                @foreach($completeds as $completed)
                    <option value="{{ $completed->id }}" {{ $repaircamera->completed_id == $completed->id ? 'selected' : '' }}>
                        {{ $completed->СтатусВыполнения }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success mt-3">Сохранить</button>
    </form>
@endsection
