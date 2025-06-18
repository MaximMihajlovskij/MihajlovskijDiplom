@extends('admin')

@section('title', 'Информация о корзине')

@section('cart_show')
    <h1>Заказ №{{ $cart->id }} -> {{ $cart->user->name }}</h1>

    @if($cart->items->isEmpty())
        <p class="text-danger">Заказ пуст.</p>
    @else    
        <table class="table">
            <thead>
                <tr>
                    <th>Изображение</th>
                    <th>Название</th>
                    <th>Количество</th>
                    <th>Цена</th>
                    <th>Общая стоимость</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cart->items as $item)
                    <tr>
                        <td class="product-thumbnail">
                            <a href="{{ route('video.descriptioncamera', $item->camera->id ?? $item->turniket->id ?? $item->barrier->id ?? $item->accessorie->id) }}">
                                <img src="{{ asset('storage/' . ($item->camera->image ?? $item->turniket->image ?? $item->barrier->image ?? $item->accessorie->image)) }}" width="100" height="100" alt="">
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
        <h5>Стоимость товаров в заказе: {{ $cart->items->sum(fn($item) => ($item->camera ? $item->camera->price * $item->quantity : 0) + 
                                            ($item->turniket ? $item->turniket->price * $item->quantity : 0) + 
                                            ($item->accessorie ? $item->accessorie->price * $item->quantity : 0) +
                                            ($item->barrier ? $item->barrier->price * $item->quantity : 0)) }} BYN</h5>
        <h5>Стоимость доставки: {{ $cart->delivery_cost }}</h5>  
        <h4> Итоговая стоимость заказа: {{ $cart->total_price }}</h4>                                  
    @endif
@endsection
