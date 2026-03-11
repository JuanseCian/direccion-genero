<?php

namespace App\Http\Controllers;

use App\Models\Adjunto;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdjuntoController extends Controller
{
    public function descargar($id, Request $request)
    {
        $adjunto = Adjunto::findOrFail($id);

        if (!Storage::disk('public')->exists($adjunto->ruta)) {
            abort(404, 'Archivo no encontrado');
        }

        // Registrar la descarga
        DB::table('adjuntos_descargas')->insert([
            'adjunto_id' => $adjunto->id,
            'usuario_id' => auth()->id() ?? 1,
            'fecha_descarga' => now(),
            'ip' => $request->ip()
        ]);

        return Storage::disk('public')->download(
            $adjunto->ruta,
            $adjunto->nombre_original
        );
    }
}