<form action="{{ route('contact.send') }}" method="POST">
    @csrf
    <label for="name">Имя:</label>
    <input type="text" name="name" required>

    <label for="email">Email:</label>
    <input type="email" name="email" required>

    <label for="message">Сообщение:</label>
    <textarea name="message" required></textarea>

    <button type="submit">Отправить</button>
</form>
