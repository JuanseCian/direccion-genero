<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Barrio;


class BarrioController extends Controller
{

    public function index()
    {
        $barrios = Barrio::with('localidad')->orderBy('nombre')->get();

        return view('backend.barrios.index',compact('barrios'));

    }

    public function create()
    {
        $localidades = \App\Models\Localidad::orderBy('nombre')->get();
        $zonas = \App\Models\ZonaBarrio::orderBy('nombre')->get();

        return view('backend.barrios.create', compact('localidades','zonas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'localidad_id' => 'required',
            'zona_barrio_id' => 'required'
        ]);

        \App\Models\Barrio::create([
            'nombre' => $request->nombre,
            'localidad_id' => $request->localidad_id,
            'zona_barrio_id' => $request->zona_barrio_id
        ]);

        return redirect()->route('barrios.index')
            ->with('success','Barrio creado correctamente');
    }

    public function edit($id)
    {
        $barrio = \App\Models\Barrio::findOrFail($id);

        $localidades = \App\Models\Localidad::orderBy('nombre')->get();
        $zonas = \App\Models\ZonaBarrio::orderBy('nombre')->get();

        return view('backend.barrios.edit',
            compact('barrio','localidades','zonas')
        );
    }

    public function update(Request $request,$id)
    {

        $request->validate([
            'nombre'=>'required',
            'localidad_id' => 'required',
            'zona_barrio_id' => 'required'

        ]);

        $barrio = Barrio::findOrFail($id);

        $barrio->update([
            'nombre'=>$request->nombre,
            'localidad_id' => $request->localidad_id,
            'zona_barrio_id' => $request->zona_barrio_id
        ]);


        return redirect()
        ->route('barrios.index')
        ->with('success','Barrio actualizado');

    }

    public function destroy($id)
    {

        Barrio::destroy($id);

        return redirect()
        ->route('barrios.index')
        ->with('deleted','Barrio eliminado');

    }


}