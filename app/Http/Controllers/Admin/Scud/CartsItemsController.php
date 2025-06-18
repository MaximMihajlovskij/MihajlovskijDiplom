<?php

namespace App\Http\Controllers\Admin\Scud;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Cart;
use App\Models\Camera;
use App\Models\Turniket;
use App\Models\Barrier;

class CartsItemsController extends Controller
{
    public function index(Request $request)
    {
        $query = CartItem::with(['camera', 'turniket', 'barrier']);
        $filters = [];
        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where('id', 'like', "%{$searchTerm}%");
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
        $equipments = Camera::select('id', 'name_camera as name')->get()
                    ->concat(Turniket::select('id', 'name_turniket as name')->get())
                    ->concat(Barrier::select('id', 'name_barrier as name')->get());
        // Фильтрация по оборудованию
        if ($request->filled('equipment')) {
            $query->whereHas('camera', fn($q) => $q->where('name_camera', $request->equipment))
                  ->orWhereHas('turniket', fn($q) => $q->where('name_turniket', $request->equipment))
                  ->orWhereHas('barrier', fn($q) => $q->where('name_barrier', $request->equipment));
            $filters['equipment'] = $request->equipment;
        }
        // Фильтрация по цене оборудования
        if ($request->filled('price_min')) {
            $query->where(function ($q) use ($request) {
                $q->whereHas('camera', fn($q) => $q->where('price', '>=', $request->price_min))
                  ->orWhereHas('turniket', fn($q) => $q->where('price', '>=', $request->price_min))
                  ->orWhereHas('barrier', fn($q) => $q->where('price', '>=', $request->price_min));
            });
            $filters['price_min'] = $request->price_min;
        }
        
        if ($request->filled('price_max')) {
            $query->where(function ($q) use ($request) {
                $q->whereHas('camera', fn($q) => $q->where('price', '<=', $request->price_max))
                  ->orWhereHas('turniket', fn($q) => $q->where('price', '<=', $request->price_max))
                  ->orWhereHas('barrier', fn($q) => $q->where('price', '<=', $request->price_max));
            });
            $filters['price_max'] = $request->price_max;
        }
        // Фильтрация по сумме заказа
        if ($request->filled('sum_min') || $request->filled('sum_max')) {
            $query->whereRaw("(COALESCE((SELECT price FROM cameras WHERE cameras.id = camera_id), 
                                        (SELECT price FROM turnikets WHERE turnikets.id = turniket_id), 
                                        (SELECT price FROM barriers WHERE barriers.id = barrier_id), 0) 
                            * quantity) BETWEEN ? AND ?", 
                            [$request->sum_min ?? 0, $request->sum_max ?? PHP_INT_MAX]);
            $filters['sum_min'] = $request->sum_min;
            $filters['sum_max'] = $request->sum_max;
        }
        // Сортировка
        if ($request->has('sort') && $request->has('order')) {
            $query->orderBy($request->sort, $request->order);
        }
        $cartsitems = $query->get();  // ✅ Загружаем все товары
        $carts = Cart::where('user_id', Auth::id())->with(['items.camera', 'items.turniket', 'items.barrier'])->first(); // ✅ Корректные связи

        return view("admin.scud.cartitem", [
            'cartsitems' => $cartsitems,
            'carts' => $carts,
            'filters' => $filters, 
            'equipments' => $equipments
        ]);
    }
}
