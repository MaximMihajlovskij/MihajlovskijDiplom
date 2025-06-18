@extends('admin')

@section('title', 'Информация об аксессуаре')

@section('content')
    <h2>{{ $accessorie->name }}</h2>
    
    <p><strong>Описание:</strong>{{ $accessorie->description }}</p>
    <p><strong>Цена:</strong>{{ $accessorie->price }} BYN</p>

    <p><strong>Турникет:</strong> {{ $accessorie->turniket ? $accessorie->turniket->name_turniket : '-' }}</p>
    <p><strong>Камера:</strong> {{ $accessorie->camera ? $accessorie->camera->name_camera : '-' }}</p>
    <p><strong>Шлагбаум:</strong> {{ $accessorie->barrier ? $accessorie->barrier->name_barrier : '-' }}</p>

    @if($accessorie->image)
        <img src="{{ asset('storage/' . $accessorie->image) }}" width="150">
    @else
        <p>Нет фото</p>
    @endif

    <div style="margin-top: 20px;">
        <a href="{{ route('admin.scud.crudcamera') }}" class="btn btn-primary">Назад</a>
    </div>
@endsection
