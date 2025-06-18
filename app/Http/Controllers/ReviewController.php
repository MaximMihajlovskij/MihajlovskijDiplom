<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Camera;
use App\Models\Turniket;
use App\Models\Barrier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreReviewRequest;

class ReviewController extends Controller
{
    public function store(StoreReviewRequest $request, Camera $camera)
    {
        $reviewData = [
            'content' => $request->content,
            'rating' => $request->rating,
            'user_id' => Auth::id(),
        ];

        if ($request->has('camera_id')) {
            $reviewData['camera_id'] = $request->camera_id;
        } elseif ($request->has('turniket_id')) {
            $reviewData['turniket_id'] = $request->turniket_id;
        } elseif ($request->has('barrier_id')) {
            $reviewData['barrier_id'] = $request->barrier_id;
        } elseif ($request->has('accessorie_id')) {
            $reviewData['accessorie_id'] = $request->accessorie_id;
        } else {
            return redirect()->back()->with('error', 'Ошибка! Тип товара не указан.');
        }

        Review::create($reviewData);

        return redirect()->back()->with('success', 'Отзыв добавлен!');
    }

    public function update(Request $request, $id)
    {
        $review = Review::find($id);

        if (!$review) {
            return redirect()->back()->with('error', 'Отзыв не найден');
        }

        // Проверяем, является ли текущий пользователь владельцем отзыва
        if ($review->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Вы не можете редактировать этот отзыв!');
        }

        $review->update([
            'content' => $request->input('content'),
            'rating' => $request->input('rating'),
        ]);

        return redirect()->back()->with('success', 'Отзыв обновлён!');
    }

    public function destroy($id)
    {
        $review = Review::find($id);
    
        if (!$review) {
            return redirect()->back()->with('error', 'Отзыв не найден');
        }
    
        // Проверяем, является ли текущий пользователь владельцем отзыва
        if ($review->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Вы не можете удалить этот отзыв!');
        }
    
        $review->delete();
        return redirect()->back()->with('success', 'Отзыв удалён!');
    }    
}

