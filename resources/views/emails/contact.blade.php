<!DOCTYPE html>
<html>
<head>
    <title>Обратная связь</title>
</head>
<body>
    <p><strong>Имя:</strong> {{ $data['name'] }}</p>
    <p><strong>Email:</strong> {{ $data['email'] }}</p>
    <p><strong>Сообщение:</strong> {{ $data['message'] }}</p>

    <a href="mailto:{{ $data['email'] }}" class="btn btn-primary">Ответить</a>
</body>
</html>
