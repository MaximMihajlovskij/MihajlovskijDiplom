<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Camera;
use App\Models\Turniket;
use App\Models\Barrier;
use App\Models\Accessorie;
use App\Models\Banner;
use App\Notifications\OrderNotification;
use Illuminate\Support\Facades\Storage;

class CartsController extends Controller
{
    public function index()
    {
        $banners = Banner::all();
        $cart = Cart::where('user_id', Auth::id())->with(['items.camera', 'items.turniket', 'items.barrier', 'items.accessorie'])->first();
        $requests = Cart::where('user_id', Auth::id())->with(['items.camera', 'items.turniket', 'items.barrier', 'items.accessorie'])->orderBy('created_at', 'desc')->get();
        $breadcrumbs = [
            ['title' => 'Главная', 'url' => route('index')],
            ['title' => 'Корзина', 'url' => route('cart.cart')],
        ];
        return view('cart.cart', ['cart' => $cart, 'requests' => $requests, 'breadcrumbs' => $breadcrumbs, 'banners' => $banners]);
    }    

    public function addToCart(Request $request)
    {
        if (!$request->filled('camera_id') && !$request->filled('turniket_id') && !$request->filled('barrier_id') && !$request->filled('accessorie_id')) {
            return redirect()->route('cart.cart')->with('error', 'Ошибка! Данные не переданы.');
        }

        $cart = session()->get('cart', []);
        
        $camera = $request->filled('camera_id') ? Camera::find($request->camera_id) : null;
        $turniket = $request->filled('turniket_id') ? Turniket::find($request->turniket_id) : null;
        $barrier = $request->filled('barrier_id') ? Barrier::find($request->barrier_id) : null;
        $accessorie = $request->filled('accessorie_id') ? Accessorie::find($request->accessorie_id) : null;

        if ($camera) {
            $key = "camera-" . $request->camera_id; // 🔹 Уникальный ключ
            $cart[$key] = [
                'id' => $request->camera_id,
                'type' => 'camera',
                'name' => $camera->name_camera,
                'quantity' => ($cart[$key]['quantity'] ?? 0) + $request->quantity,
                'price' => $camera->price,
                'image_url' => $camera->image,
            ];
        }

        if ($turniket) {
            $key = "turniket-" . $request->turniket_id;
            $cart[$key] = [
                'id' => $request->turniket_id,
                'type' => 'turniket',
                'name' => $turniket->name_turniket,
                'quantity' => ($cart[$key]['quantity'] ?? 0) + $request->quantity,
                'price' => $turniket->price,
                'image_url' => $turniket->image,
            ];
        }

        if ($barrier) {
            $key = "barrier-" . $request->barrier_id;
            $cart[$key] = [
                'id' => $request->barrier_id,
                'type' => 'barrier',
                'name' => $barrier->name_barrier,
                'quantity' => ($cart[$key]['quantity'] ?? 0) + $request->quantity,
                'price' => $barrier->price,
                'image_url' => $barrier->image,
            ];
        }

        if ($accessorie) {
            $key = "accessorie-" . $request->accessorie_id;
            $cart[$key] = [
                'id' => $request->accessorie_id,
                'type' => 'accessorie',
                'name' => $accessorie->name,
                'quantity' => ($cart[$key]['quantity'] ?? 0) + $request->quantity,
                'price' => $accessorie->price,
                'image_url' => $accessorie->image,
            ];
        }

        session()->put('cart', $cart);
        return redirect()->route('cart.cart')->with('success', 'Оборудование добавлено в корзину!');
    }
    
    public function store(Request $request)
    {
        
        $cartItems = session()->get('cart', []);
        if (empty($cartItems)) {
            return redirect()->route('cart.cart')->with('error', 'Корзина пуста!');
        }
        $paymentMethod = $request->payment_method ?? 'cash';
        $deliveryMethod = $request->delivery_method ?? 'standard';
        $userAddress = $request->diliveryaddress;
        $paymentStatus = ($paymentMethod === 'card') ? 'Оплачено' : 'Не оплачено';
        // ✅ Вычисляем стоимость товаров
        $totalPrice = collect($cartItems)->sum(fn($item) => $item['price'] * $item['quantity']);

        // ✅ Если сумма товаров меньше 2000 BYN, добавляем 15% доставки
        $deliveryCost = $totalPrice < 2000 ? round($totalPrice * 0.15, 2) : 0;

        // ✅ Сумма заказа с учётом доставки
        $finalPrice = $totalPrice + $deliveryCost;
        $order = Cart::create([
            'user_id' => Auth::id(),
            'payment_method' => $paymentMethod, // ✅ Теперь сохраняем способ оплаты
            'delivery_method' =>  $deliveryMethod, // ✅ Способ доставки
            'diliveryaddress' => $userAddress,
            'paymentstatus' => $paymentStatus,
            'total_price' => $finalPrice, // ✅ Итоговая сумма заказа с доставкой
            'delivery_cost' => $deliveryCost,
        ]);


        foreach ($cartItems as $key => $item) {
            // Определяем тип товара из ключа (например, 'camera-2')
            $type = explode('-', $key)[0]; 
            $id = explode('-', $key)[1];
        
            CartItem::create([
                'cart_id' => $order->id,
                'camera_id' => $type === 'camera' ? $id : null, // ✅ Записываем `camera_id`, если это камера
                'turniket_id' => $type === 'turniket' ? $id : null, // ✅ Записываем `turniket_id`, если это турникет
                'barrier_id' => $type === 'barrier' ? $id : null, // ✅ Записываем `barrier_id`, если это шлагбаум
                'accessorie_id' => $type === 'accessorie' ? $id : null,
                'quantity' => $item['quantity'],
            ]);
        
            // Обновляем количество товара
            if ($type === 'camera') {
                Camera::where('id', $id)->decrement('quantity', $item['quantity']);
            } elseif ($type === 'turniket') {
                Turniket::where('id', $id)->decrement('quantity', $item['quantity']);
            } elseif ($type === 'barrier') {
                Barrier::where('id', $id)->decrement('quantity', $item['quantity']);
            }elseif ($type === 'accessorie') {
                Accessorie::where('id', $id)->decrement('quantity', $item['quantity']);
            }    
        }

        session()->forget('cart');
        Auth::user()->notify(new OrderNotification($order->id));
        return redirect()->route('cart.cart')->with('success', 'Заказ оформлен!');
    }

    public function removeOne(Request $request)
    {
        $cart = session()->get('cart', []);

        $key = $request->type . "-" . $request->id; // ✅ Теперь товар удаляется корректно

        if (isset($cart[$key])) {
            if ($cart[$key]['quantity'] > 1) {
                $cart[$key]['quantity'] -= 1;
            } else {
                unset($cart[$key]); // Удаляем товар, если количество стало 0
            }
        }

        session()->put('cart', $cart);
        return redirect()->route('cart.cart')->with('success', 'Один товар удалён из корзины.');
    }
    
    public function clearCart()
    {
        session()->forget('cart'); // Удаляем корзину из сессии
        return redirect()->route('cart.cart')->with('success', 'Корзина очищена!');
    }

    public function history()
    {
        $userId = auth()->id();
        $requests = Cart::where('user_id', $userId)->with('items.camera')->orderBy('created_at', 'desc')->get();
        
        return view('cart.history', compact('requests'));
    }

    public function orderDetails($orderId)
    {
        $cart = Cart::where('id', $orderId)->with('items.camera')->first();
        if (!$cart) {
            return response('<p class="text-center text-muted">Заказ не найден</p>', 404);
        }
        return view('cart.order_details', compact('cart'));
    }
}