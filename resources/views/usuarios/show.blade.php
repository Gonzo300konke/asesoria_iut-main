@extends('layouts.base')

@section('title', 'Detalles del Usuario')

@section('content')
<div class="max-w-2xl mx-auto">
    @if (session('success'))
        <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded">
            <div class="flex items-center">
                <span class="text-2xl mr-3">✓</span>
                <div>
                    <p class="font-bold">¡Éxito!</p>
                    <p class="text-sm">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    <div class="bg-white shadow rounded-lg p-6">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-bold text-gray-800">{{ $usuario->nombre_completo }}</h1>
            <div class="space-x-2">
                <a href="{{ route('usuarios.edit', $usuario->id) }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 inline-block">
                    Editar
                </a>
                <a href="{{ route('usuarios.index') }}" class="bg-gray-300 text-gray-800 px-4 py-2 rounded-lg hover:bg-gray-400 inline-block">
                    Volver a Usuarios
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <!-- Información Personal -->
            <div class="border border-gray-200 rounded-lg p-4">
                <h2 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">Información Personal</h2>
                
                <div class="space-y-3">
                    <div>
                        <p class="text-sm text-gray-600">Nombre</p>
                        <p class="text-base font-medium text-gray-800">{{ $usuario->nombre }}</p>
                    </div>
                    
                    <div>
                        <p class="text-sm text-gray-600">Apellido</p>
                        <p class="text-base font-medium text-gray-800">{{ $usuario->apellido }}</p>
                    </div>
                    
                    <div>
                        <p class="text-sm text-gray-600">Cédula</p>
                        <p class="text-base font-medium text-gray-800">{{ $usuario->cedula }}</p>
                    </div>
                    
                    <div>
                        <p class="text-sm text-gray-600">Correo</p>
                        <p class="text-base font-medium text-gray-800 break-all">{{ $usuario->correo }}</p>
                    </div>
                </div>
            </div>

            <!-- Información del Sistema -->
            <div class="border border-gray-200 rounded-lg p-4">
                <h2 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">Información del Sistema</h2>
                
                <div class="space-y-3">
                    <div>
                        <p class="text-sm text-gray-600">Rol</p>
                        <div class="mt-1">
                            <span class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">
                                {{ $usuario->rol->nombre ?? 'Sin asignar' }}
                            </span>
                        </div>
                    </div>
                    
                    <div>
                        <p class="text-sm text-gray-600">Estado</p>
                        <div class="mt-1">
                            @if($usuario->activo)
                                <span class="inline-block bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">
                                    ✓ Activo
                                </span>
                            @else
                                <span class="inline-block bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-medium">
                                    ✗ Inactivo
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    @if($usuario->is_admin)
                        <div>
                            <p class="text-sm text-gray-600">Permisos</p>
                            <div class="mt-1">
                                <span class="inline-block bg-purple-100 text-purple-800 px-3 py-1 rounded-full text-sm font-medium">
                                    👑 Administrador
                                </span>
                            </div>
                        </div>
                    @endif
                    
                    <div>
                        <p class="text-sm text-gray-600">Fecha de Creación</p>
                        <p class="text-base font-medium text-gray-800">
                            {{ $usuario->created_at->format('d/m/Y H:i') }}
                        </p>
                    </div>
                    
                    <div>
                        <p class="text-sm text-gray-600">Última Actualización</p>
                        <p class="text-base font-medium text-gray-800">
                            {{ $usuario->updated_at->format('d/m/Y H:i') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Resumen de Cambios (si viene de una edición) -->
        @if (session('success'))
            <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                <h2 class="text-lg font-semibold text-green-800 mb-3">Cambios Realizados</h2>
                <p class="text-sm text-green-700">
                    El usuario <strong>{{ $usuario->nombre_completo }}</strong> ha sido actualizado correctamente.
                    Todos los cambios se han guardado en la base de datos.
                </p>
            </div>
        @endif

        <!-- Estadísticas -->
        @if($usuario->reportes->count() > 0 || $usuario->movimientos->count() > 0)
            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <p class="text-sm text-blue-600 font-medium">Reportes Generados</p>
                    <p class="text-3xl font-bold text-blue-800">{{ $usuario->reportes->count() }}</p>
                </div>
                
                <div class="bg-indigo-50 border border-indigo-200 rounded-lg p-4">
                    <p class="text-sm text-indigo-600 font-medium">Movimientos Registrados</p>
                    <p class="text-3xl font-bold text-indigo-800">{{ $usuario->movimientos->count() }}</p>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
