<?php

namespace App\Http\Controllers\Admin\Scud;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();
        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where('name', 'like', "%{$searchTerm}%");
        }
        if ($request->has('sort') && $request->has('order')) {
            $query->orderBy($request->sort, $request->order);
        }
        if ($request->filled('role')){
            $query->where('role', $request->role);
        }
        $users = $query->get();
        return view("admin.scud.users", ["users"=> $users]);
    }

    public function edit(User $user)
    {
        $role = [
            'user' => 'Пользователь',
            'admin' => 'Администратор'
        ];
        return view('admin.scud.useredit', ['user' => $user, 'role' => $role]);
    }

    public function update(Request $request, User $user)
    {
        $user->update([
            'role'=>$request->role, 
        ]);
        return redirect()->route("admin.scud.users")->with("success","Изменена роль пользователя $user->name");
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route("admin.scud.users")->with("success","Пользователь $user->name удалён");
    }
}
