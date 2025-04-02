@extends('layouts.app')

@section('title', 'Mi Panel')

@section('header', 'Mi Panel')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Mi Panel') }}
        </h2>
        <a href="{{ route('properties.create') }}"
            class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-md transition">
            {{ __('Añadir Propiedad') }}
        </a>
    </div>

    <div class="py-6">
        <!-- Estadísticas Rápidas -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-2 text-gray-900 dark:text-gray-100">{{ __('Mis Propiedades') }}</h3>
                <p class="text-3xl font-bold text-blue-500">{{ isset($properties) ? $properties->count() : 0 }}</p>
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-2 text-gray-900 dark:text-gray-100">{{ __('Estado') }}</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400">{{ __('Cuenta activa desde') }}
                    {{ Auth::user()->created_at->format('d/m/Y') }}</p>
            </div>
        </div>

        <!-- Lista de Propiedades -->
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
            <div class="p-6">
                <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-gray-100">{{ __('Mis Propiedades') }}</h3>

                @if(isset($properties) && $properties->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($properties as $property)
                            <div class="border dark:border-gray-700 rounded-lg overflow-hidden">
                                <img src="{{ $property->featured_image ?? asset('images/placeholder.jpg') }}"
                                    alt="{{ $property->name }}" class="w-full h-48 object-cover">
                                <div class="p-4">
                                    <h4 class="font-semibold text-gray-900 dark:text-gray-100">{{ $property->name }}</h4>
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">{{ $property->location }}</p>
                                    <div class="flex justify-between items-center">
                                        <span class="text-blue-500 font-bold">{{ $property->price_per_night ?? '0' }}€/noche</span>
                                        <div>
                                            <a href="{{ route('properties.edit', $property) }}"
                                                class="text-sm text-gray-600 dark:text-gray-400 hover:text-blue-500 dark:hover:text-blue-400 mr-2">Editar</a>
                                            <a href="{{ route('properties.show', $property) }}"
                                                class="text-sm text-blue-500 hover:text-blue-600">Ver detalles</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <p class="text-gray-500 dark:text-gray-400 mb-4">{{ __('Aún no has añadido ninguna propiedad') }}</p>
                        <a href="{{ route('properties.create') }}"
                            class="inline-block px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-md transition">
                            {{ __('Añadir mi primera propiedad') }}
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <!-- Acciones Rápidas -->
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-gray-100">{{ __('Acciones Rápidas') }}</h3>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <a href="{{ route('properties.create') }}"
                        class="flex items-center p-4 border dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                        <div class="mr-3 p-2 bg-blue-100 dark:bg-blue-900 rounded-full">
                            <svg class="w-6 h-6 text-blue-500 dark:text-blue-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-medium text-gray-900 dark:text-gray-100">{{ __('Nueva Propiedad') }}</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ __('Añadir una nueva propiedad') }}</p>
                        </div>
                    </a>

                    <a href="{{ route('profile.edit') }}"
                        class="flex items-center p-4 border dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                        <div class="mr-3 p-2 bg-green-100 dark:bg-green-900 rounded-full">
                            <svg class="w-6 h-6 text-green-500 dark:text-green-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-medium text-gray-900 dark:text-gray-100">{{ __('Mi Perfil') }}</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ __('Editar información de perfil') }}</p>
                        </div>
                    </a>

                    <a href="#"
                        class="flex items-center p-4 border dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                        <div class="mr-3 p-2 bg-purple-100 dark:bg-purple-900 rounded-full">
                            <svg class="w-6 h-6 text-purple-500 dark:text-purple-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-medium text-gray-900 dark:text-gray-100">{{ __('Ayuda') }}</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ __('Centro de soporte') }}</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
