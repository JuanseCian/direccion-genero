<?php

namespace App\Http\Controllers\frontend\intervenciones;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DireccionGeneroIntervencion;
use App\Models\DireccionGeneroCaso;
use App\Models\Encargado;
use App\Models\TipoIntervencion;
use App\Models\Adjunto;
use Illuminate\Support\Facades\Storage;
class DireccionGeneroIntervencionController extends Controller
{
    public function create($casoId)
    {
        $caso = DireccionGeneroCaso::with('persona')->findOrFail($casoId);

        $encargados = Encargado::orderBy('apellido')->get();
        $tiposIntervencion = TipoIntervencion::orderBy('nombre')->get();

        return view('frontend.areas.genero.intervenciones.create', compact(
            'caso',
            'encargados',
            'tiposIntervencion'
        ));
    }

   public function store(Request $request, $casoId)
{
    $request->validate([
        'fecha_intervencion'   => 'required|date',
        'tipo_intervencion_id' => 'required|exists:tipos_intervencion,id',
        'encargado_id'         => 'required|exists:encargados,id',
        'detalle'              => 'required|string',
        'archivo'              => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240'
    ]);

    $intervencion = DireccionGeneroIntervencion::create([
        'caso_id'              => $casoId,
        'tipo_intervencion_id' => $request->tipo_intervencion_id,
        'fecha_intervencion'   => $request->fecha_intervencion,
        'detalle'              => $request->detalle,
        'encargado_id'         => $request->encargado_id,
    ]);

    if ($request->hasFile('archivo')) {

        $archivo = $request->file('archivo');

        $nombreGuardado = uniqid().'_'.$archivo->getClientOriginalName();

        $ruta = $archivo->storeAs(
            'adjuntos/intervenciones_genero',
            $nombreGuardado
        );

        Adjunto::create([
            'entidad_tipo' => 'intervencion_genero',
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
        ->route('genero.edit', $casoId)
        ->with('success', 'Intervención registrada correctamente.');
}

    public function edit($id)
    {
        $intervencion = DireccionGeneroIntervencion::findOrFail($id);

        $encargados = \App\Models\Encargado::orderBy('apellido')->get();
        $tiposIntervencion = \App\Models\TipoIntervencion::orderBy('nombre')->get();

        return view('frontend.areas.genero.intervenciones.edit', compact(
            'intervencion',
            'encargados',
            'tiposIntervencion'
        ));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'fecha_intervencion'   => 'required|date',
        'tipo_intervencion_id' => 'required|exists:tipos_intervencion,id',
        'encargado_id'         => 'required|exists:encargados,id',
        'detalle'              => 'required|string',
        'archivo'              => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240'
    ]);

    $intervencion = DireccionGeneroIntervencion::findOrFail($id);

    $intervencion->update([
        'tipo_intervencion_id' => $request->tipo_intervencion_id,
        'fecha_intervencion'   => $request->fecha_intervencion,
        'detalle'              => $request->detalle,
        'encargado_id'         => $request->encargado_id,
    ]);

    if ($request->hasFile('archivo')) {

        $adjuntoExistente = Adjunto::where('entidad_tipo','intervencion_genero')
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
            'adjuntos/intervenciones_genero',
            $nombreGuardado
        );

        Adjunto::create([
            'entidad_tipo' => 'intervencion_genero',
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
        ->route('genero.edit', $intervencion->caso_id)
        ->with('success', 'Intervención actualizada correctamente.');
}
}