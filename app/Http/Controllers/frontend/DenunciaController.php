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
        'fecha' => 'nullable|date',
        'atendio_nombre' => 'nullable|string|max:150',
        'atendio_apellido' => 'nullable|string|max:150',
        'nombre' => 'nullable|string|max:150',
        'apellido' => 'nullable|string|max:150',
        'dni' => 'nullable|string|max:20',
    ]);

    Denuncia::create([
        'fecha' => $request->fecha,
        'atendio_nombre' => $request->atendio_nombre,
        'atendio_apellido' => $request->atendio_apellido,
        'nombre' => $request->nombre,
        'apellido' => $request->apellido,
        'dni' => $request->dni,
        'direccion' => $request->direccion,
        'barrio' => $request->barrio,
        'telefono' => $request->telefono,
        'agresor' => $request->agresor,
        'tipo_violencia' => $request->tipo_violencia,
        'observaciones' => $request->observaciones,
    ]);

    return redirect()
        ->route('denuncias.index')
        ->with('success','Denuncia creada correctamente');
}
}