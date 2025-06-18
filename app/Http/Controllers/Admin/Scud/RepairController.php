<?php

namespace App\Http\Controllers\Admin\Scud;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateRepairRequest;
use Illuminate\Http\Request;
use App\Models\RepairCamera;
use App\Models\Completed;
use Illuminate\Support\Facades\DB;

class RepairController extends Controller
{
    public function index(Request $request)
    {
        //Поиск
        $searchTerm = $request->search ?? '';
        $query = RepairCamera::query()->where('name_camera', 'like', "%{$searchTerm}%"); // ✔ Работает
        // Сортировка
        if ($request->has('sort') && $request->has('order')) {
            $query->orderBy($request->sort, $request->order);
        }  
        //Фильтрация по дате создания заявки 
        if ($request->filled('date_from') && $request->filled('date_to')) {
            $query->whereBetween('DateCreateRepair', [$request->date_from, $request->date_to]);
        } elseif ($request->filled('date_from')) {
            $query->whereDate('DateCreateRepair', '>=', $request->date_from);
        } elseif ($request->filled('date_to')) {
            $query->whereDate('DateCreateRepair', '<=', $request->date_to);
        }
        $repairscameras = $query->get();    
        return view("admin.scud.repaircamera", ["repairscameras"=> $repairscameras]);
    }

    public function edit(RepairCamera $repaircamera)
    {
        $completeds = Completed::all(); // Загружаем статусы выполнения
        return view('admin.scud.editrepaircamera', ['repaircamera' => $repaircamera, 'completeds' => $completeds]);
    }

    public function update(UpdateRepairRequest $request, RepairCamera $repaircamera)
    {     
        $repaircamera->update([
            "complete_id" => $request->complete_id, 
        ]); 
        return redirect()->route('admin.scud.repaircamera')->with('success', 'Статус обновлён!');
    }

    public function destroy(RepairCamera $repaircamera)
    {
        $repaircamera->delete();
        return redirect()->route('admin.scud.repaircamera')->with('success', 'Заявка удалена!');
    }
}
