@extends('layouts.admin')

@section('header', 'Editar propiedad')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2 class="text-xl font-bold">Editar propiedad: {{ $property->title }}</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.properties.update', $property) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Información básica -->
                    <div class="md:col-span-2">
                        <h3 class="text-lg font-bold mb-4">Información básica</h3>
                    </div>
                    
                    <div class="md:col-span-2 form-group">
                        <label for="title" class="form-label">Título</label>
                        <input type="text" name="title" id="title" value="{{ old('title', $property->title) }}" class="form-input" required>
                        @error('title')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="md:col-span-2 form-group">
                        <label for="description" class="form-label">Descripción</label>
                        <textarea name="description" id="description" rows="5" class="form-input" required>{{ old('description', $property->description) }}</textarea>
                        @error('description')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <!-- Tipo y precio -->
                    <div class="form-group">
                        <label for="type" class="form-label">Tipo de propiedad</label>
                        <select name="type" id="type" class="form-select" required>
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
                    
                    <div class="form-group">
                        <label for="price" class="form-label">Precio (€)</label>
                        <input type="number" name="price" id="price" value="{{ old('price', $property->price) }}" min="0" step="0.01" class="form-input" required>
                        @error('price')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="user_id" class="form-label">Propietario</label>
                        <select name="user_id" id="user_id" class="form-select" required>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ old('user_id', $property->user_id) == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }} ({{ $user->email }})
                                </option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="status" class="form-label">Estado</label>
                        <select name="status" id="status" class="form-select" required>
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
                        <h3 class="text-lg font-bold mb-4 mt-4">Ubicación</h3>
                    </div>
                    
                    <div class="md:col-span-2 form-group">
                        <label for="address" class="form-label">Dirección</label>
                        <input type="text" name="address" id="address" value="{{ old('address', $property->address) }}" class="form-input" required>
                        @error('address')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="city" class="form-label">Ciudad</label>
                        <input type="text" name="city" id="city" value="{{ old('city', $property->city) }}" class="form-input" required>
                        @error('city')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="postal_code" class="form-label">Código postal</label>
                        <input type="text" name="postal_code" id="postal_code" value="{{ old('postal_code', $property->postal_code) }}" class="form-input" required>
                        @error('postal_code')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <!-- Características -->
                    <div class="md:col-span-2">
                        <h3 class="text-lg font-bold mb-4 mt-4">Características</h3>
                    </div>
                    
                    <div class="form-group">
                        <label for="bedrooms" class="form-label">Habitaciones</label>
                        <input type="number" name="bedrooms" id="bedrooms" value="{{ old('bedrooms', $property->bedrooms) }}" min="0" class="form-input" required>
                        @error('bedrooms')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="bathrooms" class="form-label">Baños</label>
                        <input type="number" name="bathrooms" id="bathrooms" value="{{ old('bathrooms', $property->bathrooms) }}" min="0" class="form-input" required>
                        @error('bathrooms')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="square_meters" class="form-label">Metros cuadrados</label>
                        <input type="number" name="square_meters" id="square_meters" value="{{ old('square_meters', $property->square_meters) }}" min="1" class="form-input" required>
                        @error('square_meters')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <!-- Features -->
                    <div class="md:col-span-2">
                        <h3 class="text-lg font-bold mb-4 mt-4">Extras</h3>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                            @foreach($features as $feature)
                                <div class="flex items-center">
                                    <input type="checkbox" name="features[]" id="feature-{{ $feature->id }}" value="{{ $feature->id }}"
                                        {{ in_array($feature->id, old('features', $property->features->pluck('id')->toArray())) ? 'checked' : '' }} 
                                        class="form-checkbox">
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
                            <h3 class="text-lg font-bold mb-4 mt-4">Imágenes actuales</h3>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                @foreach($property->images as $image)
                                    <div class="relative thumbnail {{ $image->is_main ? 'active' : '' }}">
                                        <img src="{{ asset('storage/' . $image->path) }}" alt="Imagen de la propiedad" class="w-full h-40 object-cover rounded">
                                        @if($image->is_main)
                                            <span class="absolute top-2 left-2 badge-featured">Principal</span>
                                        @endif
                                        <div class="absolute top-2 right-2">
                                            <button type="button" class="bg-red-600 text-white rounded-full p-1 hover:bg-red-700" 
                                                    onclick="document.getElementById('delete-image-{{ $image->id }}').submit()">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                            <form id="delete-image-{{ $image->id }}" action="{{ route('admin.properties.images.destroy', [$property, $image]) }}" method="POST" class="hidden">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    
                    <!-- Nuevas imágenes -->
                    <div class="md:col-span-2 form-group">
                        <h3 class="text-lg font-bold mb-4 mt-4">Añadir más imágenes</h3>
                        <div class="mb-2">
                            <label for="images" class="form-label">Añadir imágenes (opcional)</label>
                            <input type="file" name="images[]" id="images" accept="image/*" multiple class="form-input">
                        </div>
                        <p class="text-sm text-gray-600">Si no hay imágenes anteriores, la primera será la imagen principal.</p>
                        @error('images')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="md:col-span-2 mt-6">
                        <button type="submit" class="btn-primary">
                            Actualizar propiedad
                        </button>
                        <a href="{{ route('admin.properties.index') }}" class="btn-outline ml-4">
                            Cancelar
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
