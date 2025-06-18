<?php

namespace App\Http\Controllers\Admin\Scud;

use App\Http\Controllers\Controller;
use App\Models\Turniket;
use App\Models\Firm;
use App\Models\Specification;
use Illuminate\Http\Request;

class TurniketController extends Controller
{
    public function index(Request $request, Turniket $turnikets)
    {
        $query = Turniket::query();
        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where('name_turniket', 'like', "%{$searchTerm}%")
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
        $firms = Firm::all();
        $turnikets = $query->paginate(8);
        return view("admin.scud.turnikety", ["turnikets"=> $turnikets, 'firms' => $firms]);
    }

    public function create(Firm $firms)
    {
        $firms = Firm::all();
        $turnikets = Turniket::with('specifications')->get();
        return view("admin.scud.createturniket", ["firms" => $firms, 'turnikets' => $turnikets]);
    }

    public function store(Request $request, Turniket $turniket)
    {
        $request->validate([
            'name_turniket' => 'required|string|max:255',
            'quantity' => 'required|integer|min:0',
        ]);        
        $imagePath = $request->file('image') ? $request->file('image')->store('turnikets', 'public') : null;    
        Turniket::create([
            'name_turniket' => $request->name_turniket,
            'model' => $request->model,
            'serial_namber' => $request->serial_namber,
            'image' => $imagePath,
            'description' => $request->description,
            'price' => $request->price,
            'firm_id'=> $request->firm_id,
            'quantity'=> $request->quantity,
        ]);
        if ($turniket->id) {
            collect($request->spec_keys)
                ->filter(fn($key) => !empty(trim($key)))
                ->each(fn($key, $index) => Specification::create([
                    'turniket_id' => $turniket->id, 
                    'key' => trim($key),
                    'value' => trim($request->spec_values[$index]),
            ]));
        }    
        return redirect()->route('admin.scud.turnikety')->with('success', 'Турникет добавлен!');
    }

    public function edit(Turniket $turniket, Firm $firms)
    {
        $firms = Firm::all();
        return view('admin.scud.editturniket', ['turniket'=> $turniket, 'firms'=> $firms]);
    }

    public function update(Request $request, Turniket $turniket)
    {
        $request->validate([
            'name_turniket' => 'required|string|max:255',
            'quantity' => 'required|numeric',
        ]);
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('turnikets', 'public');
            $turniket->image = $imagePath;
        }else {
            $imagePath = $turniket->image; // Используем старый путь
        }
        $newQuantity = $turniket->quantity + $request->add_quantity;
        $turniket->update([
            'name_turniket' => $request->name_turniket,
            'model' => $request->model,
            'image' => $imagePath,
            'serial_namber' => $request->serial_namber,
            'description' => $request->description,
            'price' => $request->price,
            'firm_id' => $request->firm_id,
            'quantity' => $newQuantity,
        ]);
        return redirect()->route('admin.scud.turnikety')->with('success', 'Турникет обновлён!');
    }

    public function destroy(Turniket $turniket)
    {
        $turniket->delete();
        return redirect()->route('admin.scud.turnikety')->with('success','Турникет удалён!');
    }
}
