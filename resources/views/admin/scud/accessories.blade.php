@extends('admin')

@section('title', 'Аксессуары')

@section('content')
    <style>
        .flash-message {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: #28a745; /* Зелёный фон */
            color: white;
            font-size: 18px;
            font-weight: bold;
            padding: 12px 18px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            display: flex;
            align-items: center;
            gap: 10px;
            animation: fadeIn 0.5s ease-in-out;
        }

        .check-icon {
            font-size: 24px;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeOut {
            from { opacity: 1; }
            to { opacity: 0; transform: translateY(20px); }
        }
    </style>
    @if(session()->has('success'))
        <div class="flash-message" id="flashMessage">
            <span class="check-icon">✔</span> {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('admin.scud.createaccessories') }}" class="btn btn-primary mb-3">Добавить аксессуар</a>
    <table class="table">
        <thead>
            <tr>
                <th>
                    <a href="{{ route('admin.scud.turnikety', ['sort' => 'name', 'order' => request('order') === 'asc' ? 'desc' : 'asc']) }}">
                        Название {!! request('sort') === 'name' ? (request('order') === 'asc' ? '🔼' : '🔽') : '' !!}
                    </a>
                </th>
                <th>Турникет</th>
                <th>Видеокамера</th>
                <th>Шлагбаум</th>
                <th>Изображение</th>
                <th>Описание</th>
                <th>Цена</th>
                <th>Количество</th>
                <th>Действие</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($accessories as $accessorie)
            <tr>
                <td>{{ $accessorie->name }}</td>
                <td>
                    @if($accessorie->turniket_id)
                        <p>{{$accessorie->turniket->name_turniket}}</p>   
                    @else
                        <span>-</span>
                    @endif 
                </td>
                <td>
                    @if($accessorie->camera_id)
                        <p>{{$accessorie->camera->name_camera}}</p>    
                    @else
                        <span>-</span>
                    @endif
                </td>
                <td>
                    @if($accessorie->barrier_id)
                        <p>{{$accessorie->barrier->name_barrier}}</p>
                    @else
                        <span>-</span>
                    @endif
                </td>
                 
                <td>
                    @if($accessorie->image)
                        <img src="{{ asset('storage/' . $accessorie->image) }}" width="80">
                    @else
                        <span>Нет фото</span>
                    @endif
                </td>  
                <td>{{ $accessorie->description }}</td>
                <td>{{ $accessorie->price }}</td>
                <td class="{{ $accessorie->quantity < 0 ? 'text-danger fw-bold' : '' }}">
                    {{ $accessorie->quantity }}
                </td>
                <td>
                    <a href="{{ route('admin.scud.updateaccessories', $accessorie->id) }}" class="btn btn-warning">Редактировать</a>
                    <form action="{{ route('admin.scud.delaccessories', $accessorie->id) }}" method="POST" style="display:inline-block;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger">Удалить</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <script>
        setTimeout(() => {
            let flashMessage = document.getElementById('flashMessage');
            if (flashMessage) {
                flashMessage.style.animation = 'fadeOut 1s ease-in-out';
                setTimeout(() => flashMessage.remove(), 1000);
            }
        }, 3000);
    </script>
@endsection
