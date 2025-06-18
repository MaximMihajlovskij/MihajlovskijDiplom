@extends('admin')

@section('title', 'Заказанные товары')

@section('content')
    <form action="{{ route('admin.scud.cartitem.export') }}" method="GET" class="d-flex align-items-center gap-2 flex-wrap">
        <select name="equipment" class="form-select form-select-sm w-auto">
            <option value="">Выберите оборудование</option>
            @foreach ($equipments as $equipment)
                <option value="{{ $equipment->name }}" {{ request('equipment') == $equipment->name ? 'selected' : '' }}>
                    {{ $equipment->name }}
                </option>
            @endforeach
        </select>
        <input type="number" name="price_min" class="form-control form-control-sm w-auto" placeholder="Цена от" value="{{ request('price_min') }}">
        <input type="number" name="price_max" class="form-control form-control-sm w-auto" placeholder="Цена до" value="{{ request('price_max') }}">
        <input type="number" name="sum_min" class="form-control form-control-sm w-auto" placeholder="Сумма от" value="{{ request('sum_min') }}">
        <input type="number" name="sum_max" class="form-control form-control-sm w-auto" placeholder="Сумма до" value="{{ request('sum_max') }}">
        <input type="date" name="date_from" class="form-control form-control-sm w-auto shadow-none" value="{{ request('date_from') }}">
        <input type="date" name="date_to" class="form-control form-control-sm w-auto shadow-none" value="{{ request('date_to') }}">
        <button type="submit" class="btn btn-danger btn-sm px-3">
            <i class="fas fa-file-pdf"></i> Экспорт PDF
        </button>
    </form>

    <form method="GET" action="{{ route('admin.scud.cartitem') }}" class="mb-4">
        <div class="row g-3">
            <div class="col-12 d-flex flex-wrap gap-3">
                <select name="equipment" class="form-select w-auto">
                    <option value="">Выберите оборудование</option>
                    @foreach ($equipments as $equipment)
                        <option value="{{ $equipment->name }}" {{ request('equipment') == $equipment->name ? 'selected' : '' }}>
                            {{ $equipment->name }}
                        </option>
                    @endforeach
                </select>
                <input type="number" name="price_min" class="form-control w-auto" placeholder="Цена от" value="{{ request('price_min') }}">
                <input type="number" name="price_max" class="form-control w-auto" placeholder="Цена до" value="{{ request('price_max') }}">
                <input type="number" name="sum_min" class="form-control w-auto" placeholder="Сумма от" value="{{ request('sum_min') }}">
                <input type="number" name="sum_max" class="form-control w-auto" placeholder="Сумма до" value="{{ request('sum_max') }}">
                <input type="date" name="date_from" class="form-control w-auto" value="{{ request('date_from') }}">
                <input type="date" name="date_to" class="form-control w-auto" value="{{ request('date_to') }}">
            </div>

            <div class="col-12 mt-3">
                <button type="submit" class="btn btn-primary">Применить фильтры</button>
                <a href="{{ route('admin.scud.cartitem') }}" class="btn btn-warning">Сбросить фильтры</a>
            </div>
        </div>
    </form>
    <table class="table">
        <thead>
            <tr>
                <th>Оборудование</th>
                <th>Цена</th>
                <th><a href="{{ route('admin.scud.cartitem', ['sort' => 'quantity', 'order' => request('order') == 'asc' ? 'desc' : 'asc']) }}">Количество</a></th>
                <th>Сумма</th>
                <th><a href="{{ route('admin.scud.cartitem', ['sort' => 'created_at', 'order' => request('order') == 'asc' ? 'desc' : 'asc']) }}">Дата покупки</a></th>
            </tr>
        </thead>

        <tbody>
            @if($cartsitems->isEmpty())
                <p class="text-danger">Нет заказанных товаров</p>
            @else    
                @foreach ($cartsitems as $item)
                    <tr>
                        <td class="product-name">
                            {{ $item->camera?->name_camera ?? $item->turniket?->name_turniket ?? $item->barrier?->name_barrier ?? $item->accessorie?->name ?? 'Не указано' }}
                        </td>
                        <td class="product-price"><span class="amount">{{ $item->camera?->price ?? $item->turniket?->price ?? $item->barrier?->price ?? $item->accessorie?->price ?? '?' }} BYN</span></td>
                        <td class="product-quantity text-center">
                            {{ $item['quantity'] }}
                        </td>
                        <td>{{ (($item->camera?->price ?? $item->turniket?->price ?? $item->barrier?->price ?? $item->accessorie?->price) ?? 0) * $item['quantity'] }}</td>
                        <td>{{ $item->created_at }}</td>
                    </tr>
                @endforeach
            @endif    
        </tbody>
    </table>

    <h4>Общая сумма заказанных товаров: 
        {{ collect($cartsitems)->sum(fn($item) => ($item->camera ? $item->camera->price * $item->quantity : 0) + 
                                                  ($item->turniket ? $item->turniket->price * $item->quantity : 0) +
                                                  ($item->accessorie ? $item->accessorie->price * $item->quantity : 0) +
                                                  ($item->barrier ? $item->barrier->price * $item->quantity : 0)) }} BYN
    </h4>

@endsection
