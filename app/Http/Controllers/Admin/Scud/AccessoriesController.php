<?php

namespace App\Http\Controllers\Admin\Scud;

use App\Http\Controllers\Controller;
use App\Models\Turniket;
use Illuminate\Http\Request;
use App\Models\Accessorie;
use App\Models\Camera;
use App\Models\Barrier;

class AccessoriesController extends Controller
{
    public function index(Accessorie $accessories)
    {
        $accessories = Accessorie::all();
        return view("admin.scud.accessories", ["accessories"=> $accessories]);
    }

    public function show($id)
    {
        $accessorie = Accessorie::findOrFail($id);
        return view('admin.scud.showaccessories', compact('accessorie'));
    }

    public function create()
    {
        $turnikets = Turniket::all();
        $cameras = Camera::all();
        $barriers = Barrier::all();
        $accessories = Accessorie::all();
        return view("admin.scud.createaccessories", ["turnikets" => $turnikets, 'accessories' => $accessories, 'cameras'=> $cameras, 'barriers'=> $barriers]);
    }

    public function store(Request $request, Accessorie $accessorie)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'quantity' => 'required|numeric|min:0',
        ]);        
        $imagePath = $request->file('image') ? $request->file('image')->store('accessories', 'public') : null;    
        Accessorie::create([
            'name' => $request->name,
            'turniket_id' => $request->turniket_id,
            'camera_id' => $request->camera_id,
            'barrier_id' => $request->barrier_id,
            'image' => $imagePath,
            'description' => $request->description,
            'price' => $request->price,
            'quantity'=> $request->quantity,
        ]);
        return redirect()->route('admin.scud.accessories')->with('success', 'Аксессуар добавлен!');
    }

    public function edit(Accessorie $accessorie)
    {
        $turnikets = Turniket::all();
        $cameras = Camera::all();
        $barriers = Barrier::all();
        return view('admin.scud.editaccessories', ['accessorie'=> $accessorie, 'turnikets'=> $turnikets, 'cameras'=> $cameras, 'barriers'=> $barriers]);
    }

    public function update(Request $request, Accessorie $accessorie)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'quantity' => 'required|numeric',
        ]); 
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('accessories', 'public');
            $accessorie->image = $imagePath;
        }else {
            $imagePath = $accessorie->image; // Используем старый путь
        }
        $newQuantity = $accessorie->quantity + $request->add_quantity;
        $accessorie->update([
            'name' => $request->name,
            'turniket_id' => $request->turniket_id,
            'camera_id' => $request->camera_id,
            'barrier_id' => $request->barrier_id,
            'image' => $imagePath,
            'description' => $request->description, 
            'price' => $request->price ?? 0,
            'quantity' => $newQuantity,
        ]);
        return redirect()->route('admin.scud.accessories')->with('success', 'Аксессуар обновлён!');
    }

    public function destroy(Accessorie $accessorie)
    {
        $accessorie->delete();
        return redirect()->route('admin.scud.accessories')->with('success','Аксессуар удалён!');
    }
}
