<?php

namespace App\Http\Controllers\frontend\intervenciones;

use App\Http\Controllers\Controller;
use App\Models\MasculinidadesIntervencion;
use App\Models\MasculinidadesCaso;
use App\Models\Encargado;
use App\Models\TipoIntervencion;
use App\Models\Adjunto;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class MasculinidadesIntervencionController extends Controller
{

public function create($casoId)
{
    $caso = MasculinidadesCaso::with('persona')->findOrFail($casoId);

    $encargados = Encargado::orderBy('apellido')->get();
    $tiposIntervencion = TipoIntervencion::orderBy('nombre')->get();

    return view(
        'frontend.areas.masculinidades.intervenciones.create',
        compact('caso','encargados','tiposIntervencion')
    );
}


public function store(Request $request, $casoId)
{
    $request->validate([
        'fecha_intervencion' => 'required|date',
        'tipo_intervencion_id' => 'required|exists:tipos_intervencion,id',
        'encargado_id' => 'required|exists:encargados,id',
        'detalle' => 'required|string',
        'certificado' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120'
    ]);

    $intervencion = MasculinidadesIntervencion::create([
        'caso_id' => $casoId,
        'fecha_intervencion' => $request->fecha_intervencion,
        'tipo_intervencion_id' => $request->tipo_intervencion_id,
        'encargado_id' => $request->encargado_id,
        'detalle' => $request->detalle,
    ]);
   
    // Guardar archivo si existe
    if ($request->hasFile('archivo')) {

    $archivo = $request->file('archivo');

    $nombreGuardado = uniqid().'_'.$archivo->getClientOriginalName();

    $ruta = $archivo->storeAs(
    'adjuntos/intervenciones',
    $nombreGuardado
);

    Adjunto::create([
        'entidad_tipo' => 'intervencion_masculinidades',
        'entidad_id' => $intervencion->id,
        'nombre_original' => $archivo->getClientOriginalName(),
        'nombre_guardado' => $nombreGuardado,
        'ruta' => $ruta,
        'tipo_mime' => $archivo->getMimeType(),
        'tamaño' => $archivo->getSize(),
        'subido_por' => auth()->id() ?? 1,
    ]);
}

    return redirect()->back()->with('success', 'Intervención registrada correctamente.');
}


public function edit($id)
{
    $intervencion = MasculinidadesIntervencion::with('caso.persona')->findOrFail($id);

    $encargados = Encargado::orderBy('apellido')->get();
    $tiposIntervencion = TipoIntervencion::orderBy('nombre')->get();

    return view(
        'frontend.areas.masculinidades.intervenciones.edit',
        compact('intervencion','encargados','tiposIntervencion')
    );
}


public function update(Request $request,$id)
{
    $request->validate([
        'fecha_intervencion' => 'required|date',
        'tipo_intervencion_id' => 'required|exists:tipos_intervencion,id',
        'encargado_id' => 'required|exists:encargados,id',
        'detalle' => 'required|string',
        'archivo' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240'
    ]);

    $intervencion = MasculinidadesIntervencion::findOrFail($id);

    $intervencion->update([
        'fecha_intervencion' => $request->fecha_intervencion,
        'tipo_intervencion_id' => $request->tipo_intervencion_id,
        'encargado_id' => $request->encargado_id,
        'detalle' => $request->detalle,
    ]);

    // REEMPLAZAR archivo si se sube uno nuevo
    if ($request->hasFile('archivo')) {

        $adjuntoExistente = Adjunto::where('entidad_tipo','intervencion_masculinidades')
            ->where('entidad_id',$intervencion->id)
            ->first();

        if ($adjuntoExistente) {

            if (Storage::exists($adjuntoExistente->ruta)) {
                Storage::delete($adjuntoExistente->ruta);
            }

            $adjuntoExistente->delete();
        }

        $archivo = $request->file('archivo');

        $nombreGuardado = uniqid().'_'.$archivo->getClientOriginalName();

        $ruta = $archivo->storeAs(
            'adjuntos/intervenciones',
            $nombreGuardado
        );

        Adjunto::create([
            'entidad_tipo' => 'intervencion_masculinidades',
            'entidad_id' => $intervencion->id,
            'nombre_original' => $archivo->getClientOriginalName(),
            'nombre_guardado' => $nombreGuardado,
            'ruta' => $ruta,
            'tipo_mime' => $archivo->getMimeType(),
            'tamaño' => $archivo->getSize(),
            'subido_por' => auth()->id() ?? 1,
        ]);
    }

    return redirect()
        ->route('masculinidades.edit',$intervencion->caso_id)
        ->with('success','Intervención actualizada correctamente.');
}

}