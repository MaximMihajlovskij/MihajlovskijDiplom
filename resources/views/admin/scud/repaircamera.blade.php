@extends('admin')

@section('title', 'Заявки на ремонт видеокамер')

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
    <form action="{{ route('admin.scud.repaircamera') }}" method="GET" class="d-flex mb-3">
        <div class="input-group" style="max-width: 250px;">
            <input type="text" name="search" placeholder="Поиск заявки" class="form-control form-control-sm" value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary btn-sm">
                <i class="fas fa-search"></i> <!-- Иконка поиска -->
            </button>
        </div>
    </form>

    <form action="{{ route('export.pdf') }}" method="GET" class="d-flex align-items-center gap-2 flex-wrap">
        <input type="date" name="date_from" class="form-control form-control-sm w-auto shadow-none" value="{{ request('date_from') }}">
        <input type="date" name="date_to" class="form-control form-control-sm w-auto shadow-none" value="{{ request('date_to') }}">
        <button type="submit" class="btn btn-danger btn-sm px-3">
            <i class="fas fa-file-pdf"></i> Экспорт PDF
        </button>
    </form>

    <form action="{{ route('admin.scud.repaircamera') }}" method="GET" class="d-flex align-items-center gap-2 p-2 border rounded w-auto mt-2">
        <input type="date" name="date_from" class="form-control form-control-sm w-auto shadow-none" value="{{ request('date_from') }}">
        <input type="date" name="date_to" class="form-control form-control-sm w-auto shadow-none" value="{{ request('date_to') }}">
        <button type="submit" class="btn btn-primary btn-sm px-3">
            <i class="fas fa-filter"></i> Фильтровать
        </button>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th>Пользователь</th>
                <th>
                    <a href="{{ route('admin.scud.repaircamera', ['sort' => 'name_camera', 'order' => request('order') === 'asc' ? 'desc' : 'asc']) }}">
                        Название камеры{!! request('sort') === 'name_camera' ? (request('order') === 'asc' ? '🔼' : '🔽') : '' !!}
                    </a>
                </th>
                <th>
                    <a href="{{ route('admin.scud.repaircamera', ['sort' => 'DateCreateRepair', 'order' => request('order') === 'asc' ? 'desc' : 'asc']) }}">
                        Дата создания заявки{!! request('sort') === 'DateCreateRepair' ? (request('order') === 'asc' ? '🔼' : '🔽') : '' !!}
                    </a>
                </th>
                <th>Изображение</th>
                <th>Телефон</th>
                <th>Email</th>
                <th>Описание проблемы</th>
                <th>
                    <a href="{{ route('admin.scud.repaircamera', ['sort' => 'status_id', 'order' => request('order') === 'asc' ? 'desc' : 'asc']) }}">
                        Статус срочности{!! request('sort') === 'status_id' ? (request('order') === 'asc' ? '🔼' : '🔽') : '' !!}
                    </a>
                </th>
                <th>
                    <a href="{{ route('admin.scud.repaircamera', ['sort' => 'complete_id', 'order' => request('order') === 'asc' ? 'desc' : 'asc']) }}">
                        Статус выполнения{!! request('sort') === 'complete_id' ? (request('order') === 'asc' ? '🔼' : '🔽') : '' !!}
                    </a>
                </th>
                <th>Действие</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($repairscameras as $repaircamera)
                <tr>
                    <td>{{ $repaircamera->user->name }}</td>
                    <td>{{ $repaircamera->name_camera }}</td>
                    <td>{{ $repaircamera->DateCreateRepair }}</td>
                    <td>
                        @if($repaircamera->image)
                            <img src="{{ asset('storage/' . $repaircamera->image) }}" width="80" class="img-thumbnail" 
                                onclick="showEnlargedImage('{{ asset('storage/' . $repaircamera->image) }}')">
                            <!-- Модальное окно для увеличенного изображения -->
                            <div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Просмотр изображения</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <img id="modalImage" src="" class="img-fluid">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <span>Нет фото</span>
                        @endif     
                    </td>
                    <td>{{ $repaircamera->telephon }}</td>
                    <td>{{ $repaircamera->email}}</td>
                    <td>{{ $repaircamera->ProblemDescription }}</td>
                    <td>{{ $repaircamera->status->СтатусСрочности }}</td>
                    <td>
                        @if($repaircamera->complete)
                            {{ $repaircamera->complete->СтатусВыполнения }}
                        @else
                            <span>Статус отсутствует</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.scud.editrepaircamera', $repaircamera->id) }}" class="btn btn-warning">Редактировать</a>
                        <form action="{{ route('admin.scud.delrepaircamera', $repaircamera->id) }}" method="POST" style="display:inline-block;">
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
    <script>
        function showEnlargedImage(imageUrl) {
            document.getElementById('modalImage').src = imageUrl;

            var imageModal = new bootstrap.Modal(document.getElementById('imageModal'));
            imageModal.show();
        }
    </script>
@endsection
