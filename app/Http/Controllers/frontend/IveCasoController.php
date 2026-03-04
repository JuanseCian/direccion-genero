<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Persona; 
use App\Models\IveCaso;
use App\Models\Encargado;
use App\Models\DireccionGeneroCaso;
use App\Models\TipoViolencia;
use App\Models\RedContencion;

class IveCasoController extends Controller
{
    public function index()
    {
        $casos = IveCaso::with(['persona'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('frontend.areas.ive.index', compact('casos'));
    }

    public function create()
    {
        $personas = Persona::where('sexo', 'Femenino')
            ->orderBy('apellido')
            ->get();

        $encargados = Encargado::whereHas('areas', function($q){
            $q->where('areas.id',3);
        })->get();

        $idsEnGenero = DireccionGeneroCaso::pluck('persona_id')->toArray();
        $tiposViolencia = TipoViolencia::orderBy('nombre')->get();
        $redes = RedContencion::orderBy('nombre')->get();

        return view('frontend.areas.ive.create', compact(
            'personas',
            'idsEnGenero',
            'encargados',
            'tiposViolencia',
            'redes'
        ));
    }

    public function store(Request $request) 
    {
        $request->validate([
            'persona_id' => 'required|exists:personas,id',
            'fum' => 'nullable|date',
            'eco_semanas' => 'nullable|integer',
            'cantidad_hijos' => 'integer|min:0',
            'encargado_id' => 'required|exists:encargados,id',

            'tipos_violencia' => 'nullable|array',
            'tipos_violencia.*' => 'exists:tipos_violencia,id',

            'redes_contencion' => 'nullable|array',
            'redes_contencion.*' => 'exists:red_contencion,id',

            'medicaciones.*.nombre' => 'nullable|string|max:255',
            'medicaciones.*.numero_lote' => 'nullable|string|max:255',
        ]);

        DB::transaction(function() use ($request) {

            $data = $request->all();

            $data['obra_social'] = $request->has('obra_social') ? 1 : 0;
            $data['interrupcion_previa'] = $request->has('interrupcion_previa') ? 1 : 0;
            $data['violencia_previa'] = $request->has('violencia_previa') ? 1 : 0;

            $caso = IveCaso::create($data);

            // Tipos de violencia
            if ($request->has('tipos_violencia')) {
                $caso->tiposViolencia()->sync($request->tipos_violencia);
            }

            // Redes de contención
            if ($request->has('redes_contencion')) {
                $caso->redesContencion()->sync($request->redes_contencion);
            }

            // Medicaciones
            if ($request->has('medicaciones')) {
                foreach ($request->medicaciones as $med) {
                    if (!empty($med['nombre'])) {
                        $caso->medicaciones()->create([
                            'nombre' => $med['nombre'],
                            'numero_lote' => $med['numero_lote'] ?? null
                        ]);
                    }
                }
            }
        });

        return redirect()
            ->route('frontend.areas.ive.index')
            ->with('success', 'Legajo IVE creado correctamente');
    }

    public function listado()
    {
        $casos = IveCaso::with(['persona'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('frontend.areas.ive.listado', compact('casos'));
    }

    public function edit($id)
    {
        $caso = IveCaso::with([
            'tiposViolencia',
            'redesContencion',
            'medicaciones'
        ])->findOrFail($id);

        $legajo = $caso;

        $personas = Persona::where('sexo', 'Femenino')->get();
        $tiposViolencia = TipoViolencia::orderBy('nombre')->get();
        $redes = RedContencion::orderBy('nombre')->get();

        $encargados = Encargado::whereHas('areas', function($q){
            $q->where('areas.id', 3);
        })->get();
                    
        $existeEnGenero = DireccionGeneroCaso::where('persona_id', $caso->persona_id)->exists();

        return view('frontend.areas.ive.edit', compact(
            'caso', 
            'legajo', 
            'personas', 
            'existeEnGenero', 
            'encargados',
            'tiposViolencia',
            'redes'
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
            'encargado_id' => 'required|exists:encargados,id',

            'tipos_violencia' => 'nullable|array',
            'tipos_violencia.*' => 'exists:tipos_violencia,id',

            'redes_contencion' => 'nullable|array',
            'redes_contencion.*' => 'exists:red_contencion,id',

            'medicaciones.*.nombre' => 'nullable|string|max:255',
            'medicaciones.*.numero_lote' => 'nullable|string|max:255',
        ]);

        DB::transaction(function() use ($request, $caso) {

            $data = $request->all();

            $data['obra_social'] = $request->has('obra_social') ? 1 : 0;
            $data['interrupcion_previa'] = $request->has('interrupcion_previa') ? 1 : 0;
            $data['violencia_previa'] = $request->has('violencia_previa') ? 1 : 0;

            $caso->update($data);

            // Tipos de violencia
            if ($request->has('tipos_violencia')) {
                $caso->tiposViolencia()->sync($request->tipos_violencia);
            } else {
                $caso->tiposViolencia()->sync([]);
            }

            // Redes de contención
            if ($request->has('redes_contencion')) {
                $caso->redesContencion()->sync($request->redes_contencion);
            } else {
                $caso->redesContencion()->sync([]);
            }

            // Medicaciones (recrea todo)
            $caso->medicaciones()->delete();

            if ($request->has('medicaciones')) {
                foreach ($request->medicaciones as $med) {
                    if (!empty($med['nombre'])) {
                        $caso->medicaciones()->create([
                            'nombre' => $med['nombre'],
                            'numero_lote' => $med['numero_lote'] ?? null
                        ]);
                    }
                }
            }
        });

        return redirect()
            ->route('frontend.areas.ive.index')
            ->with('success', 'Caso actualizado correctamente');
    }

    public function destroy(string $id)
    {
        //
    }
}