<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\DireccionGeneroCaso;
use App\Models\Persona;
use App\Models\Provincia;
use App\Models\Localidad;
use App\Models\Barrio;
use App\Models\EstadoCivil;
use App\Models\NivelEstudio;

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
        $legajos = DireccionGeneroCaso::with(['persona', 'localidad', 'estadoCivil', 'nivelEstudio'])->get();

        return view('frontend.areas.genero.listado', compact('legajos'));
    }

    public function create()
    {
        $personas = Persona::where('sexo','Femenino')
                            ->orderBy('apellido')
                            ->get();

        $provincias = Provincia::orderBy('nombre')->get();
        $localidades = Localidad::orderBy('nombre')->get();
        $barrios = Barrio::orderBy('nombre')->get();
        $estados_civiles = EstadoCivil::orderBy('nombre')->get();
        $niveles_estudio = NivelEstudio::orderBy('nombre')->get();

        return view('frontend.areas.genero.create', compact(
            'personas',
            'provincias',
            'localidades',
            'barrios',
            'estados_civiles',
            'niveles_estudio'
        ));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'persona_id' => 'required|exists:personas,id',
        ]);

        DireccionGeneroCaso::create([
            'persona_id' => $request->persona_id,
            'estado_civil_id' => $request->estado_civil_id,
            'genero' => $request->genero,
            'provincia_id' => $request->provincia_id,
            'localidad_id' => $request->localidad_id,
            'barrio_id' => $request->barrio_id,
            'nivel_estudio_id' => $request->nivel_estudio_id,
            'trabaja' => $request->trabaja,
            'organizacion_social' => $request->organizacion_social,
            'organizacion_social_detalle' => $request->organizacion_social_detalle,
            'observaciones' => $request->observaciones
        ]);

        return redirect()
            ->route('genero.index')
            ->with('success','Legajo creado correctamente');
    }

}