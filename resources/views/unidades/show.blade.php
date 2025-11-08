@extends('layouts.base')

@section('title', 'Detalles de la Unidad Administradora')

@section('content')
@php
use Illuminate\Support\Str;
@endphp
<div class="max-w-3xl mx-auto">
    <div class="bg-white shadow rounded-lg p-6">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Unidad: {{ $unidadAdministradora->codigo }} — {{ $unidadAdministradora->nombre }}</h1>
            <div class="space-x-2">
                @include('components.action-buttons', [
                    'resource' => 'unidades',
                    'model' => $unidadAdministradora,
                    'confirm' => "¿Seguro que deseas eliminar esta unidad?",
                    'label' => $unidadAdministradora->nombre
                ])
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div class="border border-gray-200 rounded-lg p-4">
                <h2 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">Información</h2>

                <div class="space-y-3">
                    <div>
                        <p class="text-sm text-gray-600">Código</p>
                        <p class="text-base font-medium text-gray-800">{{ $unidadAdministradora->codigo }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-600">Nombre</p>
                        <p class="text-base font-medium text-gray-800">{{ $unidadAdministradora->nombre }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-600">Organismo</p>
                        <p class="text-base font-medium text-gray-800">{{ $unidadAdministradora->organismo->nombre ?? '—' }}</p>
                    </div>
                </div>
            </div>

            <div class="border border-gray-200 rounded-lg p-4">
                <h2 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">Dependencias</h2>

                <div class="space-y-3">
                    <div>
                        <p class="text-sm text-gray-600">Total de Dependencias</p>
                        <p class="text-base font-medium text-gray-800">{{ $unidadAdministradora->dependencias->count() }}</p>
                    </div>

                    @if($unidadAdministradora->dependencias->isNotEmpty())
                        <div>
                            <p class="text-sm text-gray-600">Listado (ejemplos)</p>
                            <ul class="list-disc list-inside text-sm text-gray-800">
                                @foreach($unidadAdministradora->dependencias->take(5) as $d)
                                    <li>{{ $d->codigo }} — {{ Str::limit($d->nombre, 60) }}</li>
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
