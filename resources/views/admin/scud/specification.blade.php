@extends('admin')

@section('title', 'Технические характеристики')

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
    <form action="{{ route('admin.scud.specification') }}" method="GET" class="d-flex mb-3">
        <div class="input-group" style="max-width: 250px;">
            <input type="text" name="search" placeholder="Поиск по названию" class="form-control form-control-sm" value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary btn-sm">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </form>

    <form action="{{ route('admin.scud.specification') }}" method="GET" class="d-flex gap-2 mb-3">
        <select name="type" class="form-select form-select-sm">
            <option value="">Все типы</option>
            <option value="camera" {{ request('type') == 'camera' ? 'selected' : '' }}>Камеры</option>
            <option value="turniket" {{ request('type') == 'turniket' ? 'selected' : '' }}>Турникеты</option>
            <option value="barrier" {{ request('type') == 'barrier' ? 'selected' : '' }}>Шлагбаумы</option>
        </select>
        <button type="submit" class="btn btn-primary btn-sm">Фильтровать</button>
    </form>
    <a href="{{ route('admin.scud.createspecification') }}" class="btn btn-primary mb-3">Добавить харктеристики</a>
    <table class="table">
        <thead>
            <tr>
                <th>Название</th>
                <th>Тип</th>
                <th>Дата создания характеристики</th>
                <th>Дата редактирования характеристики</th>
                <th>Значение</th>
                <th>Действие</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($specifications as $specification)
                <tr>
                    <td>
                        {{ $specification->turniket ? $specification->turniket->name_turniket : ($specification->camera ? $specification->camera->name_camera : ($specification->barrier ? $specification->barrier->name_barrier : '-')) }}
                    </td>
                    <td>
                        {{ $specification->turniket ? 'Турникет' : ($specification->camera ? 'Камера' : ($specification->barrier ? 'Шлагбаум' : '-')) }}
                    </td>
                    <td>{{ $specification->created_at }}</td>
                    <td>{{ $specification->updated_at }}</td>
                    <td>
                        <button class="btn btn-info btn-sm show-specifications" data-spec-id="{{ $specification->id }}">Характеристики</button>
                        <div id="specifications-{{ $specification->id }}" class="specifications-container" style="display: none;">
                            <ul>
                                <li><strong>Ключ:</strong> {{ $specification->key }}</li>
                                @foreach (explode('; ', $specification->value) as $val)
                                    <li><strong>Значение:</strong> {{ $val }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </td>
                    <td>
                        <a href="{{ route('admin.scud.editspecification', $specification->id) }}" class="btn btn-warning btn-sm">Редактировать</a>
                        <form action="{{ route('admin.scud.delspecification', $specification->id) }}" method="POST" style="display:inline-block;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Удалить</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll(".show-specifications").forEach(button => {
                button.addEventListener("click", function () {
                    const specId = this.getAttribute("data-spec-id");
                    const specContainer = document.getElementById(`specifications-${specId}`);

                    if (specContainer.style.display === "none") {
                        specContainer.style.display = "block";
                        this.textContent = "Скрыть";
                    } else {
                        specContainer.style.display = "none";
                        this.textContent = "Характеристики";
                    }
                });
            });
        });
    </script>
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