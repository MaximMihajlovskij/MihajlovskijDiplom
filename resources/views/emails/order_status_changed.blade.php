<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <title>Статус заказа изменился</title>
    </head>
    <body>
        <style>
            /* ✅ Общий стиль */
            body {
                font-family: Arial, sans-serif;
                background-color: #f8f9fa;
                padding: 20px;
                color: #333;
            }

            .container {
                max-width: 600px;
                background: white;
                padding: 20px;
                border-radius: 10px;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            }

            /* ✅ Заголовок */
            .header {
                background: #007bff;
                color: white;
                padding: 15px;
                border-radius: 8px 8px 0 0;
                text-align: center;
                font-size: 20px;
                font-weight: bold;
            }

            /* ✅ Блоки статусов */
            .status {
                padding: 15px;
                border-radius: 8px;
                text-align: center;
                font-weight: bold;
                margin-bottom: 10px;
            }

            /* ✅ Цвета статусов */
            .success {
                background: #28a745;
                color: white;
            }
            .warning {
                background: #ffc107;
                color: black;
            }
            .error {
                background: #dc3545;
                color: white;
            }

            /* ✅ Общий текст */
            p {
                font-size: 16px;
                margin: 10px 0;
            }

            /* ✅ Подвал письма */
            .footer {
                text-align: center;
                color: #6c757d;
                margin-top: 20px;
                font-size: 14px;
            }
        </style>
        <div class="container">
            <div class="header">
                📦 Обновление статуса заказа №{{$cart->id}}
            </div>
            <p>Здравствуйте, <strong>{{$cart->user->name}}</strong>!</p>
            <p>Ваш заказ был обновлён:</p>

            <div class="status {{ $cart->completed->СтатусВыполнения == 'Заказ готов' ? 'success' : ($cart->completed->СтатусВыполнения == 'В процессе' ? 'warning' : 'error') }}">
                🔄 Статус выполнения: <strong>{{ $cart->completed->СтатусВыполнения ?? 'Неизвестно' }}</strong>
            </div>

            <div class="status {{ $cart->action->name_action == 'Доставлен' ? 'success' : ($cart->action->name_action == 'В пути' ? 'warning' : 'error') }}">
                🚚 Статус доставки: <strong>{{ $cart->action->name_action ?? 'Неизвестно' }}</strong>
            </div>

            <p>Вы можете проверить детали заказа в личном кабинете.</p>

            <div class="footer">
                <p>С уважением, <br> Команда DiploMax</p>
            </div>
        </div>
    </body>
</html>
