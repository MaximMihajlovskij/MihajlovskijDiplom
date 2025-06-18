@extends('admin')

@section('title', 'Видеокамеры')

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
    <form action="{{ route('admin.scud.users') }}" method="GET" class="d-flex mb-3">
        <div class="input-group" style="max-width: 250px;">
            <input type="text" name="search" placeholder="Поиск пользователя" class="form-control form-control-sm" value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary btn-sm">
                <i class="fas fa-search"></i> <!-- Иконка поиска -->
            </button>
        </div>
    </form>
    <form action="{{ route('admin.scud.users') }}" method="GET" class="d-flex align-items-center flex-wrap gap-2 mb-3">
        <div class="input-group input-group-sm" style="max-width: 220px;">
            <select name="role" class="form-select border border-primary rounded">
                <option value="">Все роли</option>
                @foreach($users->pluck('role')->unique() as $role)
                    <option value="{{ $role }}" {{ request('role') == $role ? 'selected' : '' }}>
                        {{ $role }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary btn-sm ms-2">Фильтровать</button>
    </form>    
    <table class="table">
        <thead>
            <tr>
                <th>Аватарка</th>
                <th>
                    <a href="{{ route('admin.scud.users', ['sort' => 'name', 'order' => request('order') === 'asc' ? 'desc' : 'asc']) }}">
                        Пользователь {!! request('sort') === 'name' ? (request('order') === 'asc' ? '🔼' : '🔽') : '' !!}
                    </a>
                </th>
                <th>Email</th>
                <th>Телефон</th>
                <th>Адрес</th>
                <th>Пароль</th>
                <th>
                    <a href="{{ route('admin.scud.users', ['sort' => 'role', 'order' => request('order') === 'asc' ? 'desc' : 'asc']) }}">
                        Роль {!! request('sort') === 'role' ? (request('order') === 'asc' ? '🔼' : '🔽') : '' !!}
                    </a>
                </th>
                <th>Действие</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>
                        @if(!empty($user->avatar))
                            <img src="{{ asset('storage/' . $user->avatar ) }}" alt="" class="img-fluid rounded-circle mb-3" width="120">
                        @else
                            <img id="avatarPreview" src="{{ asset('storage/banners/аватарка.jpg') }}" class="img-fluid rounded-circle mb-3" width="120">    
                        @endif    
                    </td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->telephon }}</td>
                    <td>{{ $user->address }}</td>
                    <td>{{ $user->password }}</td> 
                    <td>{{ $user->role }}</td>
                    <td>
                        <a href="{{ route('admin.scud.useredit', $user->id) }}" class="btn btn-warning">Редактировать</a>
                        <form action="{{ route('admin.scud.delusers', $user->id ) }}" method="POST" style="display:inline-block;">
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
