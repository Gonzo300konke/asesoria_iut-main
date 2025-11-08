@extends('layouts.base')

@section('title', 'Crear Bien')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white shadow rounded-lg p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Registrar Nuevo Bien</h1>

            <form action="{{ route('bienes.store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Dependencia -->
                <div>
                    <label for="dependencia_id" class="block text-sm font-semibold text-gray-700 mb-2">Dependencia</label>
                    <select name="dependencia_id" id="dependencia_id"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                        <option value="">Seleccione...</option>
                        @foreach($dependencias as $dep)
                            <option value="{{ $dep->id }}" {{ old('dependencia_id') == $dep->id ? 'selected' : '' }}>
                                {{ $dep->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('dependencia_id')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Responsable -->
                <div>
                    <label for="responsable_id" class="block text-sm font-semibold text-gray-700 mb-2">Responsable</label>
                    <select name="responsable_id" id="responsable_id"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                        <option value="">Seleccione...</option>
                        @foreach($responsables as $resp)
                            <option value="{{ $resp->id }}" {{ old('responsable_id') == $resp->id ? 'selected' : '' }}>
                                {{ $resp->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('responsable_id')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Código -->
                <div>
                    <label for="codigo" class="block text-sm font-semibold text-gray-700 mb-2">Código</label>
                    <input type="text" name="codigo" id="codigo" value="{{ old('codigo') }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                           placeholder="Ej: BN-001">
                    @error('codigo')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Descripción -->
                <div>
                    <label for="descripcion" class="block text-sm font-semibold text-gray-700 mb-2">Descripción</label>
                    <textarea name="descripcion" id="descripcion" rows="3"
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                              placeholder="Describe el bien...">{{ old('descripcion') }}</textarea>
                    @error('descripcion')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Ubicación -->
                <div>
                    <label for="ubicacion" class="block text-sm font-semibold text-gray-700 mb-2">Ubicación</label>
                    <input type="text" name="ubicacion" id="ubicacion" value="{{ old('ubicacion') }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                           placeholder="Oficina 101">
                    @error('ubicacion')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Estado -->
                <div>
                    <label for="estado" class="block text-sm font-semibold text-gray-700 mb-2">Estado</label>
                    <select name="estado" id="estado"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                        <option value="">Seleccione...</option>
                        @foreach(\App\Enums\EstadoBien::cases() as $estado)
                            <option value="{{ $estado->value }}" {{ old('estado') == $estado->value ? 'selected' : '' }}>
                                {{ ucfirst($estado->name) }}
                            </option>
                        @endforeach
                    </select>
                    @error('estado')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Fecha de registro -->
                <div>
                    <label for="fecha_registro" class="block text-sm font-semibold text-gray-700 mb-2">
                        📅 Fecha de Registro
                    </label>
                    <div class="relative">
                        <input type="date" name="fecha_registro" id="fecha_registro" value="{{ old('fecha_registro', now()->format('Y-m-d')) }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                               style="font-size: 16px;">
                        <span class="absolute right-3 top-3 text-gray-400 pointer-events-none">
                            📆
                        </span>
                    </div>
                    @error('fecha_registro')
                        <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                    @enderror
                    <p class="text-gray-500 text-xs mt-2">Selecciona la fecha en la que se registró el bien</p>
                </div>

                <!-- Botones -->
                <div class="flex justify-end gap-4 pt-6 border-t border-gray-200">
                    <a href="{{ route('bienes.index') }}"
                       class="px-6 py-3 bg-gray-300 text-gray-800 font-semibold rounded-lg hover:bg-gray-400 transition duration-200">
                        ✗ Cancelar
                    </a>
                    <button type="submit"
                            class="px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-lg hover:shadow-lg transition duration-200">
                        ✓ Guardar Bien
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

