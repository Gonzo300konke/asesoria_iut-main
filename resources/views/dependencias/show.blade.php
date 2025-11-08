@extends('layouts.base')

@section('title', 'Detalles de la Dependencia')

@section('content')
@php
use Illuminate\Support\Str;
@endphp
<div class="max-w-3xl mx-auto">
    <div class="bg-white shadow rounded-lg p-6">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Dependencia: {{ $dependencia->codigo }} — {{ $dependencia->nombre }}</h1>
            <div class="space-x-2">
                @include('components.action-buttons', [
                    'resource' => 'dependencias',
                    'model' => $dependencia,
                    'confirm' => "¿Seguro que deseas eliminar esta dependencia?",
                    'label' => $dependencia->nombre
                ])
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div class="border border-gray-200 rounded-lg p-4">
                <h2 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">Información</h2>

                <div class="space-y-3">
                    <div>
                        <p class="text-sm text-gray-600">Código</p>
                        <p class="text-base font-medium text-gray-800">{{ $dependencia->codigo }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-600">Nombre</p>
                        <p class="text-base font-medium text-gray-800">{{ $dependencia->nombre }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-600">Unidad Administradora</p>
                        <p class="text-base font-medium text-gray-800">{{ $dependencia->unidadAdministradora->nombre ?? '—' }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-600">Responsable</p>
                        <p class="text-base font-medium text-gray-800">{{ $dependencia->responsable->nombre_completo ?? 'Sin asignar' }}</p>
                    </div>
                </div>
            </div>

            <div class="border border-gray-200 rounded-lg p-4">
                <h2 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">Bienes</h2>

                <div class="space-y-3">
                    <div>
                        <p class="text-sm text-gray-600">Total de Bienes</p>
                        <p class="text-base font-medium text-gray-800">{{ $dependencia->bienes->count() }}</p>
                    </div>

                    @if($dependencia->bienes->isNotEmpty())
                        <div>
                            <p class="text-sm text-gray-600">Ejemplos</p>
                            <ul class="list-disc list-inside text-sm text-gray-800">
                                @foreach($dependencia->bienes->take(5) as $b)
                                    <li>{{ $b->codigo }} — {{ Str::limit($b->descripcion, 60) }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
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
