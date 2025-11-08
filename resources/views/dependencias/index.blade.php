@extends('layouts.base')

@section('title', 'Dependencias')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-bold text-gray-800">🔗 Dependencias</h1>
    <a href="{{ route('dependencias.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
        + Nueva
    </a>
</div>

@if(session('success'))
    <div class="mb-4 p-4 bg-green-100 border border-green-300 text-green-800 rounded">
        {{ session('success') }}
    </div>
@endif

        {{-- Tabla --}}
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Código</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nombre</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Unidad Administradora</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Bienes</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($dependencias as $dep)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 text-sm text-gray-900 font-mono">{{ $dep->codigo }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $dep->nombre }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    {{ $dep->unidadAdministradora->nombre ?? '-' }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    @if($dep->bienes->count())
                                        <span class="px-2 py-1 bg-blue-100 text-blue-700 rounded-full text-xs">
                                            {{ $dep->bienes->count() }} bienes
                                        </span>
                                    @else
                                        <span class="text-gray-400">—</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm text-right space-x-2">
                                    <a href="{{ route('dependencias.show', $dep) }}"
                                       class="inline-flex items-center px-2 py-1 text-xs font-medium text-blue-600 bg-blue-50 rounded hover:bg-blue-100">
                                        <x-heroicon-o-eye class="w-4 h-4 mr-1"/> Ver
                                    </a>
                                    <a href="{{ route('dependencias.edit', $dep) }}"
                                       class="inline-flex items-center px-2 py-1 text-xs font-medium text-yellow-600 bg-yellow-50 rounded hover:bg-yellow-100">
                                        <x-heroicon-o-pencil-square class="w-4 h-4 mr-1"/> Editar
                                    </a>
                                    <form action="{{ route('dependencias.destroy', $dep) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                onclick="return confirm('¿Seguro que deseas eliminar esta dependencia?')"
                                                class="inline-flex items-center px-2 py-1 text-xs font-medium text-red-600 bg-red-50 rounded hover:bg-red-100">
                                            <x-heroicon-o-trash class="w-4 h-4 mr-1"/> Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">
                                    No hay dependencias registradas.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

@if($dependencias->hasPages())
    <div class="mt-6">
        {{ $dependencias->links() }}
    </div>
@endif
@endsection

