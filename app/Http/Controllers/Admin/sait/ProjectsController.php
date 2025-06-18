<?php

namespace App\Http\Controllers\Admin\sait;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class ProjectsController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        return view('admin.scud.sait.index.projects', ['projects' => $projects]);
    }

    public function create()
    {
        return view('admin.scud.sait.index.createproject');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);
        $ImagePath = $request->file('image') ? $request->file('image')->store('projects', 'public') : null;
        Project::create([
            'image' => $ImagePath,
        ]);
        return redirect()->route("admin.scud.sait.index.projects")->with("success","Добавлен выполненный проект");
    }

    public function edit(Project $project)
    {
        return view('admin.scud.sait.index.editproject', ['project' => $project]);
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('projects', 'public');
            $project->image = $imagePath;
        }else {
            $imagePath = $project->image; // Используем старый путь
        }
        $project->update([
            'image' => $imagePath,
        ]);
        return redirect()->route("admin.scud.sait.index.projects")->with("success","Изменено изображение выполненной работы");
    }

    public function destroy(Project $project)
    {
        $project -> delete();
        return redirect()->route("admin.scud.sait.index.projects")->with("success","Удалено изображение выполненной работы");
    }
}
