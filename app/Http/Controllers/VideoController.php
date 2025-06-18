<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use App\Models\Camera;
use App\Models\Firm;
use App\Models\Banner;

class VideoController extends Controller
{
    public function index(Request $request)
    {
        $query = Camera::query();
        // Поиск по названию камеры
        if ($request->filled('search')) {
            $query->where('name_camera', 'like', "%{$request->search}%");
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
        $cameras = $query->paginate(8);
        $firms=Firm::all();
        $breadcrumbs=[
            ['title'=> 'Главная','url'=> route('index')],
            ['title'=> 'Видеокамеры','url'=> route('video')],
        ];
        $reviews = $query->get();
        return view("video.video", ['cameras' => $cameras, 'firms'=>$firms, 'breadcrumbs'=> $breadcrumbs, 'reviews' => $reviews]);
    }  
    
    public function show(Request $request, Camera $camera)
    {
        $banners = Banner::all();
        // Фильтруем отзывы вручную
        $query = Review::where('camera_id', $camera->id);
    
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
        
        $reviews = $query->orderBy('created_at', 'desc')->get(); // Получаем только отфильтрованные отзывы!
    
        return view("video.descriptioncamera", [
            'banners' => $banners,
            'camera' => $camera,
            'reviews' => $reviews, // Передаём отфильтрованные отзывы!
            'breadcrumbs' => [
                ['title'=> 'Главная','url'=> route('index')],
                ['title'=> 'Видеокамеры','url'=> route('video')],
                ['title' => $camera->name_camera, 'url' => route('video.descriptioncamera', $camera->id)],
            ],
        ]);
    }    
}

