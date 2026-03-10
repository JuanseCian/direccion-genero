<?php

namespace App\Http\Controllers\frontend\intervenciones;

use App\Http\Controllers\Controller;
use App\Models\MasculinidadesIntervencion;
use App\Models\Adjunto;
use Illuminate\Http\Request;

class MasculinidadesIntervencionController extends Controller
{
    public function store(Request $request, $casoId)
{
    $request->validate([
        'fecha_intervencion' => 'required|date',
        'tipo_intervencion_id' => 'required|exists:tipos_intervencion,id',
        'encargado_id' => 'required|exists:encargados,id',
        'detalle' => 'required|string',
        'archivo' => 'nullable|file|max:10240'
    ]);

    $intervencion = MasculinidadesIntervencion::create([
        'caso_id' => $casoId,
        'fecha_intervencion' => $request->fecha_intervencion,
        'tipo_intervencion_id' => $request->tipo_intervencion_id,
        'encargado_id' => $request->encargado_id,
        'detalle' => $request->detalle,
    ]);

    // GUARDAR ADJUNTO SI EXISTE
    if ($request->hasFile('archivo')) {

        $archivo = $request->file('archivo');

        $nombreOriginal = $archivo->getClientOriginalName();
        $nombreGuardado = uniqid().'_'.$nombreOriginal;

        $ruta = $archivo->storeAs(
            'adjuntos/intervenciones',
            $nombreGuardado
        );

        Adjunto::create([
            'entidad_tipo' => 'intervencion_masculinidades',
            'entidad_id' => $intervencion->id,
            'nombre_original' => $nombreOriginal,
            'nombre_guardado' => $nombreGuardado,
            'ruta' => $ruta,
            'tipo_mime' => $archivo->getMimeType(),
            'tamaño' => $archivo->getSize(),
            'hash_sha256' => hash_file('sha256', $archivo->getRealPath()),
            'subido_por' => auth()->id(),
            'confidencial' => 0,
            'eliminado_logico' => 0
        ]);
    }

    return redirect()->back()->with('success', 'Intervención registrada correctamente.');
}
}