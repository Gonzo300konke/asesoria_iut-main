<?php

namespace App\Http\Controllers;

use App\Models\Organismo;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OrganismoController extends Controller
{
    /**
     * Listar todos los organismos.
     */
   public function index()
{
    $organismos = Organismo::paginate(10);
    return view('organismos.index', compact('organismos'));
}

    /**
     * Mostrar formulario para crear organismo.
     */
    public function create()
    {
        return view('organismos.create');
    }

    /**
     * Guardar un nuevo organismo.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'codigo' => ['required', 'string', 'max:50', 'unique:organismos,codigo'],
            'nombre' => ['required', 'string', 'max:255'],
        ]);

        $organismo = Organismo::create($validated);

        return redirect()->route('organismos.index')->with('success', 'Organismo creado correctamente');
    }

    /**
     * Mostrar un organismo específico.
     */
    public function show(Organismo $organismo)
    {
        $organismo->load('unidadesAdministradoras');

        return response()->json($organismo);
    }

    /**
     * Actualizar un organismo.
     */
    public function update(Request $request, Organismo $organismo)
    {
        $validated = $request->validate([
            'codigo' => [
                'sometimes',
                'string',
                'max:50',
                Rule::unique('organismos', 'codigo')->ignore($organismo->id),
            ],
            'nombre' => ['sometimes', 'string', 'max:255'],
        ]);

        $organismo->update($validated);

        return response()->json($organismo);
    }

    /**
     * Eliminar un organismo.
     */
    public function destroy(Organismo $organismo)
    {
        $organismo->delete();

        return response()->json(null, 204);
    }
}

