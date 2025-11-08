@extends('layouts.base')

@section('title', 'Detalles del Bien')

@section('content')
@php
use Illuminate\Support\Str;
@endphp
<div class="max-w-3xl mx-auto">
    <div class="bg-white shadow rounded-lg p-6">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Bien: {{ $bien->codigo }} — {{ Str::limit($bien->descripcion, 80) }}</h1>
            <div class="space-x-2">
                @include('components.action-buttons', [
                    'resource' => 'bienes',
                    'model' => $bien,
                    'confirm' => "¿Seguro que deseas eliminar este bien?",
                    'label' => $bien->codigo
                ])
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div class="border border-gray-200 rounded-lg p-4">
                <h2 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">Información del Bien</h2>

                <div class="space-y-3">
                    <div>
                        <p class="text-sm text-gray-600">Código</p>
                        <p class="text-base font-medium text-gray-800">{{ $bien->codigo }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-600">Descripción</p>
                        <p class="text-base font-medium text-gray-800">{{ $bien->descripcion }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-600">Ubicación</p>
                        <p class="text-base font-medium text-gray-800">{{ $bien->ubicacion ?? '—' }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-600">Estado</p>
                        <p class="text-base font-medium text-gray-800">{{ $bien->estado?->name ?? (string)$bien->estado }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-600">Fecha de Registro</p>
                        <p class="text-base font-medium text-gray-800">{{ $bien->fecha_registro?->format('d/m/Y') }}</p>
                    </div>
                </div>
            </div>

            <div class="border border-gray-200 rounded-lg p-4">
                <h2 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">Dependencia y Responsable</h2>

                <div class="space-y-3">
                    <div>
                        <p class="text-sm text-gray-600">Dependencia</p>
                        <p class="text-base font-medium text-gray-800">{{ $bien->dependencia->nombre ?? '—' }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-600">Responsable (dependencia)</p>
                        <p class="text-base font-medium text-gray-800">{{ $bien->dependencia->responsable->nombre_completo ?? 'Sin asignar' }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-600">Movimientos registrados</p>
                        <p class="text-base font-medium text-gray-800">{{ $bien->movimientos->count() }}</p>
                    </div>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-50 border border-green-200 rounded">
                {{ session('success') }}
            </div>
        @endif
    </div>
</div>
@endsection
