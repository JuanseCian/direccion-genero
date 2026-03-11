<?php

namespace App\Http\Controllers\frontend\intervenciones;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\IveIntervencion;
use App\Models\IveCaso;
use App\Models\TipoIntervencion;
use App\Models\Encargado;
use App\Models\Adjunto;
use Illuminate\Support\Facades\Storage;

class IveIntervencionController extends Controller
{
    public function create($casoId)
    {
        $caso = IveCaso::findOrFail($casoId);
        $tiposIntervencion = TipoIntervencion::all();
        $encargados = Encargado::all();

        return view(
            'frontend.areas.ive.intervenciones.create',
            compact('caso', 'tiposIntervencion', 'encargados')
        );
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

        $caso = IveCaso::findOrFail($casoId);

        $intervencion = IveIntervencion::create([
            'ive_caso_id'          => $caso->id,
            'tipo_intervencion_id' => $request->tipo_intervencion_id,
            'fecha_intervencion'   => $request->fecha_intervencion,
            'detalle'              => $request->detalle,
            'encargado_id'         => $request->encargado_id,
        ]);

        if ($request->hasFile('archivo')) {
            $archivo = $request->file('archivo');
            $nombreGuardado = uniqid().'_'.$archivo->getClientOriginalName();
            $ruta = $archivo->storeAs('adjuntos/intervenciones_ive', $nombreGuardado);

            Adjunto::create([
                'entidad_tipo'    => 'intervencion_ive',
                'entidad_id'      => $intervencion->id,
                'nombre_original' => $archivo->getClientOriginalName(),
                'nombre_guardado' => $nombreGuardado,
                'ruta'            => $ruta,
                'tipo_mime'       => $archivo->getMimeType(),
                'tamaño'          => $archivo->getSize(),
                'subido_por'      => auth()->id() ?? 1,
            ]);
        }

        return redirect()
            ->route('frontend.areas.ive.edit', $caso->id)
            ->with('success','Intervención registrada correctamente');
    }

    public function edit($id)
    {
        $intervencion = IveIntervencion::with('adjunto')->findOrFail($id);
        $tiposIntervencion = TipoIntervencion::all();
        $encargados = Encargado::all();

        return view(
            'frontend.areas.ive.intervenciones.edit',
            compact('intervencion', 'tiposIntervencion', 'encargados')
        );
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

        $intervencion = IveIntervencion::findOrFail($id);

        $intervencion->update([
            'tipo_intervencion_id' => $request->tipo_intervencion_id,
            'fecha_intervencion'   => $request->fecha_intervencion,
            'detalle'              => $request->detalle,
            'encargado_id'         => $request->encargado_id,
        ]);

        // Reemplazo de archivo si sube uno nuevo
        if ($request->hasFile('archivo')) {
            $adjuntoExistente = Adjunto::where('entidad_tipo','intervencion_ive')
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
            $ruta = $archivo->storeAs('adjuntos/intervenciones_ive', $nombreGuardado);

            Adjunto::create([
                'entidad_tipo'    => 'intervencion_ive',
                'entidad_id'      => $intervencion->id,
                'nombre_original' => $archivo->getClientOriginalName(),
                'nombre_guardado' => $nombreGuardado,
                'ruta'            => $ruta,
                'tipo_mime'       => $archivo->getMimeType(),
                'tamaño'          => $archivo->getSize(),
                'subido_por'      => auth()->id() ?? 1,
            ]);
        }

        return redirect()
            ->route('frontend.areas.ive.edit', $intervencion->ive_caso_id)
            ->with('success','Intervención actualizada correctamente');
    }

    public function destroy($id)
    {
        $intervencion = IveIntervencion::findOrFail($id);

        $adjunto = Adjunto::where('entidad_tipo','intervencion_ive')
            ->where('entidad_id',$intervencion->id)
            ->first();

        if ($adjunto) {
            if (Storage::exists($adjunto->ruta)) {
                Storage::delete($adjunto->ruta);
            }
            $adjunto->delete();
        }

        $intervencion->delete();

        return redirect()->back()
            ->with('success','Intervención eliminada correctamente');
    }
}