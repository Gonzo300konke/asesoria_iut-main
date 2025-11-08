<?php

namespace App\Http\Controllers;

use App\Models\Bien;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Enums\EstadoBien;

class BienController extends Controller
{
    /**
     * Listar todos los bienes.
     */
  // BienController.php
public function index()
{
    // Incluimos relaciones para evitar N+1
    $bienes = Bien::with(['dependencia', 'responsable', 'movimientos'])->paginate(10);

    return view('bienes.index', compact('bienes')); // Only passes $bienes
}

    /**
     * Mostrar formulario de creación.
     */
    public function create()
    {
        $dependencias = \App\Models\Dependencia::all();
        $responsables = \App\Models\Responsable::all();
        return view('bienes.create', compact('dependencias', 'responsables'));
    }

    /**
     * Guardar un nuevo bien.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'dependencia_id' => ['required', 'exists:dependencias,id'],
            'responsable_id' => ['required', 'exists:responsables,id'],
            'codigo'         => ['required', 'string', 'max:50', 'unique:bienes,codigo'],
            'descripcion'    => ['required', 'string', 'max:255'],
            'ubicacion'      => ['nullable', 'string', 'max:255'],
            'estado'         => ['required', Rule::enum(EstadoBien::class)],
            'fecha_registro' => ['required', 'date'],
        ]);

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
        $bien->load(['dependencia', 'responsable', 'movimientos']);

        return view('bienes.show', compact('bien'));
    }

    /**
     * Mostrar formulario de edición.
     */
    public function edit(Bien $bien)
    {
        return view('bienes.edit', compact('bien'));
    }

    /**
     * Actualizar un bien.
     */
    public function update(Request $request, Bien $bien)
    {
        $validated = $request->validate([
            'dependencia_id' => ['sometimes', 'exists:dependencias,id'],
            'responsable_id' => ['sometimes', 'exists:responsables,id'],
            'codigo'         => [
                'sometimes',
                'string',
                'max:50',
                Rule::unique('bienes', 'codigo')->ignore($bien->id),
            ],
            'descripcion'    => ['sometimes', 'string', 'max:255'],
            'ubicacion'      => ['nullable', 'string', 'max:255'],
            'estado'         => ['sometimes', Rule::enum(EstadoBien::class)],
            'fecha_registro' => ['sometimes', 'date'],
        ]);

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
        $bien->delete();

        return redirect()
            ->route('bienes.index')
            ->with('success', 'Bien eliminado correctamente.');
    }
}


