<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Area;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{

    // LISTA USUARIOS
    public function index()
    {
        $users = User::all();

        return view('admin.users.index', compact('users'));
    }


    // EDITAR USUARIO
    public function edit($id)
    {
        $user = User::findOrFail($id);

        $areas = Area::all();

        return view('admin.users.edit',
            compact('user','areas')
        );
    }


    // ACTUALIZAR USUARIO
    public function update(Request $request,$id)
    {

        $user = User::findOrFail($id);

        $user->update([
            'rol_id'=>$request->rol_id
        ]);

        // GUARDAR PERMISOS AREAS
        $user->areas()->sync($request->areas ?? []);

        return redirect()
        ->route('admin.users.index')
        ->with('success','Usuario actualizado');

    }

}