<?php

namespace App\Http\Controllers\Admin\Scud;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Camera;
use App\Models\Turniket;
use App\Models\Barrier;
use App\Models\User;
use App\Models\Accessorie;

class ReviewsController extends Controller
{
    public function index(Request $request)
    {
        $cameras = Camera::all();
        $turnikets = Turniket::all();
        $barriers = Barrier::all();
        $accessorie = Accessorie::all();
        $users = User::all();
        $query = Review::query()->with(['camera', 'turniket', 'barrier']);
        if ($request->has('search')) {
            $query->whereHas('camera', function ($q) use ($request) {
                $q->where('name_camera', 'like', "%{$request->search}%");
            })->orWhereHas('turniket', function ($q) use ($request) {
                $q->where('name_turniket', 'like', "%{$request->search}%");
            })->orWhereHas('barrier', function ($q) use ($request) {
                $q->where('name_barrier', 'like', "%{$request->search}%");
            })->orWhereHas('accessorie', function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->search}%");
            });
        }
        // Фильтрация по пользователю
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }
        // Фильтрация по типу
        if ($request->filled('type') && in_array($request->type, ['camera', 'turniket', 'barrier', 'accessorie'])) {
            $query->whereHas($request->type);
        } 
        //Фильтрация по дате создания заявки 
        if ($request->filled('date_from') && $request->filled('date_to')) {
            $query->whereBetween('created_at', [$request->date_from, $request->date_to]);
        } elseif ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        } elseif ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }
        //Фильтрация по названию товара
        if ($request->filled('camera_id')) {
            $query->where('camera_id', $request->camera_id);
        } elseif ($request->filled('turniket_id')) {
            $query->where('turniket_id', $request->turniket_id);
        } elseif ($request->filled('barrier_id')) {
            $query->where('barrier_id', $request->barrier_id);
        }elseif ($request->filled('accessorie_id')) {
            $query->where('accessorie_id', $request->accessorie_id);
        }     
        //Сортировка  
        if ($request->has('sort') && $request->has('order')) {
            $query->orderBy($request->sort, $request->order);
        }
        $reviews = $query->get();
        return view("admin.scud.review", ['reviews' => $reviews, 'cameras'=> $cameras, 'turnikets' => $turnikets, 'barriers' => $barriers ,'users'=> $users, 'accessorie' => $accessorie]);
    }

    public function destroy(Review $reviews)
    {
        $reviews->delete();
        return redirect()->route('admin.scud.review')->with('success','Отзыв удалён');
    }
}
