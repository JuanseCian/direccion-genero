<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Persona; 
use App\Models\IveCaso;
use App\Models\Encargado;

class IveCasoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $casos = IveCaso::with('persona')->orderBy('created_at', 'desc')->get();

        return view('frontend.areas.ive.index', compact('casos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $personas = \App\Models\Persona::where('sexo', 'Femenino')
                        ->orderBy('apellido')
                        ->get();
        $encargados = Encargado::whereHas('areas', function($q){
            $q->where('areas.id',3);
        })->get();

        $idsEnGenero = \App\Models\DireccionGeneroCaso::pluck('persona_id')->toArray();

        return view('frontend.areas.ive.create', compact('personas', 'idsEnGenero', 'encargados'));
    }

    public function store(Request $request) 
    {
        $request->validate([
            'persona_id' => 'required|exists:personas,id',
            'fum' => 'nullable|date',
            'eco_semanas' => 'nullable|integer',
            'obra_social' => 'boolean',
            'cantidad_hijos' => 'integer|min:0',
            'interrupcion_previa' => 'boolean',
            'encargado_id' => 'required|exists:encargados,id'
        ]);

        IveCaso::create($request->all());
        return redirect()->route('frontend.areas.ive.index')->with('success', 'Legajo IVE creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function listado()
    {
        
        $casos = IveCaso::with('persona')->orderBy('created_at', 'desc')->get();

        return view('frontend.areas.ive.listado', compact('casos'));
    }

    public function edit($id)
    {
        $caso = \App\Models\IveCaso::findOrFail($id);
        
        $legajo = $caso;

        $personas = \App\Models\Persona::where('sexo', 'Femenino')->get();
        
        $encargados = \App\Models\Encargado::whereHas('areas', function($q){
            $q->where('areas.id', 3);
        })->get();
                    
        $existeEnGenero = \App\Models\DireccionGeneroCaso::where('persona_id', $caso->persona_id)->exists();

        return view('frontend.areas.ive.edit', compact(
            'caso', 
            'legajo', 
            'personas', 
            'existeEnGenero', 
            'encargados'
        ));
    }

    public function update(Request $request, $id)
    {
        $caso = IveCaso::findOrFail($id);

        $request->validate([
            'persona_id' => 'required|exists:personas,id',
            'fum' => 'nullable|date',
            'eco_semanas' => 'nullable|integer',
            'cantidad_hijos' => 'integer|min:0',
            'alta' => 'nullable|date',
            'encargado_id' => 'required|exists:encargados,id'
        ]);

        $data = $request->all();
        $data['obra_social'] = $request->has('obra_social') ? 1 : 0;
        $data['interrupcion_previa'] = $request->has('interrupcion_previa') ? 1 : 0;

        $caso->update($data);

        return redirect()->route('frontend.areas.ive.index')->with('success', 'Caso actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
