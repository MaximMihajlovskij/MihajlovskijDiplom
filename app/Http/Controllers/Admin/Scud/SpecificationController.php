<?php

namespace App\Http\Controllers\Admin\Scud;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Specification;
use App\Models\Turniket;
use App\Models\Camera;
use App\Models\Barrier;

class SpecificationController extends Controller
{
    public function index(Request $request, Specification $specifications)
    {
        $turnikets = Turniket::all();
        $cameras = Camera::all();
        $barriers = Barrier::all();
        $query = Specification::query()->with(['camera', 'turniket', 'barrier']);
        if ($request->has('search')) {
            $query->whereHas('camera', function ($q) use ($request) {
                $q->where('name_camera', 'like', "%{$request->search}%");
            })->orWhereHas('turniket', function ($q) use ($request) {
                $q->where('name_turniket', 'like', "%{$request->search}%");
            })->orWhereHas('barrier', function ($q) use ($request) {
                $q->where('name_barrier', 'like', "%{$request->search}%");
            });
        }
        if ($request->filled('type') && in_array($request->type, ['camera', 'turniket', 'barrier'])) {
            $query->whereNotNull("{$request->type}_id");
        }        
        $specifications = $query->get();
        return view("admin.scud.specification", ['specifications' =>$specifications,"turnikets"=> $turnikets, "cameras"=>$cameras,"barriers"=>$barriers]);
    }

    public function create()
    {
        $turnikets = Turniket::all();
        $cameras = Camera::all();
        $barriers = Barrier::all();
        return view("admin.scud.createspecification", ['turnikets' => $turnikets, 'cameras' => $cameras, 'barriers' => $barriers]);
    }

    public function store(Request $request)
    {
        foreach ($request->key as $index => $key) {
            if (!empty($key) && !empty($request->value[$index])) {
                Specification::create([
                    'turniket_id' => $request->turniket_id,
                    'camera_id' => $request->camera_id,
                    'barrier_id' => $request->barrier_id,
                    'key' => trim($key),
                    'value' => implode('; ', $request->value[$index]), 
                ]);
            }
        }
        return redirect()->route('admin.scud.specification')->with('success', 'Характеристика добавлена!');
    }

    public function edit(Specification $specification)
    {
        $turnikets = Turniket::all();
        $cameras = Camera::all();
        $barriers = Barrier::all();
        return view("admin.scud.editspecification", ['specification' => $specification, 'turnikets' => $turnikets, 'cameras' => $cameras, 'barriers' => $barriers]);
    }

    public function update(Request $request, Specification $specification)
    {
        foreach ($request->key as $index => $key) {
            if (!empty($key) && !empty($request->value[$index])) {
                $specification->update([
                    'turniket_id' => $request->turniket_id,
                    'camera_id' => $request->camera_id,
                    'barrier_id' => $request->barrier_id,
                    'key' => trim($key),
                    'value' => implode('; ', $request->value[$index]), 
                ]);
            }
        }
        return redirect()->route('admin.scud.specification')->with('success', 'Характеристика обновлена!');
    }

    public function destroy(Specification $specification)
    {
        $specification->delete();
        return redirect()->route('admin.scud.specification')->with('success', 'Характеристика удалена!');
    }
}
