@extends('admin')

@section('title', 'Редактировать изображение выполненной работы')

@section('project-edit')
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
    <form action="{{ route('admin.scud.sait.index.updateproject', $project->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        <label>Изображение</label>
        <input type="file" name="image" class="form-control">
        @if($project->image)
            <img src="{{ asset('storage/' . $project->image) }}" width="100">
        @endif

        <button type="submit" class="btn btn-success mt-3">Сохранить</button>
    </form>
@endsection
