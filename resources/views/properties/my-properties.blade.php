@extends('layouts.app')

@section('title', 'Mis propiedades')

@section('header', 'Mis propiedades')

@section('content')
    <div class="mb-6 flex justify-between items-center">
        <h1 class="text-2xl font-bold">Mis propiedades</h1>
        <a href="{{ route('properties.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            Nueva propiedad
        </a>
    </div>

    @if($properties->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($properties as $property)
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <div class="relative h-48">
                        @if($property->images->count() > 0)
                            <img src="{{ asset('storage/' . $property->images->firstWhere('is_main', true)?->path ?? $property->images->first()->path) }}"
                                alt="{{ $property->title }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-gray-300 flex items-center justify-center">
                                <span class="text-gray-500">Sin imagen</span>
                            </div>
                        @endif
                        <div class="absolute top-0 right-0 bg-blue-600 text-white px-2 py-1 text-sm font-bold">
                            {{ $property->for_sale ? 'Venta' : '' }}
                            {{ $property->for_sale && $property->for_rent ? ' / ' : '' }}
                            {{ $property->for_rent ? 'Alquiler' : '' }}
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-lg mb-2">{{ $property->title }}</h3>
                        <p class="text-gray-600 mb-2">{{ $property->city }}, {{ $property->postal_code }}</p>
                        <div class="flex justify-between text-sm mb-2">
                            <span>{{ $property->bedrooms }} hab.</span>
                            <span>{{ $property->bathrooms }} baños</span>
                            <span>{{ $property->square_meters }} m²</span>
                        </div>
                        <div class="flex justify-between items-center mt-3">
                            <span class="font-bold text-xl">{{ number_format($property->price) }}€</span>
                            <span
                                class="text-sm font-medium px-2 py-1 rounded {{ $property->status == 'available' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ ucfirst($property->status) }}
                            </span>
                        </div>

                        <div class="mt-4 flex justify-between">
                            <a href="{{ route('properties.show', $property) }}" class="text-blue-600 hover:underline">Ver
                                detalles</a>

                            <div>
                                <a href="{{ route('properties.edit', $property) }}"
                                    class="text-yellow-600 hover:underline mr-3">Editar</a>

                                <form action="{{ route('properties.destroy', $property) }}" method="POST" class="inline"
                                    onsubmit="return confirm('¿Estás seguro de que quieres eliminar esta propiedad?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">
                                        Eliminar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $properties->links() }}
        </div>
    @else
        <div class="bg-white p-6 rounded-lg shadow text-center">
            <p class="text-gray-600 mb-4">Aún no tienes propiedades.</p>
            <a href="{{ route('properties.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                Crear mi primera propiedad
            </a>
        </div>
    @endif
@endsection
