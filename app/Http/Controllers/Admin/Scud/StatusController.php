<?php

namespace App\Http\Controllers\Admin\Scud;

use App\Http\Requests\StatusStoreRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateStatusRequest;
use Illuminate\Http\Request;
use App\Models\Status;

class StatusController extends Controller
{
    public function index()
    {
       $statuses = Status::all();
       return view("admin.scud.status", ["statuses"=> $statuses]);
    }

    public function create()
    {
        return view("admin.scud.createstatus");
    }

    public function store(StatusStoreRequest $request)
    {
        Status::create([
            "СтатусСрочности"=> $request->СтатусСрочности,
        ]);
        return redirect()->route("admin.scud.status")->with("success","Статус добавлен");
    }

    public function edit(Status $status)
    {
        return view("admin.scud.editstatus", ["status"=> $status]);
    }

    public function update(UpdateStatusRequest $request, Status $status)
    {
        $status->update([
            'СтатусСрочности' => $request->СтатусСрочности,
        ]);
        return redirect()->route('admin.scud.status')->with("success","Статус изменён");
    }

    public function destroy(Status $status)
    {
        $status->delete();
        return redirect()->route("admin.scud.status")->with("success","Статус удалён");
    }
}
