<?php

namespace App\Http\Controllers\Admin\Scud;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCompleteRequest;
use App\Http\Requests\UpdateCompleteRequest;
use App\Models\Completed;

class CompleteController extends Controller
{
    public function index()
    {
        $comleteds = Completed::all();
        return view("admin.scud.complete", ["completeds"=> $comleteds]);
    }

    public function create(Request $request)
    {
        return view('admin.scud.createcomplete');
    }

    public function store(StoreCompleteRequest $request)
    {
       Completed::create([
            "СтатусВыполнения"=> $request->СтатусВыполнения,
       ]);
       return redirect()->route("admin.scud.complete")->with("success","Статус добавлен");
    }

    public function edit(Completed $completed)
    {
        return view('admin.scud.editcomplete', ['completed' => $completed]);
    }

    public function update(UpdateCompleteRequest $request, Completed $completed)
    {
        $completed->update([
            "СтатусВыполнения"=> $request->СтатусВыполнения,
        ]);
        return redirect()->route('admin.scud.complete')->with("success","Статус изменён");
    }

    public function destroy(Completed $completed)
    {
        $completed->delete();
        return redirect()->route("admin.scud.complete")->with("success","Статус удалён");
    }
}
