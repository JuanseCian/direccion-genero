<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Area;
use App\Models\Role;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{

    // LISTA USUARIOS
    public function index()
    {
        $users = User::all();

        return view('admin.users.index', compact('users'));
    }


    public function edit($id)
    {
        $user = User::findOrFail($id);

        $areas = Area::all();

        $roles = Role::orderBy('id', 'asc')->get();

        return view('admin.users.edit', compact('user', 'areas', 'roles'));
    }


    // ACTUALIZAR USUARIO
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        
        if ($request->rol_id == 3) {
            $user->areas()->detach(); 
        } else {
            $user->areas()->sync($request->areas); 
        }

        $user->rol_id = $request->rol_id;
        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'Usuario actualizado correctamente');
    }

}