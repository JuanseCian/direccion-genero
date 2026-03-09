<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;
use App\Models\Barrio;
use App\Models\NivelEstudio;
use App\Models\Provincia;
use App\Models\Localidad;
class PersonaController extends Controller
{


    public function index(Request $request)
    {

        $buscar = $request->buscar;

        $personas = Persona::query()
            ->when($buscar, function ($query, $buscar) {
                $query->where('dni', 'like', "%$buscar%")
                    ->orWhere('nombre', 'like', "%$buscar%")
                    ->orWhere('apellido', 'like', "%$buscar%");
            })
            ->orderBy('apellido')
            ->paginate(10);


        return view(
            'frontend.personas.index',
            compact('personas','buscar')
        );

    }


    public function create()
    {
        $barrios = Barrio::orderBy('nombre')->get();
        $nivelEstudio = NivelEstudio::orderBy('nombre')->get();
        $provincia = Provincia::orderBy('nombre')->get();
        $localidad = Localidad::orderBy('nombre')->get();
        return view('frontend.personas.create', compact('barrios','nivelEstudio','provincia','localidad'));
    }


   public function store(Request $request)
{

    $request->validate([
        'nombre',
        'apellido',
        'dni' ,
        'fecha_nacimiento',
        'barrio_id' ,
        'trabaja',
        'nivel_estudio_id' => 'nullable|exists:niveles_estudio,id',
        'provincia_id' => 'nullable|exists:provincia,id',
        'localidad_id' => 'nullable|exists:localidad,id',
        'grupo_sanguineo' => 'nullable',
    ]);

    Persona::create([
        'nombre' => $request->nombre,
        'apellido' => $request->apellido,
        'dni' => $request->dni,
        'fecha_nacimiento' => $request->fecha_nacimiento,
        'sexo' => $request->sexo,

        'telefono' => $request->telefono,
        'domicilio' => $request->domicilio,

        'provincia_id' => $request->provincia_id,
        'localidad_id' => $request->localidad_id,
        'barrio_id' => $request->barrio_id,

        'trabaja' => $request->trabaja,
        'nivel_estudio_id' => $request->nivel_estudio_id,
        'grupo_sanguineo' => $request->grupo_sanguineo,

        'agresor' => $request->has('agresor'),
        'victima' => $request->has('victima'),
    ]);

    return redirect()
        ->route('personas.index')
        ->with('success','Persona creada correctamente');
}

}