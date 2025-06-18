<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateFeedbackRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\RepairCamera;
use App\Models\Camera;
use App\Models\Status;
use App\Models\Completed;

class FeedbackController extends Controller
{
    public function index(Camera $camera, Request $requests)
    {
        $userId = auth()->id();
        $statuses = Status::all();
        $completeds = Completed::all();
        $requests = RepairCamera::where('user_id', $userId)->orderBy('DateCreateRepair', 'desc')->get();
        return view("feedback", ["statuses" => $statuses, 'completeds' => $completeds, "requests" => $requests]);
    }

    public function create(CreateFeedbackRequest $request)
    {
        $imagePath = $request->file('image') ? $request->file('image')->store('repairs', 'public') : null;
        RepairCamera::create([
            'user_id' => Auth::id(), // ID пользователя
            'name_camera' => $request->name_camera,
            'DateCreateRepair' => now(),
            'image' => $imagePath,
            'telephon' => $request->telephon,
            'email' => $request->email,
            'ProblemDescription' => $request->ProblemDescription,
            'status_id' => $request->status_id,
        ]);
        session()->flash('success', 'Заявка успешно отправлена!');
        return redirect()->route('contact');      
    }

    public function history(Request $request)
    {
        $userId = auth()->id();
        $requests = RepairCamera::where('user_id', $userId)->orderBy('DateCreateRepair', 'desc')->get();
        return view('repair-history', compact('requests'));
    }
}
