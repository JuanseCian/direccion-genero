<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Denuncia;
use App\Models\Persona;
use Illuminate\Http\Request;

class DenunciaController extends Controller
{
    public function index()
    {
        $denuncias = Denuncia::with(['persona','agresor'])
            ->latest()
            ->paginate(10);

        return view('frontend.denuncias.index', compact('denuncias'));
    }

    public function create()
    {
        $personas = Persona::orderBy('apellido')->get();

        return view('frontend.denuncias.create', compact('personas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'persona_id' => 'required|exists:personas,id',
            'agresor_id' => 'nullable|exists:personas,id',
        ]);

        Denuncia::create([
            'persona_id' => $request->persona_id,
            'agresor_id' => $request->agresor_id,
            'fecha' => $request->fecha,
            'descripcion' => $request->descripcion,
            'tipo_violencia' => $request->tipo_violencia,
            'lugar' => $request->lugar,
            'requiere_intervencion' => $request->has('requiere_intervencion') ? 1 : 0,
        ]);

        return redirect()
            ->route('denuncias.index')
            ->with('success','Denuncia creada correctamente');
    }
}