<?php

namespace App\Http\Controllers\Admin\sait;

use App\Http\Controllers\Controller;

use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use App\Models\Partner;

class PartnersController extends Controller
{
    public function index()
    {
        $partners = Partner::all();
        return view('admin.scud.sait.index.partner', ['partners' => $partners]);
    }

    public function create()
    {
        return view('admin.scud.sait.index.partnercreate');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);
        $ImagePath = $request->file('image') ? $request->file('image')->store('partners', 'public') : null;
        Partner::create([
            'name' => $request->name,
            'image' => $ImagePath,
        ]);
        return redirect()->route("admin.scud.sait.index.partner")->with("success","Добавлен логотип партнёра");
    }

    public function edit(Partner $partner)
    {
        return view('admin.scud.sait.index.partneredit', ['partner' => $partner]);
    }

    public function update(Request $request, Partner $partner)
    {
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('partners', 'public');
            $partner->image = $imagePath;
        }else {
            $imagePath = $partner->image; // Используем старый путь
        }
        $partner->update([
            'name'=>$request->name,
            'image' => $imagePath,
        ]);
        return redirect()->route("admin.scud.sait.index.partner")->with("success","Изменён логотип партнёра");
    }

    public function destroy(Partner $partner)
    {
        $partner->delete();
        return redirect()->route('admin.scud.sait.index.partner')->with("success","Партнёр удалён");
    }
}
