<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TipoViolencia;

class TipoViolenciaController extends Controller
{

    public function index()
    {
        $tipos = TipoViolencia::orderBy('nombre')->get();

        return view(
            'backend.tipo-violencia.index',
            compact('tipos')
        );
    }


    public function create()
    {
        return view('backend.tipo-violencia.create');
    }


    public function store(Request $request)
    {

        $request->validate([
            'nombre' => 'required|max:150|unique:tipos_violencia'
        ]);

        TipoViolencia::create($request->all());

        return redirect()
            ->route('backend.tipo-violencia.index')
            ->with('success','Registro creado correctamente');

    }


    public function edit($id)
    {

        $tipo = TipoViolencia::findOrFail($id);

        return view(
            'backend.tipo-violencia.edit',
            compact('tipo')
        );

    }


    public function update(Request $request, $id)
    {

        $tipo = TipoViolencia::findOrFail($id);

        $request->validate([
            'nombre' =>
            'required|max:150|unique:tipos_violencia,nombre,'.$id
        ]);

        $tipo->update($request->all());

        return redirect()
                ->route('backend.tipo-violencia.index')
                ->with('success','Registro actualizado correctamente');

    }


    public function destroy($id)
    {

        $tipo = TipoViolencia::findOrFail($id);

        $tipo->delete();

        return redirect()
        ->route('backend.tipo-violencia.index')
        ->with('deleted','Tipo de violencia eliminado correctamente');

    }

}