<html>
<head>
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid black; padding: 5px; text-align: left; }
    </style>
</head>
<body>
    <h1>Заявки на ремонт камер</h1>
    <table>
        <tr>
            <th>Клиент</th>
            <th>Устройство</th>
            <th>Описание проблемы</th>
            <th>Дата заявки</th>
        </tr>
        @foreach($data as $request)
            <tr>
                <td>{{ $request->customer_name }}</td>
                <td>{{ $request->device }}</td>
                <td>{{ $request->issue_description }}</td>
                <td>{{ $request->request_date }}</td>
            </tr>
        @endforeach
    </table>
</body>
</html>
