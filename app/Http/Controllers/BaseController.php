<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class BaseController extends Controller
{
    public function base()
    {
        $users = User::all();
        $count = Wishlist::where('user_id', Auth::id())->count();
        return view("base", ["users"=> $users, 'count' => $count]);
    }
}
