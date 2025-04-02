@extends('layouts.app')

@section('title', $property->title)

@section('header', 'Detalle de propiedad')

@section('content')
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <!-- Imágenes -->
        <div class="property-gallery">
            @if($property->images->count() > 0)
                    <div class="main-image-container mb-3">
                        @php
                            $firstImage = $property->images->first();
                            $imagePath = $firstImage->path;
                            $isExternalUrl = \Illuminate\Support\Str::startsWith($imagePath, ['http://', 'https://']);
                            $imageUrl = $isExternalUrl ? $imagePath : asset('storage/' . $imagePath);
                        @endphp
                        <img id="main-property-image" src="{{ $imageUrl }}" alt="{{ $property->title }}"
                            class="w-full h-96 object-cover object-center rounded">
                    </div>

                    @if($property->images->count() > 1)
                        <div class="thumbnails-container flex flex-wrap gap-2 mb-4">
                            @foreach($property->images as $index => $image)
                                @php
                                    $imagePath = $image->path;
                                    $isExternalUrl = \Illuminate\Support\Str::startsWith($imagePath, ['http://', 'https://']);
                                    $imageUrl = $isExternalUrl ? $imagePath : asset('storage/' . $imagePath);
                                @endphp
                                <div class="thumbnail cursor-pointer {{ $index === 0 ? 'ring-2 ring-blue-500' : '' }}"
                                    data-full-image="{{ $imageUrl }}">
                                    <img src="{{ $imageUrl }}" alt="{{ $property->title }} - Imagen {{ $index + 1 }}"
                                        class="w-20 h-20 object-cover rounded">
                                </div>
                            @endforeach
                        </div>
                    @endif
            @else
                <div class="w-full h-96 bg-gray-300 flex items-center justify-center rounded">
                    <span class="text-gray-500">Sin imagen</span>
                </div>
            @endif
            <div class="absolute top-4 right-4 bg-blue-600 text-white px-3 py-1 rounded-full text-sm font-bold z-10">
                {{ $property->for_sale ? 'Venta' : '' }}
                {{ $property->for_sale && $property->for_rent ? ' / ' : '' }}
                {{ $property->for_rent ? 'Alquiler' : '' }}
            </div>
        </div>

        <!-- Información principal -->
        <div class="p-6">
            <div class="flex justify-between items-start">
                <div>
                    <h1 class="text-3xl font-bold mb-2">{{ $property->title }}</h1>
                    <p class="text-gray-600 mb-4">{{ $property->address }}, {{ $property->city }},
                        {{ $property->postal_code }}
                    </p>
                </div>
                <div class="text-right">
                    <div class="text-3xl font-bold text-blue-600">{{ number_format($property->price) }} €</div>
                    @if($property->for_rent)
                        <span class="text-gray-500">/mes</span>
                    @endif
                </div>
            </div>

            <!-- Características principales -->
            <div class="grid grid-cols-3 gap-4 py-4 border-t border-b my-4">
                <div class="text-center">
                    <div class="text-xl font-bold">{{ $property->bedrooms }}</div>
                    <div class="text-gray-500">Habitaciones</div>
                </div>
                <div class="text-center">
                    <div class="text-xl font-bold">{{ $property->bathrooms }}</div>
                    <div class="text-gray-500">Baños</div>
                </div>
                <div class="text-center">
                    <div class="text-xl font-bold">{{ $property->square_meters }}</div>
                    <div class="text-gray-500">m²</div>
                </div>
            </div>

            <!-- Descripción -->
            <h2 class="text-xl font-bold mb-3">Descripción</h2>
            <div class="mb-6 whitespace-pre-line">
                {{ $property->description }}
            </div>

            <!-- Características -->
            @if($property->features->count() > 0)
                <h2 class="text-xl font-bold mb-3">Características</h2>
                <div class="mb-6 grid grid-cols-2 md:grid-cols-3 gap-2">
                    @foreach($property->features as $feature)
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span>{{ $feature->name }}</span>
                        </div>
                    @endforeach
                </div>
            @endif

            <!-- Contacto -->
            <h2 class="text-xl font-bold mb-3">Contactar con el propietario</h2>
            <div class="bg-gray-100 p-4 rounded-lg mb-6">
                <div class="flex items-center mb-3">
                    <div class="mr-3 bg-blue-600 text-white w-10 h-10 rounded-full flex items-center justify-center">
                        {{ strtoupper(substr($property->user->name, 0, 1)) }}
                    </div>
                    <div>
                        <div class="font-bold">{{ $property->user->name }}</div>
                        <div class="text-sm text-gray-600">Propietario</div>
                    </div>
                </div>
                <a href="mailto:{{ $property->user->email }}"
                    class="block w-full bg-blue-600 text-white text-center py-2 rounded hover:bg-blue-700">
                    Contactar
                </a>
            </div>

            <!-- Acciones para el propietario o admin -->
            @can('update', $property)
                <div class="flex space-x-2 mb-6">
                    <a href="{{ route('properties.edit', $property) }}"
                        class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">
                        Editar propiedad
                    </a>
                    <form action="{{ route('properties.destroy', $property) }}" method="POST"
                        onsubmit="return confirm('¿Estás seguro de que quieres eliminar esta propiedad?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                            Eliminar
                        </button>
                    </form>
                </div>
            @endcan
        </div>

        <!-- Valoraciones -->
        <div class="p-6 bg-gray-50">
            <h2 class="text-2xl font-bold mb-4">Valoraciones</h2>

            @if($property->ratings->count() > 0)
                <div class="mb-6">
                    <div class="flex items-center mb-2">
                        <div class="text-xl font-bold mr-2">
                            {{ number_format($property->ratings->avg('rating'), 1) }}
                        </div>
                        <div class="flex text-yellow-500">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= round($property->ratings->avg('rating')))
                                    <span>★</span>
                                @else
                                    <span class="text-gray-300">★</span>
                                @endif
                            @endfor
                        </div>
                        <span class="ml-2 text-gray-600">({{ $property->ratings->count() }} valoraciones)</span>
                    </div>
                </div>

                <div class="space-y-4">
                    @foreach($property->ratings as $rating)
                        <div class="bg-white p-4 rounded-lg shadow-sm">
                            <div class="flex justify-between items-center mb-2">
                                <div class="font-bold">{{ $rating->user->name }}</div>
                                <div class="text-gray-500 text-sm">{{ $rating->created_at->format('d/m/Y') }}</div>
                            </div>
                            <div class="flex text-yellow-500 mb-2">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $rating->rating)
                                        <span>★</span>
                                    @else
                                        <span class="text-gray-300">★</span>
                                    @endif
                                @endfor
                            </div>
                            @if($rating->comment)
                                <p>{{ $rating->comment }}</p>
                            @endif

                            @can('delete', $rating)
                                <form action="{{ route('property.ratings.destroy', $rating) }}" method="POST" class="mt-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 text-sm hover:underline">
                                        Eliminar valoración
                                    </button>
                                </form>
                            @endcan
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-600 mb-4">Esta propiedad aún no tiene valoraciones.</p>
            @endif

            @auth
                @if(auth()->id() !== $property->user_id)
                    @include('components.rating-form', ['property' => $property])
                @endif
            @else
                <div class="bg-blue-50 p-4 rounded-lg">
                    <p>Debes <a href="{{ route('login') }}" class="text-blue-600 hover:underline">iniciar sesión</a> para dejar
                        una valoración.</p>
                </div>
            @endauth
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Obtener referencia a la imagen principal
            const mainImage = document.getElementById('main-property-image');

            // Obtener todas las miniaturas
            const thumbnails = document.querySelectorAll('.thumbnail');

            // Añadir evento click a cada miniatura
            thumbnails.forEach(thumbnail => {
                thumbnail.addEventListener('click', function () {
                    // Cambiar la imagen principal
                    const fullImageUrl = this.getAttribute('data-full-image');
                    mainImage.src = fullImageUrl;

                    // Actualizar clase activa
                    thumbnails.forEach(t => t.classList.remove('active', 'ring-2', 'ring-blue-500'));
                    this.classList.add('active', 'ring-2', 'ring-blue-500');
                });
            });
        });
    </script>
@endpush
