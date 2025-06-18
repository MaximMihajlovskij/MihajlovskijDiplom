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

    <form action="{{ route('admin.scud.crudcamera') }}" method="GET" class="d-flex mb-3">
        <div class="input-group" style="max-width: 250px;">
            <input type="text" name="search" placeholder="Поиск камеры" class="form-control form-control-sm" value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary btn-sm">
                <i class="fas fa-search"></i> <!-- Иконка поиска -->
            </button>
        </div>
    </form>

    <!-- Фильтрация по цене и фирме -->
    <form action="{{ route('admin.scud.crudcamera') }}" method="GET" class="d-flex align-items-center flex-wrap gap-2 mb-3">
        <div class="input-group input-group-sm" style="max-width: 180px;">
            <input type="number" name="price_min" placeholder="Цена от" class="form-control" value="{{ request('price_min') }}">
        </div>
        
        <div class="input-group input-group-sm" style="max-width: 180px;">
            <input type="number" name="price_max" placeholder="Цена до" class="form-control" value="{{ request('price_max') }}">
        </div>

        <div class="input-group input-group-sm" style="max-width: 220px;">
            <select name="firm_id" class="form-select border border-primary rounded">
                <option value="">Выберите фирму</option>
                @foreach($firms as $firm)
                    <option value="{{ $firm->id }}" {{ request('firm_id') == $firm->id ? 'selected' : '' }}>
                        {{ $firm->Фирма }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary btn-sm ms-2">Фильтровать</button>
    </form>

    <a href="{{ route('admin.scud.createcamera') }}" class="btn btn-primary mb-3">Добавить камеру</a>

    <table class="table">
        <thead>
            <tr>
                <th>
                    <a href="{{ route('admin.scud.crudcamera', ['sort' => 'name_camera', 'order' => request('order') === 'asc' ? 'desc' : 'asc']) }}">
                        Название {!! request('sort') === 'name_camera' ? (request('order') === 'asc' ? '🔼' : '🔽') : '' !!}
                    </a>
                </th>
                <th>Модель</th>
                <th>Серийный номер</th>
                <th>Фото</th>
                <th>
                    <a href="{{ route('admin.scud.crudcamera', ['sort' => 'price', 'order' => request('order') === 'asc' ? 'desc' : 'asc']) }}">
                        Цена {!! request('sort') === 'price' ? (request('order') === 'asc' ? '🔼' : '🔽') : '' !!}
                    </a>
                </th>
                <th>
                    <a href="{{ route('admin.scud.crudcamera', ['sort' => 'firm_id', 'order' => request('order') === 'asc' ? 'desc' : 'asc']) }}">
                        Фирма {!! request('sort') === 'firm_id' ? (request('order') === 'asc' ? '🔼' : '🔽') : '' !!}
                    </a>
                </th>
                <th>Количество в наличии</th>
                <th>Техническая характеристика</th>
                <th>Аксессуары</th>
                <th>Действие</th>
            </tr>
        </thead>

        <tbody>
            @if(!empty($cameras))
                @foreach ($cameras as $camera)
                    <tr>
                        <td>{{ $camera->name_camera }}</td>
                        <td>{{ $camera->model }}</td>
                        <td>{{ $camera->serial_namber }}</td>
                        <td>
                            @if($camera->image)
                                <img src="{{ asset('storage/' . $camera->image) }}" width="80">
                            @else
                                <span>Нет фото</span>
                            @endif
                        </td>    
                        <td>{{ $camera->price }}</td>
                        <td>{{ $camera->firm->Фирма }}</td>
                        <td class="{{ $camera->quantity < 0 ? 'text-danger fw-bold' : '' }}">
                            {{ $camera->quantity }}
                        </td>
                        <td>
                            @if($camera->specifications->isNotEmpty())
                                <button class="btn btn-info btn-sm show-specifications" data-camera-id="{{ $camera->id }}">
                                    Характеристики
                                </button>
                                    <div id="specifications-{{ $camera->id }}" class="specifications-container" style="display: none;">
                                        <ul>
                                            @foreach ($camera->specifications as $specification)
                                                <li><strong>{{ $specification->key }}:</strong> {{ $specification->value }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                            @else
                                <span>Нет характеристик</span>
                            @endif
                        </td>
                        <td>
                            @if($camera->accessories->isNotEmpty())
                                <ul>
                                    @foreach ($camera->accessories as $accessorie)
                                        <li>
                                            <a href="{{ route('admin.scud.showaccessories', $accessorie->id) }}">
                                                {{ $accessorie->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <span>Нет аксессуаров</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.scud.editercamera', $camera->id) }}" class="btn btn-warning">Редактировать</a>
                            <form action="{{ route('admin.scud.delcamera', $camera->id) }}" method="POST" style="display:inline-block;">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger">Удалить</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr><td colspan="3">Нет доступных камер.</td></tr>
            @endif    
        </tbody>
    </table>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll(".show-specifications").forEach(button => {
                button.addEventListener("click", function () {
                    const cameraId = this.getAttribute("data-camera-id");
                    const specContainer = document.getElementById(`specifications-${cameraId}`);

                    if (specContainer.style.display === "none") {
                        specContainer.style.display = "block";
                        this.textContent = "Скрыть характеристики";
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
