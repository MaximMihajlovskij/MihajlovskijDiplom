@extends('admin')

@section('title', 'Добавить партнёра на главную страницу')

@section('partner_create')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('admin.scud.sait.index.partnerstore') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <label>Логотип</label>
        <input type="text" name="name" class="form-control">

        <label>Логотип</label>
        <input type="file" name="image" class="form-control">

        <button type="submit" class="btn btn-success mt-3">Сохранить</button>
    </form>
@endsection
