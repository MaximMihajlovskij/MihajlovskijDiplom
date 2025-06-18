<?php

namespace App\Http\Controllers\Admin\Scud;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Camera;

class IndexxController extends Controller
{
    public function adminDashboard()
    {
        if (!Gate::allows('admin-access')) {
            abort(403, 'Вы не являетесь администратором'); // Запрещаем если ты не админ
        }
        return view('admin.scud.index');
    }

    public function index()
    {
        $cameras = Camera::All();
        return view("admin.scud.index",['cameras' => $cameras]);
    }
}
