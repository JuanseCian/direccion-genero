<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;
use App\Models\Barrio;
use App\Models\NivelEstudio;
use App\Models\Provincia;
use App\Models\Cud;
use App\Models\Localidad;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

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
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $dnis = $personas->pluck('dni')->filter()->values()->toArray();

        try {
            $response = Http::withHeaders([
                'API-KEY' => env('API_KEY')
            ])->timeout(3)
            ->post(env('ENTRAMADOS_API_URL') . '/legajos/batch', [
                'dnis' => $dnis
            ]);

            $data = $response->json()['data'] ?? [];

            $mapa = collect($data)->keyBy('dni');

            foreach ($personas as $p) {
                if (isset($mapa[$p->dni])) {
                    $p->existe_en_entramados = true;
                    $p->entramados_id = $mapa[$p->dni]['id'];
                } else {
                    $p->existe_en_entramados = false;
                    $p->entramados_id = null;
                }
            }

        } catch (\Exception $e) {
            $dnisExistentes = [];
        }

        foreach ($personas as $p) {
            if (isset($mapa[$p->dni])) {
                $p->existe_en_entramados = true;
                $p->entramados_id = $mapa[$p->dni]['id'];
            } else {
                $p->existe_en_entramados = false;
                $p->entramados_id = null;
            }
        }

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
            'dni' => 'nullable|unique:personas,dni',
            'fecha_nacimiento' => 'nullable',
            'trabaja'=> 'nullable',
            'archivo_cud' => 'nullable|mimes:pdf,jpg,jpeg,png,jfif|max:2048',
        ], [
            'dni.required' => 'El DNI es obligatorio.',
            'dni.unique' => 'Este DNI ya está registrado.',
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
            $path = null;
            if ($request->hasFile('archivo_cud')) {
                $path = $request->file('archivo_cud')->store('cuds'); 
                $cudData['archivo_adjunto'] = $path;
            }

            Cud::create([
                'persona_id' => $persona->id,
                'tiene_cud' => 1,
                'numero_cud' => $request->numero_cud,
                'fecha_emision' => $request->fecha_emision_cud,
                'fecha_vencimiento' => $request->fecha_vencimiento_cud,
                'observaciones' => $request->observaciones_cud,
                'archivo_adjunto' => $path 
            ]);
        }

        return redirect()->route('personas.index')->with('success','Persona creada correctamente');
    }

    public function buscarPorDni($dni)
    {
        $persona = Persona::with([
            'provincia',
            'localidad',
            'barrio'
        ])->where('dni', $dni)->first();

        if (!$persona) {
            return response()->json([
                'existe' => false
            ]);
        }

        return response()->json([
            'existe' => true,
            'data' => [
                'dni' => $persona->dni,
                'nombre' => $persona->nombre,
                'apellido' => $persona->apellido,
                'fecha_nacimiento' => $persona->fecha_nacimiento,
                'telefono' => $persona->telefono,
                'sexo' => $persona->sexo,
                'direccion' => $persona->domicilio,

                'provincia_id' => $persona->provincia_id,
                'localidad_id' => $persona->localidad_id,
                'barrio_id' => $persona->barrio_id,

                'provincia' => $persona->provincia?->nombre,
                'localidad' => $persona->localidad?->nombre,
                'barrio' => $persona->barrio?->nombre,
            ]
        ]);
    }

    public function buscarVariosDni(Request $request)
    {
        $dnis = $request->input('dnis', []);

        if (!is_array($dnis) || empty($dnis)) {
            return response()->json([
                'data' => []
            ]);
        }

        $personas = Persona::with([
            'casosIve',
            'casosGenero',
            'casosMasculinidades'
        ])
        ->whereIn('dni', $dnis)
        ->get();

        $data = $personas->map(function ($p) {

            $areas = [];

            if ($p->casosIve->isNotEmpty()) {
                $areas[] = 'IVE';
            }

            if ($p->casosGenero->isNotEmpty()) {
                $areas[] = 'GÉNERO';
            }

            if ($p->casosMasculinidades->isNotEmpty()) {
                $areas[] = 'MASCULINIDADES';
            }

            return [
                'id' => $p->id,
                'dni' => $p->dni,
                'areas' => $areas
            ];
        });

        return response()->json([
            'data' => $data
        ]);
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
            'dni' => 'nullable|unique:personas,dni,' . $persona->id,
            'apellido' => 'required',
            'nombre' => 'required',
            'archivo_cud' => 'nullable|mimes:pdf,jpg,jpeg,png,jfif|max:2048',
        ], [
            'dni.required' => 'El DNI es obligatorio.',
            'dni.unique' => 'Este DNI ya está registrado.',
        ]);

        $persona->update($request->only([
            'nombre', 'apellido', 'dni', 'fecha_nacimiento', 'sexo', 
            'telefono', 'domicilio', 'provincia_id', 'localidad_id', 
            'barrio_id', 'trabaja', 'nivel_estudio_id', 'grupo_sanguineo'
        ]));
        
        $persona->agresor = $request->has('agresor');
        $persona->victima = $request->has('victima');
        $persona->debe_asistir_masculinidades = $request->has('debe_asistir_masculinidades');
        $persona->save();

        if ($request->numero_cud) {
            $cudData = [
                'tiene_cud' => 1,
                'numero_cud' => $request->numero_cud,
                'fecha_emision' => $request->fecha_emision_cud,
                'fecha_vencimiento' => $request->fecha_vencimiento_cud,
                'observaciones' => $request->observaciones_cud
            ];

            if ($request->hasFile('archivo_cud')) {
                if ($persona->cud && $persona->cud->archivo_adjunto) {
                    Storage::delete($persona->cud->archivo_adjunto);
                }
                $cudData['archivo_adjunto'] = $request->file('archivo_cud')->store('cuds', 'public');
            }

            $persona->cud()->updateOrCreate(['persona_id' => $persona->id], $cudData);
        }

        return redirect()->route('personas.index')->with('success', 'Persona actualizada correctamente.');
    }

    public function verArchivoCud($id)
    {
        $persona = Persona::with('cud')->findOrFail($id);

        if ($persona->cud && $persona->cud->archivo_adjunto) {
            $rutaArchivo = storage_path('app/' . $persona->cud->archivo_adjunto);

            if (file_exists($rutaArchivo)) {
                return response()->file($rutaArchivo);
            }
        }

        return redirect()->back()->withErrors(['error' => 'El archivo no existe o fue eliminado.']);
    }

    public function descargarArchivoCud($id)
    {
        $persona = Persona::with('cud')->findOrFail($id);

        if ($persona->cud && $persona->cud->archivo_adjunto) {
            $rutaArchivo = storage_path('app/' . $persona->cud->archivo_adjunto);

            if (file_exists($rutaArchivo)) {
                return response()->download($rutaArchivo);
            }
        }

        return redirect()->back()->withErrors(['error' => 'El archivo no existe o fue eliminado.']);
    }

}