<?php

namespace App\Http\Controllers;
use App\Models\UnidadAdministradora;
use App\Models\Dependencia;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DependenciaController extends Controller
{
    /**
     * Listar todas las dependencias.
     */
  public function index()
{
    $dependencias = Dependencia::with(['unidadAdministradora', 'bienes'])->paginate(10);
    return view('dependencias.index', compact('dependencias'));
}


    /**
     * Guardar una nueva dependencia.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'unidad_administradora_id' => ['required', 'exists:unidades_administradoras,id'],
            'codigo'                   => ['required', 'string', 'max:50', 'unique:dependencias,codigo'],
            'nombre'                   => ['required', 'string', 'max:255'],
        ]);

        $dependencia = Dependencia::create($validated);

        return redirect()->route('dependencias.index')->with('success', 'Dependencia creada correctamente');
    }



    public function create()
    {
        $unidadesAdministradoras = UnidadAdministradora::all();

        // La vista espera $unidades
        return view('dependencias.create', [
            'unidades' => $unidadesAdministradoras,
        ]);
    }




    /**
     * Mostrar una dependencia específica.
     */
    public function show(Dependencia $dependencia)
    {
        $dependencia->load(['unidadAdministradora', 'bienes']);

        return response()->json($dependencia);
    }

    /**
     * Actualizar una dependencia.
     */
    public function update(Request $request, Dependencia $dependencia)
    {
        $validated = $request->validate([
            'unidad_administradora_id' => ['sometimes', 'exists:unidades_administradoras,id'],
            'codigo'                   => [
                'sometimes',
                'string',
                'max:50',
                Rule::unique('dependencias', 'codigo')->ignore($dependencia->id),
            ],
            'nombre'                   => ['sometimes', 'string', 'max:255'],
        ]);

        $dependencia->update($validated);

        return response()->json($dependencia);
    }

    /**
     * Eliminar una dependencia.
     */
    public function destroy(Dependencia $dependencia)
    {
        $dependencia->delete();

        return response()->json(null, 204);
    }
}

