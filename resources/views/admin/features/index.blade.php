@extends('layouts.admin')

@section('header', 'Gestión de características')

@section('content')
    <div class="card">
        <div class="card-header flex justify-between items-center">
            <h2 class="text-xl font-bold">Características</h2>
            <a href="{{ route('admin.features.create') }}" class="btn-primary">
                Añadir característica
            </a>
        </div>
        <div class="card-body">
            @if($features->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nombre</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Descripción</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Propiedades asociadas</th>
                                <th scope="col"
                                    class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($features as $feature)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $feature->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $feature->name }}</td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900 line-clamp-2">
                                            {{ $feature->description ?: 'Sin descripción' }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $feature->properties->count() }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                                        <!-- Eliminado el enlace a "Ver" ya que no existe el método show -->
                                        <a href="{{ route('admin.features.edit', $feature) }}"
                                            class="text-yellow-600 hover:text-yellow-900">Editar</a>
                                        <form action="{{ route('admin.features.destroy', $feature) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900"
                                                onclick="return confirm('¿Estás seguro de eliminar esta característica?')">
                                                Eliminar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            @else
                <div class="py-8 text-center">
                    <p class="text-gray-500">No hay características registradas.</p>
                    <a href="{{ route('admin.features.create') }}" class="mt-4 btn-primary inline-block">
                        Crear primera característica
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection
