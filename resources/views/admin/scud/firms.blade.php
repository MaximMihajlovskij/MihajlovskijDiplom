@extends('admin')

@section('title', 'Фирмы')

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
    <form action="{{ route('admin.scud.firms') }}" method="GET" class="d-flex mb-3">
        <div class="input-group" style="max-width: 250px;">
            <input type="text" name="search" placeholder="Поиск фирмы" class="form-control form-control-sm" value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary btn-sm">
                <i class="fas fa-search"></i> <!-- Иконка поиска -->
            </button>
        </div>
    </form>

    <!-- Фильтрация по цене и фирме -->
    <form action="{{ route('admin.scud.firms') }}" method="GET" class="d-flex align-items-center flex-wrap gap-2 mb-3">
        <div class="input-group input-group-sm" style="max-width: 220px;">
            <select name="Фирма" class="form-select border border-primary rounded">
                <option value="">Все фирмы</option>
                @foreach($firms as $firm)
                    <option value="{{ $firm->Фирма}}" {{ request('Фирма') == $firm->Фирма ? 'selected' : '' }}>
                        {{ $firm->Фирма }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary btn-sm ms-2">Фильтровать</button>
    </form>

    <a href="{{ route('admin.scud.createfirms') }}" class="btn btn-primary mb-3">Добавить фирму</a>

    <table class="table">
        <thead>
            <tr>
                <th>
                    <a href="{{ route('admin.scud.firms', ['sort' => 'Фирма', 'order' => request('order') === 'asc' ? 'desc' : 'asc']) }}">
                        Название {!! request('sort') === 'Фирма' ? (request('order') === 'asc' ? '🔼' : '🔽') : '' !!}
                    </a>
                </th>
                <th>Действие</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($firms as $firm)
                <tr>
                    <td>{{ $firm->Фирма }}</td>
                    <td>
                        <a href="{{ route('admin.scud.editfirms', $firm->id) }}" class="btn btn-warning">Редактировать</a>
                        <form action="{{ route('admin.scud.delfirms', $firm->id) }}" method="POST" style="display:inline-block;">
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
