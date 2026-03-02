<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ZonaBarrio;

class ZonaBarrioController extends Controller
{

    public function index()
    {
        $zonas = ZonaBarrio::orderBy('nombre')->get();
        return view('backend.zonas.index', compact('zonas'));
    }


    public function create()
    {
        return view('backend.zonas.create');
    }


    public function store(Request $request)
    {

        $request->validate([
        'nombre'=>'required'
        ]);

        ZonaBarrio::create($request->all());

        return redirect()->route('zonas.index')
        ->with('success','Zona creada');

}


    public function edit($id)
    {

        $zona = ZonaBarrio::findOrFail($id);

        return view('backend.zonas.edit',
        compact('zona'));

    }


    public function update(Request $request,$id)
    {

        $zona = ZonaBarrio::findOrFail($id);

        $zona->update($request->all());

        return redirect()->route('zonas.index')
        ->with('success','Zona actualizada');

    }


    public function destroy($id)
    {

        ZonaBarrio::destroy($id);

        return back()->with('deleted','Zona eliminada');

    }

}