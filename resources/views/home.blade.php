@extends('layouts.app')

@section('title', 'Inicio')

@section('header', 'Inicio')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-md mb-6">
        <h1 class="text-3xl font-bold mb-4">¡Encuentra tu nuevo hogar!</h1>
        <p class="mb-4">Explora nuestra selección de propiedades en venta y alquiler.</p>

        <div class="flex flex-col sm:flex-row gap-4 mt-6">
            <a href="{{ route('properties.index') }}?type=sale"
                class="bg-blue-600 text-white py-3 px-6 rounded-lg text-center hover:bg-blue-700 transition">
                Ver propiedades en venta
            </a>
            <a href="{{ route('properties.index') }}?type=rent"
                class="bg-green-600 text-white py-3 px-6 rounded-lg text-center hover:bg-green-700 transition">
                Ver propiedades en alquiler
            </a>
        </div>
    </div>

    @if($featuredProperties->count() > 0)
        <h2 class="text-2xl font-bold mb-6">Propiedades destacadas</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($featuredProperties as $property)
                @include('components.property-card', ['property' => $property])
            @endforeach
        </div>

        <div class="mt-8 text-center">
            <a href="{{ route('properties.index') }}"
                class="inline-block bg-gray-800 text-white py-2 px-4 rounded hover:bg-gray-700">
                Ver todas las propiedades
            </a>
        </div>
    @endif
@endsection
