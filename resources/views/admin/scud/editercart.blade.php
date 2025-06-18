@extends('admin')

@section('title', 'Редактировать заказ')

@section('cart-editer')
    <h1>Редактирование заказа № {{ $cart->id }}</h1>
    <form action="{{ route('admin.scud.updatecart', $cart->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <label class="fw-bold mt-2">Статус выполнения</label>
        <div class="input-group">
            <select name="complete_id" class="form-select border border-primary rounded">
                <option value="" disabled selected>Выберите статус</option>
                @foreach($completeds as $completed)
                    <option value="{{ $completed->id }}" {{ $cart->complete_id == $completed->id ? 'selected' : '' }}>
                        {{ $completed->СтатусВыполнения }}
                    </option>
                @endforeach
            </select>
        </div>
        <label class="fw-bold mt-2">Статус доставки</label>
        <div class="input-group">
            <select name="action_id" class="form-select border border-primary rounded">
                <option value="" disabled selected>Выберите статус</option>
                @foreach($actions as $action)
                    <option value="{{ $action->id }}" {{ $cart->action_id == $action->id ? 'selected' : '' }}>
                        {{ $action->name_action }}
                    </option>
                @endforeach
            </select>
        </div>
        <label for="delivery_method" class="fw-bold mt-2">Способ доставки</label>
        <div class="input-group">
            <select name="delivery_method" class="form-select border border-primary rounded">
                @foreach($delivery_method as $key => $value)
                    <option value="{{ $key }}" {{ $cart->delivery_method == $key ? 'selected' : ''}}>
                        {{ $value }}
                    </option>
                @endforeach
            </select>
        </div>
        <label class="fw-bold mt-2">Способ оплаты</label>
        <div class="input-group">
            <select name="payment_method" class="form-select border border-primary rounded">
                @foreach($paymentMethods as $key => $value)
                    <option value="{{ $key }}" {{ $cart->payment_method == $key ? 'selected' : '' }}>
                        {{ $value }}
                    </option>
                @endforeach
            </select>
        </div>
        <label for="paymentstatus" class="fw-bold mt-2">Статус оплаты</label>
        <div class="input-group">
            <select name="paymentstatus" class="form-select border border-primary rounded">
                @foreach($paymentstatus as $key => $value)
                    <option value="{{ $key }}" {{ $cart->paymentstatus == $key ? 'selected' : ''}}>
                        {{ $value }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success mt-3">Сохранить</button>
    </form>
@endsection
