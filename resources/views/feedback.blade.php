@extends('base')

@section('feedback')
    <style>


        .repair-form {
            max-width: 450px;
            padding: 25px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            text-align: center; /* Центрирование содержимого */
            animation: fadeIn 0.8s ease-in-out; /* Плавное появление */
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.9); }
            to { opacity: 1; transform: scale(1); }
        }

        .form-title {
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }

        .repair-form label {
            font-weight: bold;
            margin-top: 12px;
            display: block;
            text-align: left;
        }

        .repair-form .form-control {
            width: 100%;
            padding: 12px;
            border: 2px solid #007bff;
            border-radius: 6px;
            font-size: 16px;
            transition: 0.3s;
        }

        .repair-form .form-control:focus {
            border-color:rgb(255, 255, 255);
            box-shadow: 0 0 8px rgba(255, 255, 255, 0.5);
        }

        .btn-submit {
            width: 100%;
            padding: 12px;
            margin-top: 20px;
            background: #007bff;
            color: white;
            font-size: 18px;
            font-weight: bold;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-submit:hover {
            background: #ff416c;
        }

        .btn-back {
            display: block;
            width: 100%;
            padding: 12px;
            margin-top: 12px;
            background: #6c757d;
            color: white;
            font-size: 18px;
            font-weight: bold;
            text-align: center;
            border-radius: 6px;
            text-decoration: none;
            transition: 0.3s;
        }

        .btn-back:hover {
            background: #5a6268;
        }

        .btn-history {
            position: absolute;
            top: 80px; /* Отступ ниже шапки */
            right: 20px;
            width: 50px;
            height: 50px;
            background: #007bff;
            color: white;
            font-size: 20px;
            font-weight: bold;
            border: none;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: 0.3s;
            z-index: 1000; /* Поверх остальных элементов */
        }

        .btn-history i {
            font-size: 22px;
        }

        .btn-history:hover {
            background: #0056b3;
        }
    </style>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif  

    @if(session()->has('success'))
        <div class="flash-message" id="flashMessage">
            <span class="check-icon">✔</span> {{ session('success') }}
        </div>
    @endif    
    <div class="container">
        <div class="text-center" style="display: flex; justify-content: center; margin-top: 50px; margin-bottom: 75px;">
            <form action="{{ route('feedback') }}" method="POST" class="repair-form" enctype="multipart/form-data">
                @csrf
                <h2 class="form-title">Оставить заявку на ремонт</h2>

                <label>Название оборудования</label>
                <input type="text" name="name_camera" class="form-control" placeholder="Введите название оборудования">

                <label>Телефон</label>
                <input type="tel" name="telephon" class="form-control" placeholder="Введите телефон" value="{{ old('telephon', Auth::user()->telephon) }}">
                
                <label>Email</label>
                <input type="email" name="email" class="form-control" placeholder="Введите email" value="{{ old('email', Auth::user()->email) }}">

                <label>Выберите срочность</label>
                <select name="status_id" class="form-select" required>
                    <option value="" disabled selected>Статус срочности</option>
                    @foreach($statuses as $status)
                        <option value="{{ $status->id }}">{{ $status->СтатусСрочности }}</option>
                    @endforeach
                </select>

                <label>Описание проблемы</label>
                <textarea name="ProblemDescription" class="form-control" rows="4" placeholder="Опишите проблему" required></textarea>

                <label>Прикрепите изображение (необязательно)</label>
                <input type="file" name="image" class="form-control">

                <button type="submit" class="btn-submit">Отправить заявку</button>
                <a href="{{ route('index') }}" class="btn-back">Вернуться на главную</a>
            </form>
        </div>
    </div>

    <button type="button" class="btn-history" data-bs-toggle="modal" data-bs-target="#repairHistoryModal">
        <i class="fas fa-history"></i>
    </button>

    <!-- Модальное окно истории заявок -->
    <div class="modal fade" id="repairHistoryModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">История заявок</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="table-content table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="product-thumbnail">Оборудование</th>
                                            <th class="cart-product-name">Дата создания</th>
                                            <th class="product-price">Описание проблемы</th>
                                            <th class="product-remove">Изображение</th>
                                            <th class="product-price">Статус</th>
                                            <th class="product-price">Статус выполнения</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($requests as $request)
                                        <tr>
                                            <td class="product-name">{{ $request->name_camera }}</td>
                                            <td class="product-thumbnail">{{ $request->DateCreateRepair }}</td>
                                            <td class="product-thumbnail">{{ $request->ProblemDescription }}</td>
                                            <td class="product-thumbnail"> 
                                                @if($request->image)
                                                    <img src="{{ asset('storage/' . $request->image) }}" width="80" class="img-thumbnail" 
                                                        onclick="showEnlargedImage('{{ asset('storage/' . $request->image) }}')">
                                                         <!-- Модальное окно для увеличенного изображения -->
                                                    <div class="modal fade" id="enlargedImageModal" tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-xl">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" id="closeEnlargedImage"></button>
                                                                </div>
                                                                <div class="modal-body text-center">
                                                                    <img id="enlargedImage" src="" class="img-fluid">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    Нет изображения
                                                @endif     
                                            </td>
                                            <td class="status">
                                                {{ $request->status->СтатусСрочности }}
                                            </td>
                                            <td>{{ $request->complete->СтатусВыполнения }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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
        function showEnlargedImage(imageUrl) {
            // Устанавливаем изображение в модальном окне
            document.getElementById('enlargedImage').src = imageUrl;

            // Показываем модальное окно увеличенного изображения
            var enlargedImageModal = new bootstrap.Modal(document.getElementById('enlargedImageModal'));
            enlargedImageModal.show();

            // Закрытие увеличенного изображения и возврат к истории заявок
            document.getElementById('closeEnlargedImage').addEventListener('click', function () {
                var repairHistoryModal = new bootstrap.Modal(document.getElementById('repairHistoryModal'));
                setTimeout(() => {
                    repairHistoryModal.show(); // Показываем обратно историю заявок
                }, 300);
            });
        }
    </script>
@endsection    