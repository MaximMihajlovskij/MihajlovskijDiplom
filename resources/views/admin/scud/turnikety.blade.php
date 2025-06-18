@extends('admin')

@section('title', 'Турникеты')

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
    <form action="{{ route('admin.scud.turnikety') }}" method="GET" class="d-flex mb-3">
        <div class="input-group" style="max-width: 250px;">
            <input type="text" name="search" placeholder="Поиск турникетов" class="form-control form-control-sm" value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary btn-sm">
                <i class="fas fa-search"></i> <!-- Иконка поиска -->
            </button>
        </div>
    </form>

    <!-- Фильтрация по цене и фирме -->
    <form action="{{ route('admin.scud.turnikety') }}" method="GET" class="d-flex align-items-center flex-wrap gap-2 mb-3">
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

    <a href="{{ route('admin.scud.createturniket') }}" class="btn btn-primary mb-3">Добавить турникет</a>
    <table class="table">
        <thead>
            <tr>
                <th>
                    <a href="{{ route('admin.scud.turnikety', ['sort' => 'name_turniket', 'order' => request('order') === 'asc' ? 'desc' : 'asc']) }}">
                        Название {!! request('sort') === 'name_camera' ? (request('order') === 'asc' ? '🔼' : '🔽') : '' !!}
                    </a>
                </th>
                <th>Модель</th>
                <th>Серийный номер</th>
                <th>Фото</th>
                <th>
                    <a href="{{ route('admin.scud.turnikety', ['sort' => 'price', 'order' => request('order') === 'asc' ? 'desc' : 'asc']) }}">
                        Цена {!! request('sort') === 'price' ? (request('order') === 'asc' ? '🔼' : '🔽') : '' !!}
                    </a>
                </th>
                <th>
                    <a href="{{ route('admin.scud.turnikety', ['sort' => 'firm_id', 'order' => request('order') === 'asc' ? 'desc' : 'asc']) }}">
                        Фирма {!! request('sort') === 'firm_id' ? (request('order') === 'asc' ? '🔼' : '🔽') : '' !!}
                    </a>
                </th>
                <th>Количество в наличии</th>
                <th>Описание</th>
                <th>Техническая характеристика</th>
                <th>Аксессуары</th>
                <th>Действие</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($turnikets as $turniket)
            <tr>
                <td>{{ $turniket->name_turniket }}</td>
                <td>{{ $turniket->model }}</td>
                <td>{{ $turniket->serial_namber }}</td>
                <td>
                    @if($turniket->image)
                        <img src="{{ asset('storage/' . $turniket->image) }}" width="80">
                    @else
                        <span>Нет фото</span>
                    @endif
                </td>  
                <td>{{ $turniket->price }}</td>
                <td>{{ $turniket->firm->Фирма }}</td>
                <td class="{{ $turniket->quantity < 0 ? 'text-danger fw-bold' : '' }}">
                            {{ $turniket->quantity }}
                        </td>
                <td>{{ $turniket->description }}</td>
                <td>
                    @if($turniket->specifications->isNotEmpty())
                    <button class="btn btn-info btn-sm show-specifications" data-turniket-id="{{ $turniket->id }}">
                         Характеристики
                    </button>
                        <div id="specifications-{{$turniket->id }}" class="specifications-container" style="display: none;">
                            <ul>
                                @foreach ($turniket->specifications as $specification)
                                    <li><strong>{{ $specification->key }}:</strong> {{ $specification->value }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @else
                        <span>Нет характеристик</span>
                    @endif
                </td>
                <td>
                    @if($turniket->accessories->isNotEmpty())
                        <ul>
                            @foreach ($turniket->accessories as $accessorie)
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
                    <a href="{{ route('admin.scud.updateturniket', $turniket->id) }}" class="btn btn-warning">Редактировать</a>
                    <form action="{{ route('admin.scud.delturniket', $turniket->id) }}" method="POST" style="display:inline-block;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger">Удалить</button>
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
                    const turniketId = this.getAttribute("data-turniket-id");
                    const specContainer = document.getElementById(`specifications-${turniketId}`);

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
