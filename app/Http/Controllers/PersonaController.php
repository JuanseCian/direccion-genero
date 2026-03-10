<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;
use App\Models\Barrio;
use App\Models\NivelEstudio;
use App\Models\Provincia;
use App\Models\Cud;
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
            'nombre' => 'required',
            'apellido' => 'required',
            'dni' => 'required|unique:personas,dni',
            'fecha_nacimiento' => 'required',
            'barrio_id' => 'nullable',
            'trabaja'=> 'required',
            'nivel_estudio_id' => 'nullable|exists:niveles_estudio,id',
            'provincia_id' => 'nullable|exists:provincia,id',
            'localidad_id' => 'nullable|exists:localidad,id',
            'grupo_sanguineo' => 'nullable',
        ]);

        $persona = Persona::create([
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
            'debe_asistir_masculinidades' => $request->has('debe_asistir_masculinidades'),
        ]);

        if($request->numero_cud){

            Cud::create([
                'persona_id' => $persona->id,
                'tiene_cud' => 1,
                'numero_cud' => $request->numero_cud,
                'fecha_emision' => $request->fecha_emision_cud,
                'fecha_vencimiento' => $request->fecha_vencimiento_cud,
                'observaciones' => $request->observaciones_cud
            ]);

        }

        return redirect()
            ->route('personas.index')
            ->with('success','Persona creada correctamente');
    }

    public function edit($id)
    {
        $persona = Persona::with('cud')->findOrFail($id);
        
        $provincias = Provincia::all();
        $localidades = Localidad::all();
        $barrios = Barrio::all();
        $nivelEstudio = NivelEstudio::all();

        return view('frontend.personas.edit', compact(
            'persona', 
            'provincias', 
            'localidades', 
            'barrios', 
            'nivelEstudio'
        ));
    }

    public function update(Request $request, $id)
    {
        $persona = Persona::findOrFail($id);

        $request->validate([
            'dni' => 'required|unique:personas,dni,' . $persona->id,
            'apellido' => 'required|string|max:255',
            'nombre' => 'required|string|max:255',
        ]);

        $persona->dni = $request->dni;
        $persona->apellido = $request->apellido;
        $persona->nombre = $request->nombre;
        $persona->fecha_nacimiento = $request->fecha_nacimiento;
        $persona->sexo = $request->sexo;
        
        $persona->agresor = $request->has('agresor') ? 1 : 0;
        $persona->victima = $request->has('victima') ? 1 : 0;
        $persona->debe_asistir_masculinidades = $request->has('debe_asistir_masculinidades') ? 1 : 0;

        $persona->telefono = $request->telefono;
        $persona->domicilio = $request->domicilio;
        $persona->provincia_id = $request->provincia_id;
        $persona->localidad_id = $request->localidad_id;
        $persona->barrio_id = $request->barrio_id;

        $persona->trabaja = $request->trabaja;
        $persona->nivel_estudio_id = $request->nivel_estudio_id;
        $persona->grupo_sanguineo = $request->grupo_sanguineo;

        $persona->numero_cud = $request->numero_cud;
        $persona->fecha_emision_cud = $request->fecha_emision_cud;
        $persona->fecha_vencimiento_cud = $request->fecha_vencimiento_cud;
        $persona->observaciones_cud = $request->observaciones_cud;

        $persona->save();

        return redirect()->route('personas.index')
                        ->with('success', 'Persona actualizada correctamente.');
    }

}