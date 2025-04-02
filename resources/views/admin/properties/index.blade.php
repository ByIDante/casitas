@extends('layouts.admin')

@section('header', 'Gestión de propiedades')

@section('content')
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="p-6 border-b border-gray-200 flex justify-between items-center">
            <h2 class="text-xl font-bold">Propiedades</h2>
            <a href="{{ route('properties.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                Nueva propiedad
            </a>
        </div>

        <!-- Filtros -->
        <div class="p-6 border-b border-gray-200">
            <form action="{{ route('admin.properties.index') }}" method="GET" class="flex flex-col md:flex-row gap-4">
                <div class="flex-1">
                    <input type="text" name="search" placeholder="Buscar por título o ubicación"
                        value="{{ request('search') }}" class="w-full border-gray-300 rounded-md shadow-sm">
                </div>
                <div>
                    <select name="status" class="w-full border-gray-300 rounded-md shadow-sm">
                        <option value="">Todos los estados</option>
                        @foreach(\App\Enums\PropertyStatusEnum::cases() as $status)
                            <option value="{{ $status->value }}" {{ request('status') == $status->value ? 'selected' : '' }}>
                                {{ ucfirst($status->value) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <button type="submit" class="w-full px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        Filtrar
                    </button>
                </div>
            </form>
        </div>

        <!-- Listado -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Imagen
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Título
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Propietario</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Precio
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($properties as $property)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $property->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($property->images->count() > 0)
                                    <img src="{{ asset('storage/' . $property->images->firstWhere('is_main', true)?->path ?? $property->images->first()->path) }}"
                                        alt="{{ $property->title }}" class="w-16 h-12 object-cover rounded">
                                @else
                                    <div class="w-16 h-12 bg-gray-300 flex items-center justify-center rounded">
                                        <span class="text-xs text-gray-500">Sin imagen</span>
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="font-medium text-gray-900">{{ $property->title }}</div>
                                <div class="text-sm text-gray-500">{{ $property->city }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <a href="{{ route('admin.users.edit', $property->user) }}"
                                    class="text-blue-600 hover:underline">
                                    {{ $property->user->name }}
                                </a>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ number_format($property->price) }}€</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            {{ $property->status == 'available' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ ucfirst($property->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm space-x-2">
                                <a href="{{ route('properties.show', $property) }}"
                                    class="text-blue-600 hover:underline">Ver</a>
                                <a href="{{ route('admin.properties.edit', $property) }}"
                                    class="text-yellow-600 hover:underline">Editar</a>
                                <form action="{{ route('admin.properties.destroy', $property) }}" method="POST" class="inline"
                                    onsubmit="return confirm('¿Estás seguro de que quieres eliminar esta propiedad?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Paginación -->
        <div class="p-6">
            {{ $properties->withQueryString()->links() }}
        </div>
    </div>
@endsection
