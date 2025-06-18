<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Banner;
use App\Models\Partner;
use App\Models\Project;
use App\Models\Wishlist;

class IndexController extends Controller
{
    public function index()
    {
        $users = User::all();
        $banners = Banner::all();
        $partners = Partner::all();
        $projects = Project::all();
        return view("index", ["users"=> $users, "banners" => $banners, "partners" => $partners, "projects" => $projects]);
    }  
}
