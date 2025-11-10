<?php

namespace App\Http\Controllers;

use App\Enums\EstadoBien;
use App\Models\Bien;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BienController extends Controller
{
    /**
     * Listar todos los bienes.
     */
    // BienController.php
        public function index(Request $request)
    {
        $search = $request->input('search');

        $bienes = Bien::with(['dependencia.responsable', 'movimientos'])
            ->search($search) // usamos el scope
            ->paginate(10)
            ->appends(['search' => $search]); // mantiene el término en la paginación

        return view('bienes.index', compact('bienes', 'search'));
    }


    /**
     * Mostrar formulario de creación.
     */
    public function create()
    {
    // Cargamos las dependencias con su responsable para mostrar al seleccionar
    $dependencias = \App\Models\Dependencia::with('responsable')->get();

    return view('bienes.create', compact('dependencias'));
    }

    /**
     * Guardar un nuevo bien.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'dependencia_id' => ['required', 'exists:dependencias,id'],
            'codigo' => ['required', 'string', 'max:50', 'unique:bienes,codigo'],
            'descripcion' => ['required', 'string', 'max:255'],
            'ubicacion' => ['nullable', 'string', 'max:255'],
            'estado' => ['required', Rule::enum(EstadoBien::class)],
            'fecha_registro' => ['required', 'date'],
        ]);



    // El responsable se obtiene dinámicamente a través de la dependencia; no lo almacenamos en la tabla bienes.
    $bien = Bien::create($validated);

        return redirect()
            ->route('bienes.index')
            ->with('success', 'Bien creado correctamente.');
    }



    /**
     * Mostrar un bien específico.
     */
    public function show(Bien $bien)
    {
    $bien->load(['dependencia.responsable', 'movimientos']);

        return view('bienes.show', compact('bien'));
    }

    /**
     * Mostrar formulario de edición.
     */
    public function edit(Bien $bien)
    {
    // Para editar mostramos la lista de dependencias (si se necesita cambiar)
    $dependencias = \App\Models\Dependencia::with('responsable')->get();
    return view('bienes.edit', compact('bien', 'dependencias'));
    }

    /**
     * Actualizar un bien.
     */
    public function update(Request $request, Bien $bien)
    {
        $validated = $request->validate([
            'dependencia_id' => ['sometimes', 'exists:dependencias,id'],
            'codigo' => [
                'sometimes',
                'string',
                'max:50',
                Rule::unique('bienes', 'codigo')->ignore($bien->getKey()),
            ],
            'descripcion' => ['sometimes', 'string', 'max:255'],
            'ubicacion' => ['nullable', 'string', 'max:255'],
            'estado' => ['sometimes', Rule::enum(EstadoBien::class)],
            'fecha_registro' => ['sometimes', 'date'],
        ]);

        // Si se cambió la dependencia, actualizar responsable según dependencia
        // El responsable es gestionado por la dependencia; sólo actualizamos los campos del bien.
        $bien->update($validated);

        return redirect()
            ->route('bienes.index')
            ->with('success', 'Bien actualizado correctamente.');
    }

    /**
     * Eliminar un bien.
     */
    public function destroy(Bien $bien)
    {
        // Verificar permisos: solo administradores pueden eliminar datos
        if (! auth()->user()->canDeleteData()) {
            if (request()->expectsJson()) {
                return response()->json(['message' => 'No tienes permisos para eliminar datos del sistema.'], 403);
            }

            abort(403, 'No tienes permisos para eliminar datos del sistema.');
        }

        $bien->delete();

        return redirect()
            ->route('bienes.index')
            ->with('success', 'Bien eliminado correctamente.');
    }

}
