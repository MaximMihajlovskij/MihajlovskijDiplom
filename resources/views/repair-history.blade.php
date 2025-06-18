@extends('base')

@section('repair-history')
    <style>
        .img-fluid {
            width: 100%; /* Растянет изображение на всю ширину модального окна */
            max-height: 90vh; /* Ограничит высоту окна */
            object-fit: contain; /* Сохранит пропорции изображения */
            width: 100% !important;
        }
    </style>

    <div class="cart-area section-space">
        <div class="container">
            <h2 class="text-center">История заявок</h2>
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
                                            <img src="{{ asset('storage/' . $request->image) }}" width="80" class="img-thumbnail" data-bs-toggle="modal" data-bs-target="#imageModal{{ $request->id }}">
                                            
                                            <!-- Модальное окно -->
                                            <div class="modal fade" id="imageModal{{ $request->id }}" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-xl">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Просмотр изображения</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body text-center">
                                                            <img src="{{ asset('storage/' . $request->image) }}" class="img-fluid">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
