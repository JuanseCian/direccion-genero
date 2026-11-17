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
            'archivo.*'              => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:51200'
        ]);

        $intervencion = DireccionGeneroIntervencion::create([
            'caso_id'              => $casoId,
            'tipo_intervencion_id' => $request->tipo_intervencion_id,
            'fecha_intervencion'   => $request->fecha_intervencion,
            'detalle'              => $request->detalle,
            'encargado_id'         => $request->encargado_id,
        ]);

        if ($request->hasFile('archivos')) {

            foreach ($request->file('archivos') as $archivo) {

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
        }

        return redirect()
            ->route('genero.edit', $casoId)
            ->with('success', 'Intervención registrada correctamente.');
    }
    public function show($casoId, $intervencionId)
    {
        $caso = DireccionGeneroCaso::with('persona')
            ->findOrFail($casoId);

        $intervencion = DireccionGeneroIntervencion::with([
                'tipo',
                'encargado',
                'adjuntos',
            ])
            ->where('caso_id', $caso->id)
            ->findOrFail($intervencionId);

        return view(
            'frontend.areas.genero.intervenciones.show',
            compact('caso', 'intervencion')
        );
    }

    public function visualizarAdjunto($id)
    {
        $adjunto = Adjunto::where('entidad_tipo', 'intervencion_genero')
            ->findOrFail($id);

        if (!Storage::exists($adjunto->ruta)) {
            abort(404, 'El archivo no existe en el almacenamiento.');
        }

        $mime = $adjunto->tipo_mime
            ?: Storage::mimeType($adjunto->ruta)
            ?: 'application/octet-stream';

        $nombre = str_replace(
            ['"', "\r", "\n"],
            '',
            $adjunto->nombre_original
        );

        return response()->file(
            Storage::path($adjunto->ruta),
            [
                'Content-Type' => $mime,
                'Content-Disposition' => 'inline; filename="' . $nombre . '"',
                'X-Content-Type-Options' => 'nosniff',
            ]
        );
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
            'archivo.*'              => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:51200'
        ]);

        $intervencion = DireccionGeneroIntervencion::findOrFail($id);

        $intervencion->update([
            'tipo_intervencion_id' => $request->tipo_intervencion_id,
            'fecha_intervencion'   => $request->fecha_intervencion,
            'detalle'              => $request->detalle,
            'encargado_id'         => $request->encargado_id,
        ]);

        if ($request->hasFile('archivos')) {

        foreach ($request->file('archivos') as $archivo) {

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
    }

        return redirect()
            ->route('genero.edit', $intervencion->caso_id)
            ->with('success', 'Intervención actualizada correctamente.');
    }

    public function destroy(Request $request, $id)
    {
        $request->validate([
            'motivo_eliminacion' => 'required|string|min:10|max:1000',
        ], [
            'motivo_eliminacion.required' => 'Indique por qué se elimina la intervención.',
            'motivo_eliminacion.min' => 'El motivo debe tener al menos 10 caracteres.',
        ]);

        $intervencion = DireccionGeneroIntervencion::findOrFail($id);
        $intervencion->deleted_by = auth()->id();
        $intervencion->motivo_eliminacion = $request->motivo_eliminacion;
        $intervencion->save();
        $intervencion->delete();

        return redirect()
            ->route('genero.edit', $intervencion->caso_id)
            ->with('success', 'Intervención eliminada correctamente.');
    }
}
