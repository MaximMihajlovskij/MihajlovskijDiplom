<?php

namespace App\Http\Controllers\Admin\sait;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use Illuminate\Support\Facades\Storage;

class BannersController extends Controller
{
    public function index()
    {
        $banners = Banner::all();
        return view('admin.scud.sait.index.index', ['banners' => $banners]);
    }

    public function create()
    {
        return view('admin.scud.sait.index.create');
    }

    public function store(Request  $request){
        $request->validate([
            'image_path' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);
        $imagePath = $request->file('image_path') ? $request->file('image_path')->store('banners', 'public') : null;
        Banner::create([
            'image_path' => $imagePath,
        ]);
        return redirect()->route("admin.scud.sait.index.index")->with("success","Изображение в баннер добавлено");
    }

    public function destroy(Banner $banner)
    {
        if ($banner->image_path) {
            Storage::delete('public/' . $banner->image_path);
        }
        $banner->delete();
        return redirect()->route('admin.scud.sait.index.index')->with('success', 'Изображение баннера удалено!');
    }
}
