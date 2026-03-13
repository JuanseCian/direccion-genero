<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Area;
use App\Models\Role;
use App\Models\iveCaso;
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
        $iveCasos = IveCaso::with('persona')
    ->orderBy('id','desc')
    ->get();
        return view('admin.users.edit', compact(
    'user',
    'roles',
    'areas',
    'iveCasos'
));
    }


    // ACTUALIZAR USUARIO
  public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    if ($request->rol_id == 3) {

        // si queda inactivo quitamos accesos
        $user->areas()->detach();
        $user->iveCasos()->detach();

    } else {

        // sincronizar areas
        $user->areas()->sync($request->areas ?? []);

        // sincronizar casos individuales
        $user->iveCasos()->sync($request->ive_casos ?? []);
    }

    $user->rol_id = $request->rol_id;
    $user->save();

    return redirect()
        ->route('admin.users.index')
        ->with('success', 'Usuario actualizado correctamente');
}

}