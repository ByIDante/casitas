@extends('layouts.app')

@section('header')
    <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Perfil') }}
        </h2>
        <a href="{{ route('profile.show') }}"
            class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-md transition">
            {{ __('Volver a mi perfil') }}
        </a>
    </div>
@endsection

@section('content')
    <div class="space-y-6">
        <!-- Información básica -->
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg" id="personal-info">
            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                    {{ __('Información del Perfil') }}
                </h3>
            </div>
            <div class="p-6">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>
        </div>

        <!-- Contraseña -->
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg" id="password">
            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                    {{ __('Seguridad') }}
                </h3>
            </div>
            <div class="p-6">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>
        </div>

        <!-- Mis propiedades -->
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                <div class="flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                        {{ __('Mis Propiedades') }}
                    </h3>
                    <a href="{{ route('properties.create') }}"
                        class="px-3 py-1 bg-blue-500 hover:bg-blue-600 text-white text-sm rounded-md transition">
                        {{ __('Añadir propiedad') }}
                    </a>
                </div>
            </div>
            <div class="p-6">
                @if(isset($properties) && $properties->count() > 0)
                    <div class="mb-4">
                        <p class="text-gray-600 dark:text-gray-400">
                            {{ __('Tienes :count propiedade(s) publicadas.', ['count' => $properties->count()]) }}
                        </p>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($properties as $property)
                                <div class="border dark:border-gray-700 rounded-lg overflow-hidden flex">
                                    <div class="w-24 h-24 bg-gray-200 dark:bg-gray-700">
                                        @if($property->featured_image)
                                                        @php
                                                            // Comprobar si la imagen es una URL externa o un path local
                                                            $imagePath = $property->featured_image;
                                                            // Si no es una URL completa, construirla
                                                            if (!filter_var($imagePath, FILTER_VALIDATE_URL)) {
                                                                $imagePath = asset('storage/' . $imagePath);
                                                            }
                                                        @endphp
                                                        <img src="{{ $imagePath }}" alt="{{ $property->title }}" class="w-full h-full object-cover">
                                        @elseif($property->images && $property->images->count() > 0)
                                                        @php
                                                            // Obtener la primera imagen o la imagen principal
                                                            $image = $property->images->firstWhere('is_main', true) ?? $property->images->first();
                                                            $imagePath = $image->path;

                                                            // Si no es una URL completa, construirla
                                                            if (!filter_var($imagePath, FILTER_VALIDATE_URL)) {
                                                                $imagePath = asset('storage/' . $imagePath);
                                                            }
                                                        @endphp
                                                        <img src="{{ $imagePath }}" alt="{{ $property->title }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center">
                                                <span class="text-xs text-gray-500 dark:text-gray-400">Sin imagen</span>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex-1 p-3">
                                        <h4 class="font-semibold text-gray-900 dark:text-gray-100">{{ $property->title }}</h4>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ number_format($property->price) }}€</p>
                                        <div class="mt-2 flex gap-2">
                                            <a href="{{ route('properties.edit', $property) }}"
                                                class="text-sm text-blue-600 dark:text-blue-400 hover:underline">
                                                {{ __('Editar') }}
                                            </a>
                                            <a href="{{ route('properties.show', $property) }}"
                                                class="text-sm text-gray-600 dark:text-gray-400 hover:underline">
                                                {{ __('Ver') }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                        @endforeach
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('properties.my') }}"
                            class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 rounded-md transition">
                            {{ __('Ver todas mis propiedades') }}
                        </a>
                    </div>
                @else
                    <div class="text-center py-4">
                        <p class="text-gray-500 dark:text-gray-400 mb-4">
                            {{ __('Aún no has publicado ninguna propiedad.') }}
                        </p>
                        <a href="{{ route('properties.create') }}"
                            class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-md transition">
                            {{ __('Publicar mi primera propiedad') }}
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <!-- Eliminar cuenta -->
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border-red-200 dark:border-red-800">
            <div class="p-6 border-b border-red-200 dark:border-red-800 bg-red-50 dark:bg-red-900/20">
                <h3 class="text-lg font-semibold text-red-700 dark:text-red-400">
                    {{ __('Eliminar Cuenta') }}
                </h3>
            </div>
            <div class="p-6">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
@endsection
