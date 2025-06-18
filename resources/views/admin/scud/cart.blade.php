@extends('admin')

@section('title', 'Заказы')

@section('content')
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
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

        .status-success { color: #28a745; font-weight: bold; } /* ✅ Зеленый - успешный статус */
        .status-warning { color: #ffc107; font-weight: bold; } /* ⚠ Желтый - внимание */
        .status-danger { color: #dc3545; font-weight: bold; } /* ❌ Красный - ошибка */
        .status-info { color: #17a2b8; font-weight: bold; } /* ℹ️ Синий - информация */
        /* Стили для формы фильтрации */
    </style>
    @if(session()->has('success'))
        <div class="flash-message" id="flashMessage">
            <span class="check-icon">✔</span> {{ session('success') }}
        </div>
    @endif
    <form action="{{ route('admin.scud.cart') }}" method="GET" class="d-flex mb-3">
        <div class="input-group" style="max-width: 250px;">
            <input type="text" name="search" placeholder="Поиск заказа по номеру" class="form-control form-control-sm" value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary btn-sm">
                <i class="fas fa-search"></i> <!-- Иконка поиска -->
            </button>
        </div>
    </form>

    <form method="GET" action="{{ route('admin.scud.cart') }}" class="mb-4">
        <div class="row g-3">
            <!-- Все фильтры в одну строку -->
            <div class="col-12 d-flex flex-wrap gap-3">
                <select name="user_id" class="form-select w-auto">
                    <option value="">Пользователь</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>

                <select name="delivery_method" class="form-select w-auto">
                    <option value="">Способ доставки</option>
                    <option value="pickup" {{ request('delivery_method') == 'pickup' ? 'selected' : '' }}>Самовывоз</option>
                    <option value="currier" {{ request('delivery_method') == 'currier' ? 'selected' : '' }}>Доставка курьером</option>
                </select>

                <select name="payment_method" class="form-select w-auto">
                    <option value="">Оплата</option>
                    <option value="cash" {{ request('payment_method') == 'cash' ? 'selected' : '' }}>Наличные</option>
                    <option value="card" {{ request('payment_method') == 'card' ? 'selected' : '' }}>Карта</option>
                </select>

                <select name="paymentstatus" class="form-select w-auto">
                    <option value="">Статус оплаты</option>
                    <option value="success" {{ request('paymentstatus') == 'success' ? 'selected' : '' }}>Оплачено</option>
                    <option value="nosuccess" {{ request('paymentstatus') == 'nosuccess' ? 'selected' : '' }}>Не оплачено</option>
                </select>

                <select name="completed_status" class="form-select w-auto">
                    <option value="">Выполнение</option>
                    @foreach ($completed as $status)
                        <option value="{{ $status->СтатусВыполнения }}" {{ request('completed_status') == $status->СтатусВыполнения ? 'selected' : '' }}>
                            {{ $status->СтатусВыполнения }}
                        </option>
                    @endforeach
                </select>

                <select name="action_status" class="form-select w-auto">
                    <option value="">Статус заявки</option>
                    @foreach ($action as $act)
                        <option value="{{ $act->name_action }}" {{ request('action_status') == $act->name_action ? 'selected' : '' }}>
                            {{ $act->name_action }}
                        </option>
                    @endforeach
                </select>

                <input type="date" name="date_from" class="form-control w-auto" value="{{ request('date_from') }}">
                <input type="date" name="date_to" class="form-control w-auto" value="{{ request('date_to') }}">
            </div>

            <!-- Кнопки -->
            <div class="col-12 mt-3">
                <button type="submit" class="btn btn-primary">Применить фильтры</button>
                <a href="{{ route('admin.scud.cart') }}" class="btn btn-warning">Сбросить фильтры</a>
            </div>
        </div>
    </form>


    @if (!empty($filters))
        @php
            $filterNames = [
                'user_id' => \App\Models\User::find(request('user_id'))->name ?? 'Не найден',
                'delivery_method' => 'Способ доставки',
                'payment_method' => 'Способ оплаты',
                'paymentstatus' => 'Статус оплаты',
                'completed_status' => 'Статус выполнения',
                'action_status' => 'Статус заявки',
                'date_from' => 'Дата от',
                'date_to' => 'Дата до',
            ];
        @endphp

        <div class="alert alert-info d-flex align-items-center flex-wrap gap-2">
            <strong>Применённые фильтры:</strong>
            @foreach ($filters as $key => $value)
                <span class="badge bg-primary p-2">
                    {{ $filterNames[$key] ?? ucfirst(str_replace('_', ' ', $key)) }}: <strong>{{ $value }}</strong>
                    <a href="{{ request()->fullUrlWithoutQuery([$key]) }}" class="text-white ms-2">✖</a>
                </span>
            @endforeach
            <a href="{{ route('admin.scud.cart') }}" class="btn btn-warning ms-3">Сбросить все</a>
        </div>
    @endif

    <button id="toggle-selection" class="btn btn-secondary">Удалить на выбор</button>
    <button id="delete-selected" class="btn btn-danger" style="display: none;">Удалить выбранные</button>
    <h5>Количество заказов: {{ $carts->count() }}</h5>
    <table class="table">
        <thead>
            <tr>
                <th>sd</th>
                <th>
                    <a href="{{ route('admin.scud.cart', ['sort' => 'id', 'order' => request('order') === 'asc' ? 'desc' : 'asc']) }}">
                        Заказ № {!! request('sort') === 'id' ? (request('order') === 'asc' ? '🔼' : '🔽') : '' !!}
                    </a>
                </th>
                <th>
                    <a href="{{ route('admin.scud.cart', ['sort' => 'user_id', 'order' => request('order') === 'asc' ? 'desc' : 'asc']) }}">
                        Пользователь {!! request('sort') === 'user_id' ? (request('order') === 'asc' ? '🔼' : '🔽') : '' !!}
                    </a>
                </th>
                <th>
                    <a href="{{ route('admin.scud.cart', ['sort' => 'created_at', 'order' => request('order') === 'asc' ? 'desc' : 'asc']) }}">
                        Дата оформления заказа {!! request('sort') === 'created_at' ? (request('order') === 'asc' ? '🔼' : '🔽') : '' !!}
                    </a>
                </th>
                <th>
                    <a href="{{ route('admin.scud.cart', ['sort' => 'delivery_method', 'order' => request('order') === 'asc' ? 'desc' : 'asc']) }}">
                        Способ доставки {!! request('sort') === 'delivery_method' ? (request('order') === 'asc' ? '🔼' : '🔽') : '' !!}
                    </a>
                </th>
                <th>Адрес доставки</th>
                <th>
                    <a href="{{ route('admin.scud.cart', ['sort' => 'payment_method', 'order' => request('order') === 'asc' ? 'desc' : 'asc']) }}">
                        Способ оплаты {!! request('sort') === 'payment_method' ? (request('order') === 'asc' ? '🔼' : '🔽') : '' !!}
                    </a>
                </th>
                <th>
                    <a href="{{ route('admin.scud.cart', ['sort' => 'paymentstatus', 'order' => request('order') === 'asc' ? 'desc' : 'asc']) }}">
                        Статус оплаты {!! request('sort') === 'paymentstatus' ? (request('order') === 'asc' ? '🔼' : '🔽') : '' !!}
                    </a>
                </th>
                <th>
                    <a href="{{ route('admin.scud.cart', ['sort' => 'complete_id', 'order' => request('order') === 'asc' ? 'desc' : 'asc']) }}">
                        Статус выполнения {!! request('sort') === 'complete_id' ? (request('order') === 'asc' ? '🔼' : '🔽') : '' !!}
                    </a>
                </th>
                <th>
                    <a href="{{ route('admin.scud.cart', ['sort' => 'action_id', 'order' => request('order') === 'asc' ? 'desc' : 'asc']) }}">
                        Статус доставки {!! request('sort') === 'action_id' ? (request('order') === 'asc' ? '🔼' : '🔽') : '' !!}
                    </a>
                </th>
                <th>Действие</th>
            </tr>
        </thead>

        <tbody>
            @if($carts -> isEmpty())
                <p class="text-danger">Нет заказов</p>
            @else    
                @foreach ($carts as $cart)
                    <tr>
                        <td><input type="checkbox" class="order-checkbox" value="{{ $cart->id }}" style="border-radius: 4px;"></td>
                        <td>{{ $cart->id }}</td>
                        <td>{{ $cart->user->name }}</td>
                        <td>{{ $cart->created_at }}</td>
                        <td>{{ in_array($cart->delivery_method, ['pickup', 'standard']) ? 'Самовывоз' : 'Доставка курьером' }}</td>
                        <td>{{ in_array($cart->delivery_method, ['pickup', 'standard']) ? 'г.Гродно, ул. Новооктябрьская 14 (Пункт выдачи)' : ($cart->diliveryaddress ?? $cart->user->address) }}</td>
                        <td>{{ $cart->payment_method === 'cash' ? 'Наличные' : 'Карта' }}</td>
                        <td class="{{ in_array($cart->paymentstatus, ['nosuccess', 'Не оплачено']) ? 'status-danger' : 'status-success' }}">
                            {{ in_array($cart->paymentstatus, ['nosuccess', 'Не оплачено']) ? 'Не оплачено' : 'Оплачено' }} 
                        </td>
                        <td>
                            @if($cart->completed)
                                {{ $cart->completed->СтатусВыполнения}}
                            @else
                                <p>Статус отсутствует</p>    
                            @endif    
                        </td> 
                        <td>
                            @if($cart->action)
                                {{ $cart->action->name_action }}
                            @else    
                                <p>Нет статуса</p>
                            @endif
                        </td>       
                        <td>
                            <a href="{{ route('admin.scud.showcart', $cart->id) }}" class="btn btn-info">Информация о заказе</a>
                            <a href="{{ route('admin.scud.editercart', $cart->id) }}" class="btn btn-warning">Редактировать</a>
                        </td>
                    </tr>
                @endforeach
            @endif    
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
        document.addEventListener("DOMContentLoaded", function () {
            let toggleSelectionBtn = document.getElementById("toggle-selection");
            let deleteSelectedBtn = document.getElementById("delete-selected");
            let checkboxes = document.querySelectorAll(".order-checkbox");

            // Изначально скрываем чекбоксы
            checkboxes.forEach(checkbox => {
                checkbox.style.display = "none";
            });

            toggleSelectionBtn.addEventListener("click", function () {
                let isHidden = checkboxes[0].style.display === "none";
                checkboxes.forEach(checkbox => {
                    checkbox.style.display = isHidden ? "inline-block" : "none";
                });

                deleteSelectedBtn.style.display = isHidden ? "inline-block" : "none";
            });

            deleteSelectedBtn.addEventListener("click", function () {
                let selectedOrders = [];
                checkboxes.forEach(checkbox => {
                    if (checkbox.checked) {
                        selectedOrders.push(checkbox.value);
                    }
                });

                if (selectedOrders.length === 0) {
                    alert("Выберите заказы для удаления!");
                    return;
                }

                if (!confirm("Вы уверены, что хотите удалить выбранные заказы?")) return;

                fetch("{{ route('admin.scud.deleteSelected') }}", {
                    method: "DELETE",
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({ order_ids: selectedOrders })
                })
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                    location.reload();
                })
                .catch(error => console.error("Ошибка удаления:", error));
            });
        });
    </script>
    <script>
        document.getElementById("paymentMethod").addEventListener("change", function () {
            document.getElementById("selectedPaymentMethod").value = this.value;
        });
    </script>
@endsection
