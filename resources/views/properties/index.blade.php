@extends('layouts.app')

@section('title', 'Propiedades')

@section('header', 'Propiedades disponibles')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow mb-6">
        <form action="{{ route('properties.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label for="type" class="block mb-2 text-sm font-medium">Tipo</label>
                <select name="type" id="type" class="w-full border-gray-300 rounded-md shadow-sm">
                    <option value="">Todos</option>
                    <option value="sale" {{ request('type') === 'sale' ? 'selected' : '' }}>Venta</option>
                    <option value="rent" {{ request('type') === 'rent' ? 'selected' : '' }}>Alquiler</option>
                </select>
            </div>

            <div>
                <label for="bedrooms" class="block mb-2 text-sm font-medium">Habitaciones</label>
                <select name="bedrooms" id="bedrooms" class="w-full border-gray-300 rounded-md shadow-sm">
                    <option value="">Todas</option>
                    <option value="1" {{ request('bedrooms') === '1' ? 'selected' : '' }}>1+</option>
                    <option value="2" {{ request('bedrooms') === '2' ? 'selected' : '' }}>2+</option>
                    <option value="3" {{ request('bedrooms') === '3' ? 'selected' : '' }}>3+</option>
                    <option value="4" {{ request('bedrooms') === '4' ? 'selected' : '' }}>4+</option>
                </select>
            </div>

            <div>
                <label for="price_min" class="block mb-2 text-sm font-medium">Precio mínimo</label>
                <input type="number" name="price_min" id="price_min" value="{{ request('price_min') }}"
                    class="w-full border-gray-300 rounded-md shadow-sm" placeholder="Mín. €">
            </div>

            <div>
                <label for="price_max" class="block mb-2 text-sm font-medium">Precio máximo</label>
                <input type="number" name="price_max" id="price_max" value="{{ request('price_max') }}"
                    class="w-full border-gray-300 rounded-md shadow-sm" placeholder="Máx. €">
            </div>

            <div class="md:col-span-4 flex justify-end">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Buscar
                </button>
            </div>
        </form>
    </div>

    @if($properties->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
            @foreach($properties as $property)
                @include('components.property-card', ['property' => $property])
            @endforeach
        </div>

        <div class="mt-4">
            {{ $properties->withQueryString()->links() }}
        </div>
    @else
        <div class="bg-white p-6 rounded-lg shadow text-center">
            <p class="text-gray-600">No se encontraron propiedades con los criterios seleccionados.</p>
        </div>
    @endif
@endsection
