<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Barrier;
use App\Models\Firm;
use Illuminate\Http\Request;

class BarriersController extends Controller
{
    public function index(Request $request)
    {
        $query = Barrier::query();
        // Поиск по названию камеры
        if ($request->filled('search')) {
            $query->where('name_barrier', 'like', "%{$request->search}%");
        }
        // Фильтрация по цене
        if ($request->filled('price_min')) {
            $query->where('price', '>=', $request->price_min);
        }
        if ($request->filled('price_max')) {
            $query->where('price', '<=', $request->price_max);
        }
        // Фильтрация по фирме
        if ($request->filled('firm_id')) {
            $query->where('firm_id', $request->firm_id);
        }
        $barriers = $query->paginate(8);
        $firms=Firm::all();
        $breadcrumbs=[
            ['title'=> 'Главная','url'=> route('index')],
            ['title'=> 'Шлагбаумы','url'=> route('barrier')],
        ];
        return view("barrier.barrier", ['barriers' => $barriers, 'firms'=>$firms, 'breadcrumbs'=> $breadcrumbs]);
    }  
    
    public function show(Request $request, Barrier $barrier)
    {
        $query = Review::where('barrier_id', $barrier->id);
    
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
            ['title'=> 'Шлагбаумы','url'=> route('barrier')],
            ['title' => $barrier->name_barrier, 'url' => route('barrier.descriptionbarrier', $barrier->id)],
        ];
        return view("barrier.descriptionbarrier", ['barrier' => $barrier, 'breadcrumbs'=> $breadcrumbs, 'reviews' => $reviews]);
    }
}
