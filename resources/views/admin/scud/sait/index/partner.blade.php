@extends('admin')

@section('title', 'Главная страница сайта(партнёры)')

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
    
    <a href="{{ route('admin.scud.sait.index.partnercreate') }}" class="btn btn-primary mb-3">Добавить изображение в баннере</a>
    <table class="table">
        <thead>
            <tr>
                <th>Партнёр</th>
                <th>Изображение</th>
                <th>Действие</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($partners as $partner)
            <tr>
                <td>{{ $partner->name }}</td>
                <td>
                    @if($partner->image)
                        <img src="{{ asset('storage/' . $partner->image) }}" alt="" width="200">
                    @else
                        <span>Нет фото</span>
                    @endif
                </td>  
                <td>
                    <a href="{{ route('admin.scud.sait.index.partneredit', $partner->id) }}" class="btn btn-warning">Редактировать</a>
                    <form action="{{ route('admin.scud.sait.index.partnerdel', $partner->id) }}" method="POST" style="display:inline-block;">
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
