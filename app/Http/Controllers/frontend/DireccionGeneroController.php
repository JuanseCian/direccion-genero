<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\{DireccionGeneroCaso, Persona, Provincia, Localidad, Barrio, EstadoCivil, NivelEstudio, IveCaso, MasculinidadesCaso, Encargado};
use Illuminate\Http\Request;

class DireccionGeneroController extends Controller
{
    public function index()
    {
        $casos = DireccionGeneroCaso::with('persona')->orderBy('id', 'desc')->get();
        return view('frontend.areas.genero.index', compact('casos'));
    }

    public function listado()
    {
        $legajos = DireccionGeneroCaso::with([
            'persona',
            'localidad',
            'estadoCivil',
            'nivelEstudio',
            'encargado'
        ])->get();
        
        return view('frontend.areas.genero.listado', compact('legajos'));
    }

   public function create()
{
    $personas = Persona::select(
            'id',
            'apellido',
            'nombre',
            'dni',
            'provincia_id',
            'localidad_id',
            'barrio_id',
            'nivel_estudio_id',
            'trabaja'
        )
        ->where('sexo','Femenino')
        ->orderBy('apellido')
        ->get();

    $idsIve = IveCaso::pluck('persona_id')->toArray();

    $provincias = Provincia::orderBy('nombre')->get();
    $localidades = Localidad::orderBy('nombre')->get();
    $barrios = Barrio::orderBy('nombre')->get();
    $estados_civiles = EstadoCivil::orderBy('nombre')->get();
    $niveles_estudio = NivelEstudio::orderBy('nombre')->get();

    $encargados = Encargado::whereHas('areas', function($q){
        $q->where('areas.id',1);
    })->get();

    return view('frontend.areas.genero.create', compact(
        'personas',
        'provincias',
        'localidades',
        'barrios',
        'estados_civiles',
        'niveles_estudio',
        'idsIve',
        'encargados'
    ));
}

    public function store(Request $request)
    {
        $request->validate([
            'persona_id' => 'required|exists:personas,id',
        ]);

        $trabaja = $request->has('trabaja') ? 1 : 0;
        $orgSocial = $request->has('organizacion_social') ? 1 : 0;
        
        DireccionGeneroCaso::create([
            'persona_id' => $request->persona_id,
            'estado_civil_id' => $request->estado_civil_id,
            'genero' => $request->genero,
            'provincia_id' => $request->provincia_id,
            'localidad_id' => $request->localidad_id,
            'barrio_id' => $request->barrio_id,
            'nivel_estudio_id' => $request->nivel_estudio_id,
            'trabaja' => $trabaja,
            'organizacion_social' => $orgSocial,
            'organizacion_social_detalle' => $request->organizacion_social_detalle,
            'observaciones' => $request->observaciones,
            'encargado_id' => $request->encargado_id
        ]);

        return redirect()->route('genero.listado')->with('success','Legajo creado correctamente');
    }

    public function edit($id)
    {
        $legajo = DireccionGeneroCaso::findOrFail($id);
        $personas = Persona::where('sexo', 'Femenino')->orderBy('apellido')->get();
        $barrios = Barrio::orderBy('nombre', 'asc')->get();
        $casosMasculinidades = MasculinidadesCaso::with('persona')->get();

        $existeEnIve = IveCaso::where('persona_id', $legajo->persona_id)->exists();

        $provincias = Provincia::orderBy('nombre')->get();
        $localidades = Localidad::orderBy('nombre')->get();
        $barrios = Barrio::orderBy('nombre')->get();
        $estados_civiles = EstadoCivil::orderBy('nombre')->get();
        $niveles_estudio = NivelEstudio::orderBy('nombre')->get();
        $encargados = Encargado::whereHas('areas', function($q){
            $q->where('areas.id',1);
        })->get();

        return view('frontend.areas.genero.edit', compact(
            'legajo',
            'personas',
            'provincias',
            'localidades',
            'barrios',
            'estados_civiles',
            'niveles_estudio',
            'casosMasculinidades',
            'existeEnIve',
            'encargados'
        ));
    }

    public function update(Request $request, $id)
    {
        $legajo = DireccionGeneroCaso::findOrFail($id);

        $request->validate([
            'persona_id' => 'required|exists:personas,id',
        ]);

        $trabaja = $request->has('trabaja') ? 1 : 0;
        $orgSocial = $request->has('organizacion_social') ? 1 : 0;

        $legajo->update([
            'persona_id' => $request->persona_id,
            'estado_civil_id' => $request->estado_civil_id,
            'genero' => $request->genero,
            'provincia_id' => $request->provincia_id,
            'localidad_id' => $request->localidad_id,
            'barrio_id' => $request->barrio_id,
            'nivel_estudio_id' => $request->nivel_estudio_id,
            'trabaja' => $trabaja,
            'organizacion_social' => $orgSocial,
            'organizacion_social_detalle' => $request->organizacion_social_detalle,
            'observaciones' => $request->observaciones,
            'encargado_id' => $request->encargado_id
        ]);

        if ($request->has('agresores')) {
            $legajo->agresores()->sync($request->agresores);
        } else {
            $legajo->agresores()->detach(); // Si se desmarcan todos
        }

        return redirect()->route('genero.listado')->with('success', 'Legajo actualizado correctamente');
    }

    public function destroy($id)
    {
        $legajo = DireccionGeneroCaso::findOrFail($id);
        $legajo->delete();

        return redirect()->route('genero.listado')->with('success', 'Legajo eliminado correctamente');
    }
}