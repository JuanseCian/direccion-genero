<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Encargado;
use App\Models\Area;

class EncargadoController extends Controller
{

    public function index()
    {
        $encargados = Encargado::with('areas')->get();

        return view('backend.encargados.index',
        compact('encargados'));
    }

    public function create()
    {
        $areas = Area::all();

        return view('backend.encargados.create',
        compact('areas'));
    }

    public function store(Request $request)
    {

        $encargado = Encargado::create($request->all());

        $encargado->areas()
        ->sync($request->areas);

        return redirect()
        ->route('backend.encargados.index')
        ->with('success','Guardado');
    }


    public function edit(Encargado $encargado)
    {
        $areas = Area::all();

        return view('backend.encargados.edit',
        compact('encargado','areas'));
    }

    public function update(Request $request,
                           Encargado $encargado)
    {

        $encargado->update($request->all());

        $encargado->areas()
        ->sync($request->areas);

        return redirect()
        ->route('backend.encargados.index')
        ->with('success','Actualizado');
    }


    public function destroy(Encargado $encargado)
    {
        $encargado = Encargado::findOrFail($encargado->id);
        $encargado->delete();

        $maxId = \DB::table('encargados')->max('id');

        if($maxId == null)
        {
            $maxId = 0;
        }

        \DB::statement("
            ALTER TABLE encargados AUTO_INCREMENT = ".($maxId+1)
        );

        return redirect()->back()
        ->with('deleted','Encargado eliminado');
    }

}