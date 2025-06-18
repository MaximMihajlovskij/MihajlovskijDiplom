<?php

namespace App\Http\Controllers\Admin\Scud;

use App\Http\Controllers\Controller;
use App\Models\Completed;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Action;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderStatusChangedMail;

class CartController extends Controller
{
    public function index(Action $action, Completed $completed, Request $request)
    {
        $query = Cart::query();
        $filters = [];
        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where('id', 'like', "%{$searchTerm}%");
        }

        // Фильтрация по пользователю
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
            $filters['user_id'] = $request->user_id;
        }

        // Фильтрация по способу доставки
        if ($request->filled('delivery_method')) {
            $query->where('delivery_method', $request->delivery_method);
            $filters['delivery_method'] = $request->delivery_method;
        }

        // Фильтрация по способу оплаты
        if ($request->filled('payment_method')) {
            $query->where('payment_method', $request->payment_method);
            $filters['payment_method'] = $request->payment_method;
        }

        // Фильтрация по статусу оплаты
        if ($request->filled('paymentstatus')) {
            $query->where('paymentstatus', $request->paymentstatus);
            $filters['paymentstatus'] = $request->paymentstatus;
        }

        // Фильтрация по статусу выполнения заказа
        if ($request->filled('completed_status')) {
            $query->whereHas('completed', function ($q) use ($request) {
                $q->where('СтатусВыполнения', $request->completed_status);
            });
            $filters['completed_status'] = $request->completed_status;
        }

        // Фильтрация по статусу заявки
        if ($request->filled('action_status')) {
            $query->whereHas('action', function ($q) use ($request) {
                $q->where('name_action', $request->action_status);
            });
            $filters['action_status'] = $request->action_status;
        }

        // Фильтрация по дате
        if ($request->filled('date_from') && $request->filled('date_to')) {
            $query->whereBetween('created_at', [$request->date_from, $request->date_to]);
            $filters['date_from'] = $request->date_from;
            $filters['date_to'] = $request->date_to;
        } elseif ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
            $filters['date_from'] = $request->date_from;
        } elseif ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
            $filters['date_to'] = $request->date_to;
        }

        // Сортировка
        if ($request->has('sort') && $request->has('order')) {
            $query->orderBy($request->sort, $request->order);
        }
        $carts = $query->get();
        $action = Action::all();
        $completed = Completed::all();
        $users = User::all();
        return view("admin.scud.cart", ['carts' => $carts, 'action' => $action, 'completed' => $completed, 'users' => $users, 'filters' => $filters]);
    }
    
    public function show(Cart $cart)
    {
        if (!$cart) {
            return redirect()->route('cart.cart')->with('error', 'Корзина не найдена.');
        }
        return view('admin.scud.showcart', ['cart'=> $cart]);
    }

    public function edit(Cart $cart)
    {
        $actions = Action::all();
        $completeds = Completed::all();
        $paymentMethods = [
            'cash' => 'Наличные',
            'card' => 'Карта'
        ];
        $paymentstatus = [
            'success' => 'Оплачено',
            'nosuccess' => 'Не оплачено',
        ];
        $delivery_method = [
            'pickup' => 'Самовывоз',
            'standard' => 'Самовывоз',
            'currier' => 'Доставка курьером',
        ];
        return view('admin.scud.editercart', ['cart' => $cart, 'actions' => $actions, 'completeds' => $completeds, 'paymentMethods' => $paymentMethods, 'paymentstatus' => $paymentstatus, 'delivery_method' => $delivery_method]);
    }

    public function update(Request $request, Cart $cart)
    {
        $cart->update([
            'action_id' => $request->action_id,
            'complete_id' => $request->complete_id,
            'payment_method' => $request->payment_method,
            'paymentstatus' => $request->paymentstatus,
            'delivery_method' => $request->delivery_method,
        ]);
        Mail::to($cart->user->email)->send(new OrderStatusChangedMail($cart));
        return redirect()->route("admin.scud.cart")->with("success","Заказ отредактирован. Уведомление отправлено!");
    }

    public function deleteSelected(Request $request)
    {
        $orderIds = $request->order_ids;

        if (!$orderIds || empty($orderIds)) {
            return response()->json(['message' => 'Не выбраны заказы для удаления'], 400);
        }

        Cart::whereIn('id', $orderIds)->delete();

        return response()->json(['message' => 'Выбранные заказы удалены']);
    }
}
