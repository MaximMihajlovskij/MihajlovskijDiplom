@extends('admin')

@section('title', 'Отзывы')

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
    <form action="{{ route('admin.scud.review') }}" method="GET" class="d-flex mb-3">
        <div class="input-group" style="max-width: 250px;">
            <input type="text" name="search" placeholder="Поиск отзыва" class="form-control form-control-sm" value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary btn-sm">
                <i class="fas fa-search"></i> <!-- Иконка поиска -->
            </button>
        </div>
    </form>
    <!-- Фильтрация по цене и фирме -->
    <form action="{{ route('admin.scud.review') }}" method="GET" class="d-flex align-items-center flex-wrap gap-2 mb-3">
        <div class="input-group input-group-sm" style="max-width: 220px;">
            <select name="user_id" class="form-select border border-primary rounded">
                <option value="">Все пользователи</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="input-group input-group-sm" style="max-width: 220px;">
            <select name="camera_id" class="form-select form-select-sm">
                <option value="">Все камеры</option>
                @foreach($cameras as $camera)
                    <option value="{{ $camera->id }}" {{ request('camera_id') == $camera->id ? 'selected' : '' }}>
                        {{ $camera->name_camera }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="input-group input-group-sm" style="max-width: 220px;">
            <select name="turniket_id" class="form-select form-select-sm">
                <option value="">Все турникеты</option>
                @foreach($turnikets as $turniket)
                    <option value="{{ $turniket->id }}" {{ request('turniket_id') == $turniket->id ? 'selected' : '' }}>
                        {{ $turniket->name_turniket }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="input-group input-group-sm" style="max-width: 220px;">
            <select name="barrier_id" class="form-select form-select-sm">
                <option value="">Все шлагбаумы</option>
                @foreach($barriers as $barrier)
                    <option value="{{ $barrier->id }}" {{ request('barrier_id') == $barrier->id ? 'selected' : '' }}>
                        {{ $barrier->name_barrier }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="input-group input-group-sm" style="max-width: 220px;">
            <select name="type" class="form-select form-select-sm">
                <option value="">Все типы</option>
                <option value="camera" {{ request('type') == 'camera' ? 'selected' : '' }}>Камеры</option>
                <option value="turniket" {{ request('type') == 'turniket' ? 'selected' : '' }}>Турникеты</option>
                <option value="barrier" {{ request('type') == 'barrier' ? 'selected' : '' }}>Шлагбаумы</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary btn-sm ms-2">Фильтровать</button>
    </form>
        
    <form action="{{ route('admin.scud.review') }}" method="GET" class="d-flex align-items-center gap-2 p-2 border rounded w-auto mt-2">
        <input type="date" name="date_from" class="form-control form-control-sm w-auto shadow-none" value="{{ request('date_from') }}">
        <input type="date" name="date_to" class="form-control form-control-sm w-auto shadow-none" value="{{ request('date_to') }}">
        <button type="submit" class="btn btn-primary btn-sm px-3">
            <i class="fas fa-filter"></i> Фильтровать
        </button>
    </form>
    <table class="table">
        <thead>
            <tr>
                <th>
                    <a href="{{ route('admin.scud.review', ['sort' => 'user_id', 'order' => request('order') === 'asc' ? 'desc' : 'asc']) }}">
                        Пользователь {!! request('sort') === 'user_id' ? (request('order') === 'asc' ? '🔼' : '🔽') : '' !!}
                    </a>
                </th>
                <th>Тип</th>
                <th>
                    <a href="{{ route('admin.scud.review', ['sort' => 'rating', 'order' => request('order') === 'asc' ? 'desc' : 'asc']) }}">
                        Товар {!! request('sort') === 'rating' ? (request('order') === 'asc' ? '🔼' : '🔽') : '' !!}
                    </a>
                </th>
                <th>
                    <a href="{{ route('admin.scud.review', ['sort' => 'rating', 'order' => request('order') === 'asc' ? 'desc' : 'asc']) }}">
                        Оценка {!! request('sort') === 'rating' ? (request('order') === 'asc' ? '🔼' : '🔽') : '' !!}
                    </a>
                </th>
                <th>Отзыв</th>
                <th>
                    <a href="{{ route('admin.scud.review', ['sort' => 'created_at', 'order' => request('order') === 'asc' ? 'desc' : 'asc']) }}">
                        Дата оставления отзыва {!! request('sort') === 'created_at' ? (request('order') === 'asc' ? '🔼' : '🔽') : '' !!}
                    </a>
                </th>
                <th>Действие</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reviews as $review)
            <tr>
                <td>{{ $review->user->name }}</td>
                <td>
                    {{ $review->turniket ? 'Турникет' : ($review->camera ? 'Камера' : ($review->barrier ? 'Шлагбаум' : '-')) }}
                </td>
                <td>
                        {{ $review->turniket ? $review->turniket->name_turniket : ($review->camera ? $review->camera->name_camera : ($review->barrier ? $review->barrier->name_barrier : '-')) }}
                </td>
                <td>{{ $review->rating }}</td>
                <td>{{ $review->content }}</td>
                <td>{{ $review->created_at }}</td>
                <td>
                    <form action="{{ route('admin.scud.delreview', $review->id) }}" method="POST" style="display:inline-block;">
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
