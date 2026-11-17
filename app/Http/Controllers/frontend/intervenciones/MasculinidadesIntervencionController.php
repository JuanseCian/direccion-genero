<?php

namespace App\Http\Controllers\frontend\intervenciones;

use App\Http\Controllers\Controller;
use App\Models\Adjunto;
use App\Models\Encargado;
use App\Models\MasculinidadesCaso;
use App\Models\MasculinidadesIntervencion;
use App\Models\TipoIntervencion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MasculinidadesIntervencionController extends Controller
{
    private const ENTIDAD_TIPO =
        'intervencion_masculinidades';

    private const CARPETA_ADJUNTOS =
        'adjuntos/intervenciones_masculinidades';

    public function create($casoId)
    {
        $caso = MasculinidadesCaso::with('persona')
            ->findOrFail($casoId);

        $encargados = Encargado::orderBy('apellido')->get();

        $tiposIntervencion = TipoIntervencion::orderBy('nombre')
            ->get();

        return view(
            'frontend.areas.masculinidades.intervenciones.create',
            compact(
                'caso',
                'encargados',
                'tiposIntervencion'
            )
        );
    }

    public function store(Request $request, $casoId)
    {
        $validated = $request->validate([
            'fecha_intervencion'   => 'required|date',
            'tipo_intervencion_id' => 'required|exists:tipos_intervencion,id',
            'encargado_id'         => 'required|exists:encargados,id',
            'detalle'              => 'required|string',
            'archivos'             => 'nullable|array',
            'archivos.*'           => 'file|mimes:pdf,jpg,jpeg,png|max:51200',
        ]);

        $caso = MasculinidadesCaso::findOrFail($casoId);

        $intervencion = MasculinidadesIntervencion::create([
            'caso_id'              => $caso->id,
            'fecha_intervencion'   => $validated['fecha_intervencion'],
            'tipo_intervencion_id' => $validated['tipo_intervencion_id'],
            'encargado_id'         => $validated['encargado_id'],
            'detalle'              => $validated['detalle'],
        ]);

        $this->guardarAdjuntos(
            $request,
            $intervencion->id
        );

        return redirect()
            ->route('masculinidades.edit', $caso->id)
            ->with(
                'success',
                'Intervención registrada correctamente.'
            );
    }

    public function show($casoId, $intervencionId)
    {
        $caso = MasculinidadesCaso::with('persona')
            ->findOrFail($casoId);

        $intervencion = MasculinidadesIntervencion::with([
            'tipo',
            'encargado',
            'adjuntos',
        ])
            ->where('caso_id', $caso->id)
            ->findOrFail($intervencionId);

        return view(
            'frontend.areas.masculinidades.intervenciones.show',
            compact(
                'caso',
                'intervencion'
            )
        );
    }

    public function edit($id)
    {
        $intervencion = MasculinidadesIntervencion::with([
            'caso.persona',
            'tipo',
            'encargado',
            'adjuntos',
        ])->findOrFail($id);

        $encargados = Encargado::orderBy('apellido')->get();

        $tiposIntervencion = TipoIntervencion::orderBy('nombre')
            ->get();

        return view(
            'frontend.areas.masculinidades.intervenciones.edit',
            compact(
                'intervencion',
                'encargados',
                'tiposIntervencion'
            )
        );
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'fecha_intervencion'   => 'required|date',
            'tipo_intervencion_id' => 'required|exists:tipos_intervencion,id',
            'encargado_id'         => 'required|exists:encargados,id',
            'detalle'              => 'required|string',
            'archivos'             => 'nullable|array',
            'archivos.*'           => 'file|mimes:pdf,jpg,jpeg,png|max:51200',
        ]);

        $intervencion = MasculinidadesIntervencion::findOrFail($id);

        $intervencion->update([
            'fecha_intervencion'   => $validated['fecha_intervencion'],
            'tipo_intervencion_id' => $validated['tipo_intervencion_id'],
            'encargado_id'         => $validated['encargado_id'],
            'detalle'              => $validated['detalle'],
        ]);

        $this->guardarAdjuntos(
            $request,
            $intervencion->id
        );

        return redirect()
            ->route(
                'masculinidades.edit',
                $intervencion->caso_id
            )
            ->with(
                'success',
                'Intervención actualizada correctamente.'
            );
    }

    public function visualizarAdjunto($id)
    {
        $adjunto = Adjunto::where(
            'entidad_tipo',
            self::ENTIDAD_TIPO
        )->findOrFail($id);

        if (!Storage::exists($adjunto->ruta)) {
            abort(404, 'El archivo adjunto no existe.');
        }

        $mime = $adjunto->tipo_mime
            ?: Storage::mimeType($adjunto->ruta)
            ?: 'application/octet-stream';

        $nombreOriginal = str_replace(
            ['"', "\r", "\n"],
            '',
            $adjunto->nombre_original
        );

        return response()->file(
            Storage::path($adjunto->ruta),
            [
                'Content-Type' => $mime,
                'Content-Disposition' =>
                    'inline; filename="' . $nombreOriginal . '"',
                'X-Content-Type-Options' => 'nosniff',
            ]
        );
    }

    public function destroy(Request $request, $id)
    {
        $request->validate([
            'motivo_eliminacion' => 'required|string|min:10|max:1000',
        ], [
            'motivo_eliminacion.required' => 'Indique por qué se elimina la intervención.',
            'motivo_eliminacion.min' => 'El motivo debe tener al menos 10 caracteres.',
        ]);

        $intervencion = MasculinidadesIntervencion::findOrFail($id);
        $intervencion->deleted_by = auth()->id();
        $intervencion->motivo_eliminacion = $request->motivo_eliminacion;
        $intervencion->save();
        $intervencion->delete();

        return redirect()
            ->route('masculinidades.edit', $intervencion->caso_id)
            ->with(
                'success',
                'Intervención eliminada correctamente.'
            );
    }

    private function guardarAdjuntos(
        Request $request,
        int $intervencionId
    ): void {
        if (!$request->hasFile('archivos')) {
            return;
        }

        foreach ($request->file('archivos') as $archivo) {
            $nombreGuardado = Str::uuid()
                . '.'
                . $archivo->getClientOriginalExtension();

            $ruta = $archivo->storeAs(
                self::CARPETA_ADJUNTOS,
                $nombreGuardado
            );

            Adjunto::create([
                'entidad_tipo'    => self::ENTIDAD_TIPO,
                'entidad_id'      => $intervencionId,
                'nombre_original' => $archivo->getClientOriginalName(),
                'nombre_guardado' => $nombreGuardado,
                'ruta'            => $ruta,
                'tipo_mime'       => $archivo->getMimeType(),
                'tamaño'          => $archivo->getSize(),
                'subido_por'      => auth()->id() ?? 1,
            ]);
        }
    }

    private function eliminarAdjuntos(
        int $intervencionId
    ): void {
        $adjuntos = Adjunto::where(
            'entidad_tipo',
            self::ENTIDAD_TIPO
        )
            ->where(
                'entidad_id',
                $intervencionId
            )
            ->get();

        foreach ($adjuntos as $adjunto) {
            if (
                $adjunto->ruta &&
                Storage::exists($adjunto->ruta)
            ) {
                Storage::delete($adjunto->ruta);
            }

            $adjunto->delete();
        }
    }
}
