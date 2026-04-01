<?php

namespace App\Http\Controllers\frontend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Denuncia;

class DenunciaController extends Controller
{
    public function index()
    {
        $denuncias = Denuncia::orderByDesc('fecha')->paginate(10);
        return view('frontend.denuncias.index', compact('denuncias'));
    }

    public function create()
    {
        return view('frontend.denuncias.create');
    }

    public function store(Request $request)
    {
        $data = $this->validar($request);
        Denuncia::create($data);

        return redirect()
            ->route('denuncias.index')
            ->with('success', 'Denuncia creada correctamente');
    }

    public function edit($id)
    {
        $denuncia = Denuncia::findOrFail($id);
        return view('frontend.denuncias.edit', compact('denuncia'));
    }

    public function update(Request $request, $id)
    {
        $denuncia = Denuncia::findOrFail($id);
        $denuncia->update($this->validar($request));

        return redirect()
            ->route('denuncias.index')
            ->with('success', 'Denuncia actualizada correctamente');
    }

    public function destroy($id)
    {
        Denuncia::findOrFail($id)->delete();

        return redirect()
            ->route('denuncias.index')
            ->with('success', 'Denuncia eliminada');
    }

    private function validar($request)
    {
        return $request->validate([
            'fecha' => 'required|date',
            'atendido_por' => 'nullable|string|max:150',
            'denunciante' => 'nullable|string|max:150',
            'dni' => 'nullable|string|max:20',
            'telefono' => 'nullable|string|max:50',
            'direccion' => 'nullable|string|max:255',
            'barrio' => 'nullable|string|max:150',
            'agresor' => 'nullable|string|max:150',
            'tipo_violencia' => 'nullable|string|max:150',
            'observaciones' => 'nullable|string',
        ]);
    }
}