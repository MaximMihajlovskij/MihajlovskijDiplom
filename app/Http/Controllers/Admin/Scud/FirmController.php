<?php

namespace App\Http\Controllers\Admin\Scud;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreFirmRequest;
use App\Http\Requests\UpdateFirmRequest;
use App\Models\Firm;

class FirmController extends Controller
{
    public function index(Request $request)
    {
        $query = Firm::query();
        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where('Фирма', 'like', "%{$searchTerm}%");
        }
        if ($request->has("sort")&& $request->has('order'))
        {
            $query->orderBy($request->sort, $request->order);
        }
        if ($request->filled('Фирма')) 
        {
            $query->where('Фирма', $request->Фирма);
        }
        $firms = $query->get();
        return view("admin.scud.firms", ["firms"=> $firms]);
    }
    
    public function create()
    {
        return view("admin.scud.createfirms");
    }

    public function store(StoreFirmRequest $request)
    {
        Firm::create([
            'Фирма' => $request->Фирма,
        ]);
        return redirect()->route('admin.scud.firms')->with('success', 'Фирма добавлена!');
    }

    public function edit(Firm $firm)
    {
        return view("admin.scud.editfirms", ["firm"=> $firm]);
    }

    public function update(UpdateFirmRequest $request, Firm $firm)
    {
        $firm->update([
            'Фирма'=> $request->Фирма,
        ]);   
        return view("admin.scud.editfirms", ["firm" => $firm]);
    }

    public function destroy(Firm $firm)
    {
        $firm->delete();
        return redirect()->route('admin.scud.firms')->with('success', 'Фирма удалена!');
    }
}
