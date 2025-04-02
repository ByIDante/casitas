@extends('layouts.app')

@section('title', 'Editar propiedad')

@section('header', 'Editar propiedad')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow">
        <form action="{{ route('properties.update', $property) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Información básica -->
                <div class="md:col-span-2">
                    <h2 class="text-xl font-bold mb-4">Información básica</h2>
                </div>
                
                <div class="md:col-span-2">
                    <label for="title" class="block mb-2 font-medium">Título</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $property->title) }}" class="w-full border-gray-300 rounded-md shadow-sm" required>
                    @error('title')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="md:col-span-2">
                    <label for="description" class="block mb-2 font-medium">Descripción</label>
                    <textarea name="description" id="description" rows="5" class="w-full border-gray-300 rounded-md shadow-sm" required>{{ old('description', $property->description) }}</textarea>
                    @error('description')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                
                <!-- Tipo y precio -->
                <div>
                    <label for="type" class="block mb-2 font-medium">Tipo de propiedad</label>
                    <select name="type" id="type" class="w-full border-gray-300 rounded-md shadow-sm" required>
                        @foreach(\App\Enums\PropertyTypeEnum::getOptions() as $value => $label)
                            <option value="{{ $value }}" {{ old('type', $property->type) == $value ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    @error('type')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                
                <div>
                    <label for="price" class="block mb-2 font-medium">Precio (€)</label>
                    <input type="number" name="price" id="price" value="{{ old('price', $property->price) }}" min="0" step="0.01" class="w-full border-gray-300 rounded-md shadow-sm" required>
                    @error('price')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                
                <div>
                    <div class="flex items-center mb-4">
                        <input type="checkbox" name="for_sale" id="for_sale" value="1" {{ old('for_sale', $property->for_sale) ? 'checked' : '' }} class="rounded border-gray-300 text-blue-600 shadow-sm">
                        <label for="for_sale" class="ml-2">Disponible para venta</label>
                    </div>
                    
                    <div class="flex items-center">
                        <input type="checkbox" name="for_rent" id="for_rent" value="1" {{ old('for_rent', $property->for_rent) ? 'checked' : '' }} class="rounded border-gray-300 text-blue-600 shadow-sm">
                        <label for="for_rent" class="ml-2">Disponible para alquiler</label>
                    </div>
                    
                    @error('for_sale')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                    @error('for_rent')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                
                <div>
                    <label for="status" class="block mb-2 font-medium">Estado</label>
                    <select name="status" id="status" class="w-full border-gray-300 rounded-md shadow-sm" required>
                        @foreach(\App\Enums\PropertyStatusEnum::cases() as $status)
                            <option value="{{ $status->value }}" {{ old('status', $property->status) == $status->value ? 'selected' : '' }}>
                                {{ ucfirst($status->value) }}
                            </option>
                        @endforeach
                    </select>
                    @error('status')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                
                <!-- Ubicación -->
                <div class="md:col-span-2">
                    <h2 class="text-xl font-bold mb-4 mt-4">Ubicación</h2>
                </div>
                
                <div class="md:col-span-2">
                    <label for="address" class="block mb-2 font-medium">Dirección</label>
                    <input type="text" name="address" id="address" value="{{ old('address', $property->address) }}" class="w-full border-gray-300 rounded-md shadow-sm" required>
                    @error('address')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                
                <div>
                    <label for="city" class="block mb-2 font-medium">Ciudad</label>
                    <input type="text" name="city" id="city" value="{{ old('city', $property->city) }}" class="w-full border-gray-300 rounded-md shadow-sm" required>
                    @error('city')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                
                <div>
                    <label for="postal_code" class="block mb-2 font-medium">Código postal</label>
                    <input type="text" name="postal_code" id="postal_code" value="{{ old('postal_code', $property->postal_code) }}" class="w-full border-gray-300 rounded-md shadow-sm" required>
                    @error('postal_code')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                
                <!-- Características -->
                <div class="md:col-span-2">
                    <h2 class="text-xl font-bold mb-4 mt-4">Características</h2>
                </div>
                
                <div>
                    <label for="bedrooms" class="block mb-2 font-medium">Habitaciones</label>
                    <input type="number" name="bedrooms" id="bedrooms" value="{{ old('bedrooms', $property->bedrooms) }}" min="0" class="w-full border-gray-300 rounded-md shadow-sm" required>
                    @error('bedrooms')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                
                <div>
                    <label for="bathrooms" class="block mb-2 font-medium">Baños</label>
                    <input type="number" name="bathrooms" id="bathrooms" value="{{ old('bathrooms', $property->bathrooms) }}" min="0" class="w-full border-gray-300 rounded-md shadow-sm" required>
                    @error('bathrooms')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                
                <div>
                    <label for="square_meters" class="block mb-2 font-medium">Metros cuadrados</label>
                    <input type="number" name="square_meters" id="square_meters" value="{{ old('square_meters', $property->square_meters) }}" min="1" class="w-full border-gray-300 rounded-md shadow-sm" required>
                    @error('square_meters')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                
                <!-- Features -->
                <div class="md:col-span-2">
                    <h2 class="text-xl font-bold mb-4 mt-4">Extras</h2>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                        @foreach($features as $feature)
                            <div class="flex items-center">
                                <input type="checkbox" name="features[]" id="feature-{{ $feature->id }}" value="{{ $feature->id }}"
                                    {{ in_array($feature->id, old('features', $property->features->pluck('id')->toArray())) ? 'checked' : '' }} 
                                    class="rounded border-gray-300 text-blue-600 shadow-sm">
                                <label for="feature-{{ $feature->id }}" class="ml-2">{{ $feature->name }}</label>
                            </div>
                        @endforeach
                    </div>
                    @error('features')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                
                <!-- Imágenes actuales -->
                @if($property->images->count() > 0)
                    <div class="md:col-span-2">
                        <h2 class="text-xl font-bold mb-4 mt-4">Imágenes actuales</h2>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            @foreach($property->images as $image)
                                <div class="relative">
                                    <img src="{{ asset('storage/' . $image->path) }}" alt="Imagen de la propiedad" class="w-full h-40 object-cover rounded">
                                    @if($image->is_main)
                                        <span class="absolute top-2 left-2 bg-blue-600 text-white text-xs py-1 px-2 rounded">Principal</span>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
                
                <!-- Nuevas imágenes -->
                <div class="md:col-span-2">
                    <h2 class="text-xl font-bold mb-4 mt-4">Añadir más imágenes</h2>
                    <div class="mb-2">
                        <label for="images" class="block mb-2 font-medium">Añadir imágenes (opcional)</label>
                        <input type="file" name="images[]" id="images" accept="image/*" multiple class="w-full border-gray-300 rounded-md shadow-sm">
                    </div>
                    <p class="text-sm text-gray-600">Si no hay imágenes anteriores, la primera será la imagen principal.</p>
                    @error('images')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="md:col-span-2 mt-6">
                    <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded hover:bg-blue-700">
                        Actualizar propiedad
                    </button>
                    <a href="{{ route('properties.show', $property) }}" class="ml-4 px-6 py-3 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">
                        Cancelar
                    </a>
                </div>
            </div>
        </form>
    </div>
@endsection
