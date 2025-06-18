<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        return view('portfolio.portfolio', [
            'projects' => $projects,
            'breadcrumbs' => [
                ['title' => 'Главная', 'url' => route('index')],
                ['title' => 'Портфолио', 'url' => route('portfolio.portfolio')]
            ],
        ]);
    }
}
