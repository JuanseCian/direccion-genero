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
            'nombre'=>'required',
            'apellido'=>'required',
            'dni' => 'required|unique:personas,dni',
            'fecha_nacimiento'=>'nullable|date',
            'barrio_id'=>'nullable',
            'trabaja'=>'nullable',
            'nivel_estudio_id' => 'nullable|exists:niveles_estudio,id',
            'provincia_id' => 'nullable|exists:provincia,id',
            'localidad_id' => 'nullable|exists:localidad,id',
            'grupo_sanguineo'=>'nullable'
        ]);

        Persona::create($request->all());

        return redirect()->route('personas.index')
        ->with('success','Persona creada correctamente');
    }

}