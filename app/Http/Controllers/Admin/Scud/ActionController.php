<?php

namespace App\Http\Controllers\Admin\Scud;

use App\Http\Controllers\Controller;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use App\Models\Action;

class ActionController extends Controller
{
    public function index()
    {
        $actions = Action::all();
        return view('admin.scud.action', ['actions' => $actions]);
    }

    public function create()
    {
        return view('admin.scud.createaction');
    }

    public function store(Request $request)
    {
        Action::create([
            'name_action' => $request->name_action,
        ]);
        return redirect()->route("admin.scud.action")->with("success","Статус ожидания добавлен");
    }

    public function edit(Action $action)
    {
        return view('admin.scud.editaction', ['action' => $action]);
    }

    public function update(Request $request, Action $action)
    {
        $action->update([
            'name_action' => $request->name_action,
        ]);
        return redirect()->route("admin.scud.action")->with("success","Статус ожидания обновлён");
    }

    public function destroy(Action $action)
    {
        $action->delete();
        return redirect()->route("admin.scud.action")->with("success","Статус ожидания удалён");
    }
}
