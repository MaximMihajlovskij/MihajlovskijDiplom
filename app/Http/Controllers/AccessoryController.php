<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Accessorie;
use App\Models\Review;

class AccessoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Accessorie::query();
        // Поиск по названию камеры
        if ($request->filled('search')) {
            $query->where('name', 'like', "%{$request->search}%");
        }
        // Фильтрация по цене
        if ($request->filled('price_min')) {
            $query->where('price', '>=', $request->price_min);
        }
        if ($request->filled('price_max')) {
            $query->where('price', '<=', $request->price_max);
        }
        $accessories = $query->paginate(8);
        $breadcrumbs=[
            ['title'=> 'Главная','url'=> route('index')],
            ['title'=> 'Аксессуары','url'=> route('accessories.accessories')],
        ];
        return view ('accessories.accessories', ['accessories' => $accessories, 'breadcrumbs' => $breadcrumbs]);
    }

    public function show(Request $request, Accessorie $accessorie)
    {
        $query = Review::where('accessorie_id', $accessorie->id);
    
        if ($request->filled('date_from') && $request->filled('date_to')) {
            $query->whereBetween('created_at', [
                date('Y-m-d 00:00:00', strtotime($request->date_from)),
                date('Y-m-d 23:59:59', strtotime($request->date_to))
            ]);
        } elseif ($request->filled('date_from')) {
            $query->where('created_at', '>=', date('Y-m-d 00:00:00', strtotime($request->date_from)));
        } elseif ($request->filled('date_to')) {
            $query->where('created_at', '<=', date('Y-m-d 23:59:59', strtotime($request->date_to)));
        }        
        
        $reviews = $query->orderBy('created_at', 'desc')->get();
        $breadcrumbs=[
            ['title'=> 'Главная','url'=> route('index')],
            ['title'=> 'Аксессуары','url'=> route('accessories.accessories')],
            ['title' => $accessorie->name, 'url' => route('accessories.descriptionaccessories', $accessorie->id)],
        ];
        return view('accessories.descriptionaccessories', ['breadcrumbs' => $breadcrumbs, 'accessorie' => $accessorie, 'reviews' => $reviews]);
    }
}
