<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Camera;
use App\Models\Turniket;
use App\Models\Barrier;
use App\Models\Accessorie;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = trim($request->input('query'));
        
        if (empty($query)) {
            return view('search.results')->with('message', 'Введите поисковый запрос');
        }

        // Поиск по всем моделям с несколькими полями
        $cameras = Camera::where(function($q) use ($query) {
                $q->where('name_camera', 'LIKE', "%{$query}%");
            })
            ->with('firm') // Жадная загрузка фирмы
            ->get();

        $turnikets = Turniket::where('name_turniket', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->get();

        $barriers = Barrier::where('name_barrier', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->get();

        $accessories = Accessorie::where('name', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->get();

        $results = [
            'cameras' => $cameras,
            'turnikets' => $turnikets,
            'barriers' => $barriers,
            'accessories' => $accessories,
        ];

        if ($cameras->isEmpty() && $turnikets->isEmpty() && 
            $barriers->isEmpty() && $accessories->isEmpty()) {
            return view('search.results')->with('message', 'Ничего не найдено по запросу: "'.$query.'"');
        }

        return view('search.results', compact('results', 'query'));
    }
}