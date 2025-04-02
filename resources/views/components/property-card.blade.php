<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="relative h-48">
        @if($property->images->count() > 0)
                @php
                    $imagePath = $property->images->firstWhere('is_main', true)?->path ?? $property->images->first()->path;
                    // Comprobar si la ruta es una URL externa
                    $isExternalUrl = Str::startsWith($imagePath, ['http://', 'https://']);
                    $imageUrl = $isExternalUrl ? $imagePath : asset('storage/' . $imagePath);
                @endphp
                <img src="{{ $imageUrl }}"
                    alt="Imagen de {{ $property->title }} - {{ $property->bedrooms }} hab, {{ $property->square_meters }}m²"
                    class="w-full h-full object-cover">
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
        @if(isset($property->property_type))
            <div class="absolute bottom-0 left-0 bg-gray-800 bg-opacity-75 text-white px-2 py-1 text-xs">
                {{ \App\Enums\PropertyTypeEnum::label($property->property_type) }}
            </div>
        @endif
    </div>
    <div class="p-4">
        <h3 class="font-bold text-lg mb-2 truncate" title="{{ $property->title }}">{{ $property->title }}</h3>
        <p class="text-gray-600 mb-2 truncate">{{ $property->city }}, {{ $property->postal_code }}</p>
        <div class="flex justify-between text-sm mb-2">
            <span>{{ $property->bedrooms }} hab.</span>
            <span>{{ $property->bathrooms }} baños</span>
            <span>{{ $property->square_meters }} m²</span>
        </div>
        <div class="flex justify-between items-center mt-3">
            <div>
                @if($property->for_sale)
                    <span class="font-bold text-xl">{{ number_format($property->price) }}€</span>
                    @if($property->for_rent)
                        <br>
                        <span
                            class="text-sm text-gray-600">{{ number_format($property->rent_price ?? $property->price) }}€/mes</span>
                    @endif
                @else
                    <span
                        class="font-bold text-xl">{{ number_format($property->rent_price ?? $property->price) }}€/mes</span>
                @endif
            </div>
            <a href="{{ route('properties.show', $property) }}"
                class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700">Ver detalles</a>
        </div>
    </div>
</div>
