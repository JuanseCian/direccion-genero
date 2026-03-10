<?php

namespace App\Http\Controllers\frontend\intervenciones;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\IveIntervencion;
use App\Models\IveCaso;
use App\Models\TipoIntervencion;
use App\Models\Encargado;

class IveIntervencionController extends Controller
{

    public function create($casoId)
    {

        $caso = IveCaso::findOrFail($casoId);

        $tiposIntervencion = TipoIntervencion::all();
        $encargados = Encargado::all();

        return view(
            'frontend.areas.ive.intervenciones.create',
            compact(
                'caso',
                'tiposIntervencion',
                'encargados'
            )
        );
    }

    public function store(Request $request, $casoId)
    {

        $request->validate([
            'fecha_intervencion'   => 'required|date',
            'tipo_intervencion_id' => 'required|exists:tipos_intervencion,id',
            'encargado_id'         => 'required|exists:encargados,id',
            'detalle'              => 'required|string',
        ]);

        try {

            IveIntervencion::create([
                'ive_caso_id'          => $casoId,
                'tipo_intervencion_id' => $request->tipo_intervencion_id,
                'fecha_intervencion'   => $request->fecha_intervencion,
                'detalle'              => $request->detalle,
                'encargado_id'         => $request->encargado_id,
            ]);

            return redirect()->route('frontend.areas.ive.edit', $casoId)
                            ->with('success','Intervención registrada correctamente');

        } catch (\Exception $e) {

            return redirect()->back()
                ->withErrors(['error'=>'No se pudo registrar la intervención: '.$e->getMessage()])
                ->withInput();
        }

    }


    public function edit($id)
    {

        $intervencion = IveIntervencion::findOrFail($id);

        $tiposIntervencion = TipoIntervencion::all();
        $encargados = Encargado::all();

        return view(
            'frontend.areas.ive.intervenciones.edit',
            compact(
                'intervencion',
                'tiposIntervencion',
                'encargados'
            )
        );
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'fecha_intervencion'   => 'required|date',
            'tipo_intervencion_id' => 'required|exists:tipos_intervencion,id',
            'encargado_id'         => 'required|exists:encargados,id',
            'detalle'              => 'required|string',
        ]);

        try {

            $intervencion = IveIntervencion::findOrFail($id);

            $intervencion->update([
                'tipo_intervencion_id' => $request->tipo_intervencion_id,
                'fecha_intervencion'   => $request->fecha_intervencion,
                'detalle'              => $request->detalle,
                'encargado_id'         => $request->encargado_id,
            ]);

            return redirect()
                ->route('frontend.areas.ive.edit', $intervencion->ive_caso_id)
                ->with('success','Intervención actualizada correctamente');

        } catch (\Exception $e) {

            return redirect()->back()
                ->withErrors(['error'=>'No se pudo actualizar: '.$e->getMessage()])
                ->withInput();
        }
    }

    public function destroy($id)
    {

        try {

            $intervencion = IveIntervencion::findOrFail($id);
            $intervencion->delete();

            return redirect()->back()->with('success','Intervención eliminada correctamente');

        } catch (\Exception $e) {

            return redirect()->back()
                ->withErrors(['error'=>'No se pudo eliminar: '.$e->getMessage()]);
        }

    }

}