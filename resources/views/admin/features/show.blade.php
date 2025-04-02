@extends('layouts.admin')

@section('header', 'Detalle de característica')

@section('content')
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="mb-6 flex justify-between items-center">
            <h1 class="text-2xl font-bold">{{ $feature->name }}</h1>
            <div class="flex space-x-2">
                <a href="{{ route('admin.features.edit', $feature) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white py-2 px-4 rounded">
                    Editar
                </a>
                <form action="{{ route('admin.features.destroy', $feature) }}" method="POST" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded"
                            onclick="return confirm('¿Estás seguro de que quieres eliminar esta característica?')">
                        Eliminar
                    </button>
                </form>
            </div>
        </div>

        <div class="bg-gray-100 p-4 rounded-lg mb-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <h3 class="text-sm font-medium text-gray-500">Nombre</h3>
                    <p class="mt-1">{{ $feature->name }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-medium text-gray-500">Fecha de creación</h3>
                    <p class="mt-1">{{ $feature->created_at->format('d/m/Y H:i') }}</p>
                </div>
            </div>
            @if($feature->description)
                <div class="mt-4">
                    <h3 class="text-sm font-medium text-gray-500">Descripción</h3>
                    <p class="mt-1">{{ $feature->description }}</p>
                </div>
            @endif
        </div>

        <div class="mt-8">
            <h2 class="text-xl font-bold mb-4">Propiedades que incluyen esta característica</h2>
            
            @if($feature->properties->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($feature->properties as $property)
                        <div class="border rounded-lg overflow-hidden">
                            <div class="h-40 bg-gray-200 relative">
                                @if($property->images->count() > 0)
                                    <img src="{{ asset('storage/' . $property->images->firstWhere('is_main', true)?->path ?? $property->images->first()->path) }}" 
                                         alt="{{ $property->title }}" 
                                         class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <span class="text-gray-500">Sin imagen</span>
                                    </div>
                                @endif
                            </div>
                            <div class="p-4">
                                <h3 class="font-bold">{{ $property->title }}</h3>
                                <p class="text-gray-600 text-sm">{{ $property->city }}, {{ $property->postal_code }}</p>
                                <div class="mt-2 flex justify-between items-center">
                                    <span class="font-bold">{{ number_format($property->price) }} €</span>
                                    <a href="{{ route('properties.show', $property) }}" class="text-blue-600 hover:underline text-sm">
                                        Ver detalle
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4">
                    <div class="flex">
                        <div>
                            <p class="text-sm text-yellow-700">
                                Esta característica no está asociada a ninguna propiedad actualmente.
                            </p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
