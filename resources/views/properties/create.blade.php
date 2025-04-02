@extends('layouts.app')

@section('title', 'Crear propiedad')

@section('header', 'Crear nueva propiedad')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow">
        <form action="{{ route('properties.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Información básica -->
                <div class="md:col-span-2">
                    <h2 class="text-xl font-bold mb-4">Información básica</h2>
                </div>
                
                <div class="md:col-span-2">
                    <label for="title" class="block mb-2 font-medium">Título</label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" class="w-full border-gray-300 rounded-md shadow-sm" required>
                    @error('title')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="md:col-span-2">
                    <label for="description" class="block mb-2 font-medium">Descripción</label>
                    <textarea name="description" id="description" rows="5" class="w-full border-gray-300 rounded-md shadow-sm" required>{{ old('description') }}</textarea>
                    @error('description')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                
                <!-- Tipo y precio -->
                <div>
                    <label for="type" class="block mb-2 font-medium">Tipo de propiedad</label>
                    <select name="type" id="type" class="w-full border-gray-300 rounded-md shadow-sm" required>
                        <option value="APARTMENT" {{ old('type') == 'APARTMENT' ? 'selected' : '' }}>Apartamento</option>
                        <option value="HOUSE" {{ old('type') == 'HOUSE' ? 'selected' : '' }}>Casa</option>
                        <option value="STUDIO" {{ old('type') == 'STUDIO' ? 'selected' : '' }}>Estudio</option>
                        <option value="LOFT" {{ old('type') == 'LOFT' ? 'selected' : '' }}>Loft</option>
                        <option value="PENTHOUSE" {{ old('type') == 'PENTHOUSE' ? 'selected' : '' }}>Ático</option>
                        <option value="DUPLEX" {{ old('type') == 'DUPLEX' ? 'selected' : '' }}>Dúplex</option>
                    </select>
                    @error('type')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                
                <div>
                    <label for="price" class="block mb-2 font-medium">Precio (€)</label>
                    <input type="number" name="price" id="price" value="{{ old('price') }}" min="0" step="0.01" class="w-full border-gray-300 rounded-md shadow-sm" required>
                    @error('price')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                
                <div>
                    <div class="flex items-center mb-4">
                        <input type="checkbox" name="for_sale" id="for_sale" value="1" {{ old('for_sale') ? 'checked' : '' }} class="rounded border-gray-300 text-blue-600 shadow-sm">
                        <label for="for_sale" class="ml-2">Disponible para venta</label>
                    </div>
                    
                    <div class="flex items-center">
                        <input type="checkbox" name="for_rent" id="for_rent" value="1" {{ old('for_rent') ? 'checked' : '' }} class="rounded border-gray-300 text-blue-600 shadow-sm">
                        <label for="for_rent" class="ml-2">Disponible para alquiler</label>
                    </div>
                    
                    @error('for_sale')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                    @error('for_rent')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                
                <!-- Ubicación -->
                <div class="md:col-span-2">
                    <h2 class="text-xl font-bold mb-4 mt-4">Ubicación</h2>
                </div>
                
                <div class="md:col-span-2">
                    <label for="address" class="block mb-2 font-medium">Dirección</label>
                    <input type="text" name="address" id="address" value="{{ old('address') }}" class="w-full border-gray-300 rounded-md shadow-sm" required>
                    @error('address')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                
                <div>
                    <label for="city" class="block mb-2 font-medium">Ciudad</label>
                    <input type="text" name="city" id="city" value="{{ old('city') }}" class="w-full border-gray-300 rounded-md shadow-sm" required>
                    @error('city')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                
                <div>
                    <label for="postal_code" class="block mb-2 font-medium">Código postal</label>
                    <input type="text" name="postal_code" id="postal_code" value="{{ old('postal_code') }}" class="w-full border-gray-300 rounded-md shadow-sm" required>
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
                    <input type="number" name="bedrooms" id="bedrooms" value="{{ old('bedrooms') }}" min="0" class="w-full border-gray-300 rounded-md shadow-sm" required>
                    @error('bedrooms')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                
                <div>
                    <label for="bathrooms" class="block mb-2 font-medium">Baños</label>
                    <input type="number" name="bathrooms" id="bathrooms" value="{{ old('bathrooms') }}" min="0" class="w-full border-gray-300 rounded-md shadow-sm" required>
                    @error('bathrooms')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                
                <div>
                    <label for="square_meters" class="block mb-2 font-medium">Metros cuadrados</label>
                    <input type="number" name="square_meters" id="square_meters" value="{{ old('square_meters') }}" min="1" class="w-full border-gray-300 rounded-md shadow-sm" required>
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
                                    {{ in_array($feature->id, old('features', [])) ? 'checked' : '' }} 
                                    class="rounded border-gray-300 text-blue-600 shadow-sm">
                                <label for="feature-{{ $feature->id }}" class="ml-2">{{ $feature->name }}</label>
                            </div>
                        @endforeach
                    </div>
                    @error('features')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                
                <!-- Imágenes -->
                <div class="md:col-span-2">
                    <h2 class="text-xl font-bold mb-4 mt-4">Imágenes</h2>
                    <div class="mb-2">
                        <label for="images" class="block mb-2 font-medium">Añadir imágenes (máx. 5)</label>
                        <input type="file" name="images[]" id="images" accept="image/*" multiple class="w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>
                    <p class="text-sm text-gray-600">Puedes seleccionar múltiples imágenes. La primera será la imagen principal.</p>
                    @error('images')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="md:col-span-2 mt-6">
                    <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded hover:bg-blue-700">
                        Crear propiedad
                    </button>
                    <a href="{{ route('properties.my') }}" class="ml-4 px-6 py-3 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">
                        Cancelar
                    </a>
                </div>
            </div>
        </form>
    </div>
@endsection
