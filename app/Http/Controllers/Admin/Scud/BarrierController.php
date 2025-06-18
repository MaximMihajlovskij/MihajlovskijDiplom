<?php

namespace App\Http\Controllers\Admin\Scud;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Barrier;
use App\Models\Firm;
use App\Models\Specification;

class BarrierController extends Controller
{
    public function index(Request $request)
    {
        $query = Barrier::query();
        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where('name_barrier', 'like', "%{$searchTerm}%")
                ->orWhere('model', 'like', "%{$searchTerm}%")
                ->orWhere('serial_namber', 'like', "%{$searchTerm}%");
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
        // Сортировка
        if ($request->has('sort') && $request->has('order')) {
            $query->orderBy($request->sort, $request->order);
        }
        $barriers = $query->paginate(8);
        $firms =Firm::all();
        return view('admin.scud.barrier', ['barriers' => $barriers, 'firms' => $firms]);    
    }

    public function create()
    {   
        $firms = Firm::all();
        $barriers = Barrier::with('specifications')->get();
        return view('admin.scud.createbarrier', ['firms' => $firms, 'barriers'=> $barriers]);
    }

    public function store(Request $request, Barrier $barrier)
    {
        $request->validate([
            'name_barrier' => 'required|string|max:255',
            'quantity' => 'required|numeric|min:0',
        ]);        
        $imagePath = $request->file('image') ? $request->file('image')->store('barriers', 'public') : null;    
        Barrier::create([
            'name_barrier' => $request->name_barrier,
            'model' => $request->model,
            'serial_namber' => $request->serial_namber,
            'image' => $imagePath,
            'description' => $request->description,
            'price' => $request->price,
            'firm_id'=> $request->firm_id,
            'quantity'=> $request->quantity,
        ]);
        if ($barrier->id) {
            collect($request->spec_keys)
                ->filter(fn($key) => !empty(trim($key)))
                ->each(fn($key, $index) => Specification::create([
                    'barrier_id' => $barrier->id, 
                    'key' => trim($key),
                    'value' => trim($request->spec_values[$index]),
            ]));
        }  
        return redirect()->route('admin.scud.barrier')->with('success', 'Шлагбаум добавлен!');
    }

    public function edit(Barrier $barrier)
    {
            $firms = Firm::all(); // Загружаем список фирм
            return view('admin.scud.editbarrier', ['barrier' => $barrier, 'firms' => $firms]);     
    }
    
    public function update(Request $request, Barrier $barrier)
    {
        $request->validate([
            'name_barrier' => 'required|string|max:255',
            'quantity' => 'required|numeric',
        ]);
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('barriers', 'public');
            $barrier->image = $imagePath;
        }else {
            $imagePath = $barrier->image; // Используем старый путь
        }
        $newQuantity = $barrier->quantity + $request->add_quantity;
        $barrier->update([
            'name_barrier' => $request->name_barrier,
            'model' => $request->model,
            'image' => $imagePath,
            'serial_namber' => $request->serial_namber,
            'description' => $request->description,
            'price' => $request->price,
            'firm_id' => $request->firm_id,
            'quantity' => $newQuantity,
        ]);
        return redirect()->route('admin.scud.barrier')->with('success', 'Шлагбаум обновлён!');
    }
    public function destroy(Barrier $barrier)
    {
        if ($barrier->image) {
            Storage::delete('public/' . $barrier->image);
        }
        $barrier->delete();
        return redirect()->route('admin.scud.barrier')->with('success', 'Шлагбаум удалён!'); 
    }
}
