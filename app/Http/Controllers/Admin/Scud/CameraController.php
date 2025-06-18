<?php

namespace App\Http\Controllers\Admin\Scud;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Camera;
use App\Models\Firm;
use App\Models\Specification;
use App\Http\Requests\StoreCameraRequest;
use App\Http\Requests\UpdateCameraRequest;
use Illuminate\Support\Facades\Storage;

class CameraController extends Controller
{
    public function index(Request $request)
    {
        $query = Camera::query();
        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where('name_camera', 'like', "%{$searchTerm}%")
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
        $cameras = $query->get();
        $firms =Firm::all();
        return view('admin.scud.crudcamera', ['cameras' => $cameras, 'firms' => $firms]);    
    }

    public function create()
    {   
        $firms = Firm::all();
        $cameras = Camera::with('specifications')->get();
        return view('admin.scud.createcamera', ['firms' => $firms, 'cameras'=> $cameras]);
    }

    public function store(StoreCameraRequest $request, Camera $camera)
    {
        $imagePath = $request->file('image') ? $request->file('image')->store('cameras', 'public') : null;    
        Camera::create([
            'name_camera' => $request->name_camera,
            'model' => $request->model,
            'serial_namber' => $request->serial_namber,
            'image' => $imagePath,
            'price' => $request->price,
            'firm_id'=> $request->firm_id,
            'quantity'=> $request->quantity,
        ]);
        if ($camera->id) {
            collect($request->spec_keys)
                ->filter(fn($key) => !empty(trim($key)))
                ->each(fn($key, $index) => Specification::create([
                    'camera_id' => $camera->id, 
                    'key' => trim($key),
                    'value' => trim($request->spec_values[$index]),
            ]));
        }    
        return redirect()->route('admin.scud.crudcamera')->with('success', 'Камера добавлена!');
    }

    public function edit(Camera $camera)
    {
            $firms = Firm::all(); // Загружаем список фирм
            return view('admin.scud.editercamera', ['camera' => $camera, 'firms' => $firms]);     
    }
    
    public function update(UpdateCameraRequest $request, Camera $camera)
    {
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('cameras', 'public');
            $camera->image = $imagePath;
        }else {
            $imagePath = $camera->image; // Используем старый путь
        }
        $newQuantity = $camera->quantity + $request->add_quantity;
        $camera->update([
            'name_camera' => $request->name_camera,
            'model' => $request->model,
            'image' => $imagePath,
            'serial_namber' => $request->serial_namber,
            'price' => $request->price,
            'firm_id' => $request->firm_id,
            'quantity' => $newQuantity
        ]);
        return redirect()->route('admin.scud.crudcamera')->with('success', 'Камера обновлена!');
    }
    public function destroy(Camera $camera)
    {
        if ($camera->image) {
            Storage::delete('public/' . $camera->image);
        }
        $camera->delete();
        return redirect()->route('admin.scud.crudcamera')->with('success', 'Камера удалена!');
    }
}

