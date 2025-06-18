@extends('admin')

@section('title', 'Редактировать роль пользователя')

@section('user-editer')
    <h1>Редактирование роли пользователя {{ $user->name }}</h1>
    <form action="{{ route('admin.scud.updateuser', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <label for="role" class="fw-bold mt-2">Изменение роли пользователя</label>
        <div class="input-group">
            <select name="role" class="form-select border border-primary rounded">
                @foreach($role as $key => $value)
                    <option value="{{ $key }}" {{ $user->role == $key ? 'selected' : ''}}>
                        {{ $value }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success mt-3">Сохранить</button>
    </form>
@endsection
