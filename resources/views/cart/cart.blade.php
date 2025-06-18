@extends('base')

@section('title', 'Корзина')

@section('content')
    <style>
        /* ✅ Общий стиль модальных окон */
        .modal-content {
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }

        /* ✅ Список заказов */
        .list-group-item {
            background: white;
            border: 1px solid #dee2e6;
            padding: 18px;
            border-radius: 10px;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: 0.3s ease-in-out;
        }

        /* ✅ Эффект наведения */
        .list-group-item:hover {
            background: #eef1f6;
            transform: translateY(-2px);
        }

        /* ✅ Название заказа */
        .list-group-item strong.text-primary {
            font-size: 20px;
        }

        /* ✅ Дата заказа */
        .list-group-item p.text-muted {
            font-size: 16px;
            margin-top: 3px;
        }

        /* ✅ Цена заказа */
        .list-group-item span.text-danger {
            font-size: 18px;
            font-weight: bold;
        }

        /* ✅ Кнопка "Посмотреть заказ" */
        .list-group-item .btn-outline-primary {
            font-size: 14px;
            padding: 8px 12px;
        }
    </style>

    
        <!-- Breadcrumb area start  -->
        <div class="breadcrumb__area theme-bg-1 p-relative z-index-11 pt-95 pb-95" style="padding-top: 95px; padding-bottom: 95px; object-fit: cover;">
        <div class="breadcrumb__thumb" data-background="public/storage/banners/edit the image to remove the word _Корзина_ and resize it to 1107 x 113.8.png"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-12">
                    <div class="breadcrumb__wrapper text-center">
                    <h2 class="breadcrumb__title">Корзина</h2>
                    <div class="breadcrumb__menu">
                        <nav>
                            <ul>
                                <li><span>@include('includes.breadcrumbs')</span></li>
                            </ul>
                        </nav>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <!-- Breadcrumb area start  -->
        
        <!-- Cart area start  -->
        <div class="cart-area section-space">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @if(session()->has('success'))
                        <div class="table-content table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="product-thumbnail">Изображение</th>
                                        <th class="cart-product-name">Оборудование</th>
                                        <th class="product-price">Цена</th>
                                        <th class="product-quantity">Количество</th>
                                        <th class="product-subtotal">Стоимость</th>
                                        <th class="product-remove">Удалить</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(session()->has('cart'))
                                        @foreach(session('cart') as $item)
                                            <tr>
                                                <td class="product-thumbnail">
                                                    <a href="">
                                                        <img src="{{ asset('storage/' . $item['image_url']) }}" alt="">
                                                    </a>
                                                </td>
                                                <td class="product-name">{{ $item['name'] }}</td>
                                                <td class="product-price"><span class="amount">{{ $item['price'] }} BYN</span></td>
                                                <td class="product-quantity text-center">
                                                    {{ $item['quantity'] }}
                                                </td>
                                                <td class="product-subtotal"><span class="amount">{{ $item['price'] * $item['quantity'] }} BYN</span></td>
                                                <td class="product-remove">
                                                    <form action="{{ route('cart.cart.removeOne') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $item['id'] }}">
                                                        <input type="hidden" name="type" value="{{ $item['type'] }}">
                                                        <button type="submit"><i class="fa fa-times"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif        
                                </tbody>
                            </table>  
                        </div>
                    @else
                    <div class="text-center">
                        <img src="{{ asset('storage/banners/png-transparent-empty-cart-illustration-thumbnail.png') }}" alt="Упс... Кажется ваша корзина пуста!">
                        <h4 class="text-black">Упс... Кажется ваша корзина пуста!</h4>  
                    </div>
    
                    @endif    
                    <div class="row">
                     <div class="col-12">
                        <div class="coupon-all">
                           <div class="coupon d-flex align-items-center">
                              <button data-bs-toggle="modal" data-bs-target="#orderHistoryModal" class="fill-btn" type="button">
                                 <span class="fill-btn-inner">
                                    <span class="fill-btn-normal">История заказов</span>
                                    <span class="fill-btn-hover">История заказов</span>
                                 </span>
                              </button>
                           </div>
                           @if(session()->has('success'))
                                <div class="coupon2">
                                        <form action="{{ route('cart.cart.clear') }}" method="POST">
                                            @csrf
                                            <button onclick="window.location.reload()" class="fill-btn" type="submit">
                                                <span class="fill-btn-inner">
                                                    <span class="fill-btn-normal">Очистить корзину</span>
                                                    <span class="fill-btn-hover">Очистить корзину</span>
                                                </span>
                                            </button>
                                        </form>
                                </div>
                            @endif    
                        </div>
                     </div>
                  </div>
                    <div class="row">
                        <div class="col-lg-6 mr-auto">
                            <div class="cart-page-total">
                                <h2>Cart totals</h2>
                                <p>* При заказе от 2000 BYN доставка бесплатная</p>
                                @php
                                    $totalPrice = collect(session('cart'))->sum(fn($item) => $item['price'] * $item['quantity']);
                                    $deliveryPrice = $totalPrice < 2000 ? round($totalPrice * 0.15, 2) : 0; // ✅ 15% от суммы товаров, если меньше 2000
                                    $finalPrice = $totalPrice + $deliveryPrice; // ✅ Итоговая сумма заказа
                                @endphp
                                <ul class="mb-20">
                                    <li>Стоимость товаров: <span>{{ $totalPrice }} BYN</span></li>
                                    <li>Доставка: <span>{{ $deliveryPrice > 0 ? $deliveryPrice : '0' }} BYN</span></li>
                                    <li>Итого: <span>{{ $finalPrice }} BYN</span></li>
                                </ul>
                                <button type="button" class="fill-btn mt-3" data-bs-toggle="modal" data-bs-target="#paymentModal">
                                    <span class="fill-btn-inner">
                                    <span class="fill-btn-normal">Оформить заказ</span>
                                    <span class="fill-btn-hover">Оформить заказ</span>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <!-- Cart area end  -->

    
        <!-- 🛒 Модальное окно выбора способа оплаты -->
        <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content shadow-lg rounded">
                    <div class="modal-header bg-dark text-white">
                        <h5 class="modal-title fw-bold" id="paymentModalLabel">Выберите способ оплаты</h5>
                        <button type="button" class="btn-close text-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body bg-light p-4">
                        
                        <!-- 🔹 Способ оплаты -->
                        <label class="fw-bold">Способ оплаты:</label>
                        <select id="paymentMethod" class="form-control">
                            <option value="cash">💵 Оплата наличными</option>
                            <option value="card">💳 Оплата по карте</option>
                        </select>

                        <!-- 🔹 Форма оплаты картой -->
                        <div id="cardPaymentForm" class="mt-3" style="display: none;">
                            <label class="fw-bold">Номер карты:</label>
                            <input type="text" class="form-control" id="cardNumber" name="cardNumber"
                                placeholder="0000 0000 0000 0000" maxlength="19" required 
                                pattern="\d{4} \d{4} \d{4} \d{4}" title="Введите 16 цифр, разделённых пробелами">
                            <span class="error-message text-danger" id="cardNumberError"></span>

                            <div class="d-flex gap-2 mt-3">
                                <div>
                                    <label class="fw-bold">Срок действия:</label>
                                    <input type="text" class="form-control" id="cardExpiry" name="cardExpiry"
                                        placeholder="MM/YY" maxlength="5" required pattern="\d{2}/\d{2}" title="Введите срок в формате MM/YY">
                                    <span class="error-message text-danger" id="cardExpiryError"></span>
                                </div>
                                <div>
                                    <label class="fw-bold">CVV-код:</label>
                                    <input type="text" class="form-control" id="cardCVV" name="cardCVV"
                                        placeholder="123" maxlength="3" required pattern="\d{3}" title="Введите 3 цифры CVV">
                                    <span class="error-message text-danger" id="cardCVVError"></span>
                                </div>
                            </div>

                            <p class="text-muted mt-3">✅ Поддерживаются карты: Visa, MasterCard, Белкарт</p>
                        </div>

                        <hr>

                        <!-- 🔹 Способ доставки -->
                        <label class="fw-bold">Способ доставки:</label>
                        <select id="deliveryMethod" class="form-control">
                            <option value="pickup">🚶 Самовывоз</option>
                            <option value="courier">🚚 Доставка курьером</option>
                        </select>

                        <!-- 🔹 Адрес доставки -->
                        <div id="deliveryAddressForm" class="mt-3" style="display: none;">
                            <label class="fw-bold">Адрес доставки:</label>
                            <input type="text" class="form-control" id="userAddress" name="diliveryaddress" value="{{ Auth::user()->address ?? '' }}">
                            <p class="text-muted mt-2">✏ Вы можете изменить адрес доставки</p>
                        </div>

                        <!-- 🔹 Фиксированный адрес самовывоза -->
                        <div id="pickupLocation" class="mt-3" style="display: none;">
                            <p class="fw-bold mb-1">📍 Адрес самовывоза:</p>
                            <p class="text-muted">г.Гродно, ул. Новооктябрьская 14 (Пункт выдачи)</p>
                        </div>

                    </div>

                    <form id="orderForm" action="{{ route('cart.order.store') }}" method="POST" class="modal-footer">
                        @csrf
                        <input type="hidden" name="payment_method" id="selectedPaymentMethod">
                        <input type="hidden" name="delivery_method" id="selectedDeliveryMethod">
                        <input type="hidden" name="diliveryaddress" id="finalUserAddress">
                        <input type="hidden" name="paymentstatus" id="selectedpaymentstatus">
                        <button type="submit" class="btn btn-success fw-bold px-4 py-2">Оформить заказ</button>
                    </form>
                </div>
            </div>
        </div>

    <!-- 🔹 Модальное окно: Общая история заказов -->
    <div class="modal fade" id="orderHistoryModal" data-bs-backdrop="true" data-bs-keyboard="true" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content shadow-lg rounded">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title fw-bold">🛒 История заказов</h5>
                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body bg-light p-4">
                    <div class="list-group">
                        @forelse($requests as $cart)
                            <div class="list-group-item d-flex justify-content-between align-items-center shadow-sm rounded p-3">
                                <div>
                                    <strong class="text-primary">Заказ №{{ $cart->id }}</strong>
                                    <p class="text-muted mb-0">📅 {{ $cart->created_at->format('d.m.Y') }}</p>
                                </div>
                                <div class="fw-bold text-end">
                                    <span class="text-danger">💰 
                                        {{ $cart->items->sum(fn($item) => ($item->camera ? $item->camera->price * $item->quantity : 0) + 
                                                                ($item->turniket ? $item->turniket->price * $item->quantity : 0) + 
                                                                ($item->barrier ? $item->barrier->price * $item->quantity : 0)) }} BYN
                                    </span>
                                </div>
                                <button class="btn btn-outline-primary btn-sm open-order-details" data-order-id="{{ $cart->id }}">
                                    🔎 Посмотреть заказ
                                </button>
                            </div>
                        @empty
                            <p class="text-center text-muted">История заказов пуста</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 🔹 Динамическое модальное окно для деталей заказа -->
    <div class="modal fade" id="orderDetailsModal" tabindex="-1" aria-labelledby="orderDetailsLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content shadow-lg rounded">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title fw-bold" id="orderDetailsLabel">🔎 Детали заказа</h5>
                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body bg-light p-4" id="orderDetailsContent">
                    <p class="text-center text-muted">Выберите заказ для просмотра.</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".open-order-details").forEach(button => {
                button.addEventListener("click", function() {
                    let orderId = this.getAttribute("data-order-id");
                    let orderDetailsModal = new bootstrap.Modal(document.getElementById("orderDetailsModal"));
                    let orderHistoryModalElement = document.getElementById("orderHistoryModal");
                    let orderHistoryModal = bootstrap.Modal.getInstance(orderHistoryModalElement);

                    // Закрываем историю заказов перед открытием деталей заказа
                    if (orderHistoryModal) {
                        orderHistoryModal.hide();
                    }

                    fetch(`/order-details/${orderId}`)
                        .then(response => response.text())
                        .then(data => {
                            document.getElementById("orderDetailsContent").innerHTML = data;
                            orderDetailsModal.show();
                        })
                        .catch(error => console.error('Ошибка загрузки данных:', error));
                });
            });

            // Возвращаем историю заказов при закрытии деталей заказа
            document.getElementById("orderDetailsModal").addEventListener("hidden.bs.modal", function() {
                let orderHistoryModalElement = document.getElementById("orderHistoryModal");

                // Удаляем старый экземпляр и создаём новый, чтобы можно было закрыть окно
                let orderHistoryModal = bootstrap.Modal.getInstance(orderHistoryModalElement);
                if (orderHistoryModal) {
                    orderHistoryModal.dispose(); // Удаляем экземпляр
                }

                // Создаём новое активное модальное окно истории заказов
                new bootstrap.Modal(orderHistoryModalElement).show();
            });

            // Закрытие модального окна истории при клике вне его
            document.getElementById("orderHistoryModal").addEventListener("click", function(event) {
                if (event.target === this) {
                    let orderHistoryModal = bootstrap.Modal.getInstance(this);
                    if (orderHistoryModal) {
                        orderHistoryModal.hide();
                    }
                }
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let paymentMethod = document.getElementById("paymentMethod");
            let cardPaymentForm = document.getElementById("cardPaymentForm");
            let confirmOrderButton = document.getElementById("confirmOrder");

            // Показываем/скрываем форму оплаты картой в зависимости от выбора
            paymentMethod.addEventListener("change", function () {
                cardPaymentForm.style.display = paymentMethod.value === "card" ? "block" : "none";
            });

            // Обработка кнопки "Заказать"
            confirmOrderButton.addEventListener("click", function () {
                let selectedPayment = paymentMethod.value;

                if (selectedPayment === "cash") {
                    // 🔹 Если оплата наличными — сразу оформляем заказ
                    document.getElementById("orderForm").submit();
                } else if (selectedPayment === "card") {
                    // 🔹 Если оплата картой, проверяем заполненность полей
                    let cardNumber = document.querySelector("#cardPaymentForm input:nth-child(2)").value;
                    let expiryDate = document.querySelector("#cardPaymentForm input:nth-child(4)").value;
                    let cvvCode = document.querySelector("#cardPaymentForm input:nth-child(6)").value;

                    if (cardNumber.length === 19 && expiryDate.length === 5 && cvvCode.length === 3) {
                        // Если все данные введены — оформляем заказ
                        document.getElementById("orderForm").submit();
                    } else {
                        alert("Ошибка! Заполните все данные карты.");
                    }
                }
            });
        });
    </script>
    <script>
        document.getElementById("paymentMethod").addEventListener("change", function () {
            document.getElementById("selectedPaymentMethod").value = this.value;
        });

        document.getElementById("deliveryMethod").addEventListener("change", function () {
            document.getElementById("selectedDeliveryMethod").value = this.value;

            if (this.value === "courier") {
                document.getElementById("deliveryAddressForm").style.display = "block";
                document.getElementById("pickupLocation").style.display = "none";
            } else {
                document.getElementById("deliveryAddressForm").style.display = "none";
                document.getElementById("pickupLocation").style.display = "block";
            }
        });

        document.getElementById("orderForm").addEventListener("submit", function (event) {
            event.preventDefault(); // ✅ Останавливаем отправку формы

            // ✅ Берём актуальный адрес из поля
            document.getElementById("finalUserAddress").value = 
                document.getElementById("deliveryMethod").value === "courier" 
                ? document.getElementById("userAddress").value 
                : "г.Гродно, ул. Новооктябрьская 14 (Пункт выдачи)"; // ✅ Фиксированный адрес самовывоза

            this.submit(); // ✅ Теперь отправляем форму с правильными данными
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let cardNumberInput = document.getElementById("cardNumber");
            let expiryInput = document.getElementById("cardExpiry");
            let cvvInput = document.getElementById("cardCVV");
            let submitButton = document.getElementById("confirmOrder");

            // ✅ Автоформатирование номера карты (добавление пробелов)
            cardNumberInput.addEventListener("input", function (event) {
                let value = this.value.replace(/\D/g, "").substring(0, 16);
                let formattedValue = value.replace(/(.{4})/g, "$1 ").trim();
                this.value = formattedValue;
            });

            // ✅ Валидация формы перед заказом
            function validateCardForm() {
                if (
                    cardNumberInput.value.length < 19 || // ✅ Проверка номера карты
                    expiryInput.value.length < 5 || // ✅ Проверка срока действия
                    cvvInput.value.length < 3 // ✅ Проверка CVV
                ) {
                    alert("⚠ Заполните все поля корректно!");
                    return false;
                }
                return true;
            }

            // ✅ Проверка перед отправкой заказа
            submitButton.addEventListener("click", function (event) {
                if (document.getElementById("paymentMethod").value === "card" && !validateCardForm()) {
                    event.preventDefault(); // ❌ Останавливаем отправку формы
                }
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let cardNumberInput = document.getElementById("cardNumber");
            let expiryInput = document.getElementById("cardExpiry");
            let cvvInput = document.getElementById("cardCVV");
            let submitButton = document.getElementById("orderForm");

            function showError(input, message, errorId) {
                document.getElementById(errorId).innerText = message;
                input.classList.add("is-invalid"); // ✅ Подсветка красным
            }

            function clearError(input, errorId) {
                document.getElementById(errorId).innerText = "";
                input.classList.remove("is-invalid");
            }

            function validateCardForm() {
                let isValid = true;

                // ✅ Проверка номера карты
                if (cardNumberInput.value.length !== 19) {
                    showError(cardNumberInput, "⚠ Номер карты должен содержать 16 цифр.", "cardNumberError");
                    isValid = false;
                } else {
                    clearError(cardNumberInput, "cardNumberError");
                }

                // ✅ Проверка срока действия
                if (!expiryInput.value.match(/^\d{2}\/\d{2}$/)) {
                    showError(expiryInput, "⚠ Неверный формат срока действия (MM/YY).", "cardExpiryError");
                    isValid = false;
                } else {
                    clearError(expiryInput, "cardExpiryError");
                }

                // ✅ Проверка CVV-кода
                if (!cvvInput.value.match(/^\d{3}$/)) {
                    showError(cvvInput, "⚠ CVV-код должен содержать 3 цифры.", "cardCVVError");
                    isValid = false;
                } else {
                    clearError(cvvInput, "cardCVVError");
                }

                return isValid;
            }

            // ✅ Автоформатирование номера карты
            cardNumberInput.addEventListener("input", function () {
                let value = this.value.replace(/\D/g, "").substring(0, 16);
                let formattedValue = value.replace(/(.{4})/g, "$1 ").trim();
                this.value = formattedValue;
            });

            // ✅ Проверка перед отправкой заказа
            submitButton.addEventListener("click", function (event) {
                if (document.getElementById("paymentMethod").value === "card" && !validateCardForm()) {
                    event.preventDefault(); // ❌ Останавливаем отправку формы
                }
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
