<style>
    /* ✅ Общий стиль списка */
    .list-group {
        padding: 20px;
        background: #ffffff; /* Чистый белый фон */
        border-radius: 12px;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1); /* Глубокая элегантная тень */
    }

    /* ✅ Позиции в заказе */
    .list-group-item {
        background: #f9f9f9; /* Лёгкий фон для контраста */
        border: none; /* Убираем границы */
        padding: 18px;
        border-radius: 10px; /* Скругленные края */
        margin-bottom: 12px; /* Добавляем простор */
        display: flex;
        align-items: center;
        justify-content: space-between;
        transition: 0.3s ease-in-out;
    }

    /* ✅ Эффект наведения */
    .list-group-item:hover {
        background: #eef1f6; /* Нежный подсвет */
        transform: translateY(-2px); /* Лёгкое поднятие */
    }

    /* ✅ Название камеры */
    .list-group-item span:first-child {
        font-size: 20px;
        font-weight: bold;
        color: #0056b3; /* Глубокий синий */
    }

    /* ✅ Цена и количество */
    .list-group-item span:last-child {
        font-size: 18px;
        font-weight: bold;
        color: #28a745; /* Зеленый цвет */
    }

    /* ✅ Разделитель */
    .border-top {
        border-top: 2px solid #ccc;
        padding-top: 20px;
        margin-top: 20px;
    }

    /* ✅ Общая стоимость заказа */
    .text-end strong {
        font-size: 22px;
        font-weight: bold;
        color: #dc3545; /* Красный акцент */
    }

    .priceng{
        display: flex;
        justify-content: flex-end;
    }
</style>

<!-- Cart area start  -->
<div class="cart-area section-space" style="padding-top: 0px;">
    <div class="container">
        <div class="row">
        <div class="col-12">
            <div class="table-content table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th class="product-thumbnail">Изображение</th>
                        <th class="cart-product-name">Оборудование</th>
                        <th class="cart-product-name">Количество</th>
                        <th class="product-price">Цена</th>
                        <th class="product-remove">Стоимость</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($cart->items as $item)
                            <tr>
                                <td class="product-thumbnail">
                                    <a href="{{ route('video.descriptioncamera', $item->camera->id ?? $item->turniket->id ?? $item->barrier->id ?? $item->accessorie->id) }}">
                                        <img src="{{ asset('storage/' . ($item->camera->image ?? $item->turniket->image ?? $item->barrier->image ?? $item->accessorie->image)) }}" alt="">
                                    </a>
                                </td>
                                <td class="product-name">
                                    {{ $item->camera->name_camera ?? $item->turniket->name_turniket ?? $item->barrier->name_barrier ?? $item->accessorie->name ?? 'Неизвестное оборудование' }}
                                </td>
                                <td class="product-price"><span class="amount">{{ $item->quantity }} шт.</span></td>
                                <td class="product-remove">
                                    {{ ($item->camera->price ?? $item->turniket->price ?? $item->barrier->price ?? $item->accessorie->price) ?? '0' }} BYN за шт.
                                </td>
                                <td class="product-remove">
                                    <strong>{{ (($item->camera->price ?? $item->turniket->price ?? $item->barrier->price ?? $item->accessorie->price) ?? 0) * $item->quantity }} BYN</strong>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        </div>
    </div>
</div>
<!-- Cart area end  -->
<div class="text-end mt-3 border-top pt-3">
    <div class="priceng">
        <h4 class="text-dark" style="margin-right: 15px;">Общая стоимость заказа:</h4>
        <h3 class="total">
            {{ $cart->items->sum(fn($item) => ($item->camera ? $item->camera->price * $item->quantity : 0) + 
                                            ($item->turniket ? $item->turniket->price * $item->quantity : 0) + 
                                            ($item->barrier ? $item->barrier->price * $item->quantity : 0)) }} BYN
        </h3>
    </div>
    <div class="d-flex justify-content-end gap-3 align-items-center mt-2">
        <div class="badge px-3 py-2 
            {{ isset($cart->completed) && $cart->completed->СтатусВыполнения == 'Заказ готов' ? 'bg-success' : 
            (isset($cart->completed) && $cart->completed->СтатусВыполнения == 'В процессе' ? 'bg-warning' : 'bg-danger') }}">
            🔄 Статус: {{ $cart->completed->СтатусВыполнения ?? 'Неизвестно' }}
        </div>
        <div class="badge px-3 py-2 
            {{ isset($cart->action) && $cart->action->name_action == 'Доставлен' ? 'bg-success' : 
            (isset($cart->action) && $cart->action->name_action == 'В пути' ? 'bg-warning' : 'bg-danger') }}">
            🚚 Доставка: {{ $cart->action->name_action ?? 'Неизвестно' }}
        </div>
    </div>
</div>
