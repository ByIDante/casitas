@extends('layouts.admin')

@section('header', 'Detalle de propiedad')

@section('content')
    <div class="mb-6 flex justify-between items-center">
        <div>
            <a href="{{ route('admin.properties.index') }}" class="text-blue-600 hover:underline flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                        clip-rule="evenodd" />
                </svg>
                Volver a la lista
            </a>
        </div>
        <div class="flex space-x-2">
            <a href="{{ route('admin.properties.edit', $property) }}" class="btn-secondary">
                Editar propiedad
            </a>
            <form action="{{ route('admin.properties.destroy', $property) }}" method="POST"
                onsubmit="return confirm('¿Estás seguro de que quieres eliminar esta propiedad?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-danger">
                    Eliminar propiedad
                </button>
            </form>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Imágenes de la propiedad -->
        <div class="lg:col-span-2">
            <div class="card">
                <div class="card-header">
                    <h2 class="text-xl font-bold">Galería de imágenes</h2>
                </div>
                <div class="card-body p-0">
                    @if($property->images->count() > 0)
                        <div class="property-gallery">
                            <div class="main-image-container">
                                <img src="{{ asset('storage/' . $property->images->firstWhere('is_main', true)?->path ?? $property->images->first()->path) }}"
                                    alt="{{ $property->title }}" class="w-full h-full object-cover">
                            </div>
                            <div class="p-4 grid grid-cols-5 gap-3">
                                @foreach($property->images as $image)
                                    <div class="thumbnail {{ $image->is_main ? 'active' : '' }} h-20">
                                        <img src="{{ asset('storage/' . $image->path) }}" alt="{{ $property->title }}"
                                            class="w-full h-full object-cover">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <div class="p-6 text-center">
                            <p class="text-gray-500">Esta propiedad no tiene imágenes.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Información de la propiedad -->
        <div class="lg:col-span-1">
            <div class="card">
                <div class="card-header">
                    <h2 class="text-xl font-bold">Detalles de la propiedad</h2>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <h1 class="text-2xl font-bold text-gray-900">{{ $property->title }}</h1>
                        <div class="text-xl font-bold text-blue-600 mt-2">{{ number_format($property->price) }} €</div>
                    </div>

                    <div class="py-2 border-t border-b">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-gray-600">Tipo:</span>
                            <span class="font-medium">{{ \App\Enums\PropertyTypeEnum::label($property->type) }}</span>
                        </div>
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-gray-600">Estado:</span>
                            <span
                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            {{ $property->status == 'available' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ ucfirst($property->status) }}
                            </span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Propietario:</span>
                            <a href="{{ route('admin.users.edit', $property->user) }}"
                                class="text-blue-600 hover:underline">
                                {{ $property->user->name }}
                            </a>
                        </div>
                    </div>

                    <div class="py-2 border-b">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-gray-600">Habitaciones:</span>
                            <span class="font-medium">{{ $property->bedrooms }}</span>
                        </div>
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-gray-600">Baños:</span>
                            <span class="font-medium">{{ $property->bathrooms }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Superficie:</span>
                            <span class="font-medium">{{ $property->square_meters }} m²</span>
                        </div>
                    </div>

                    <div class="py-2">
                        <div class="mb-2">
                            <span class="text-gray-600">Dirección:</span>
                            <p class="font-medium">{{ $property->address }}</p>
                        </div>
                        <div class="mb-2">
                            <span class="text-gray-600">Ciudad:</span>
                            <span class="font-medium">{{ $property->city }}</span>
                        </div>
                        <div>
                            <span class="text-gray-600">Código postal:</span>
                            <span class="font-medium">{{ $property->postal_code }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Descripción y características -->
        <div class="lg:col-span-3">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-xl font-bold">Descripción</h3>
                </div>
                <div class="card-body">
                    <p class="text-gray-700">{{ $property->description }}</p>
                </div>
            </div>

            <div class="card mt-6">
                <div class="card-header">
                    <h3 class="text-xl font-bold">Características</h3>
                </div>
                <div class="card-body">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        @foreach($property->features as $feature)
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 mr-2" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span>{{ $feature->name }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
