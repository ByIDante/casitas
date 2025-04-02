@extends('layouts.app')

@section('header')
    <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Mi Perfil') }}
        </h2>
        <a href="{{ route('profile.edit') }}"
            class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md transition shadow-sm">
            {{ __('Editar perfil') }}
        </a>
    </div>
@endsection

@section('content')
    <div class="space-y-6">
        <!-- Información del Usuario -->
        <div
            class="bg-white dark:bg-gray-800 overflow-hidden shadow-md border border-gray-200 dark:border-gray-700 rounded-lg">
            <div class="p-6">
                <h3
                    class="text-xl font-bold mb-4 text-gray-900 dark:text-white border-b pb-2 border-gray-200 dark:border-gray-700">
                    {{ __('Información Personal') }}
                </h3>

                <div class="flex flex-col md:flex-row items-start gap-6 mt-4">
                    <div
                        class="w-24 h-24 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 text-white flex items-center justify-center text-3xl font-bold shadow-md">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <div class="flex-1">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="bg-gray-50 dark:bg-gray-700/50 p-4 rounded-lg">
                                <p class="text-sm font-medium text-indigo-600 dark:text-indigo-400 mb-1">{{ __('Nombre') }}
                                </p>
                                <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $user->name }}</p>
                            </div>
                            <div class="bg-gray-50 dark:bg-gray-700/50 p-4 rounded-lg">
                                <p class="text-sm font-medium text-indigo-600 dark:text-indigo-400 mb-1">{{ __('Email') }}
                                </p>
                                <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ Auth::user()->email }}</p>
                                @if (Auth::user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !Auth::user()->hasVerifiedEmail())
                                    <span
                                        class="inline-flex items-center mt-2 px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800 dark:bg-amber-800/30 dark:text-amber-500 border border-amber-200 dark:border-amber-800/30">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        {{ __('No verificado') }}
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center mt-2 px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-800/30 dark:text-green-500 border border-green-200 dark:border-green-800/30">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                        {{ __('Verificado') }}
                                    </span>
                                @endif
                            </div>
                            <div class="bg-gray-50 dark:bg-gray-700/50 p-4 rounded-lg">
                                <p class="text-sm font-medium text-indigo-600 dark:text-indigo-400 mb-1">
                                    {{ __('Miembro desde') }}</p>
                                <p class="text-lg font-semibold text-gray-900 dark:text-white">
                                    {{ Auth::user()->created_at->format('d/m/Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mis propiedades -->
        <div
            class="bg-white dark:bg-gray-800 overflow-hidden shadow-md border border-gray-200 dark:border-gray-700 rounded-lg">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">{{ __('Mis Propiedades') }}</h3>
                    <a href="{{ route('properties.create') }}"
                        class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm rounded-md transition shadow-sm">
                        <span class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            {{ __('Añadir propiedad') }}
                        </span>
                    </a>
                </div>

                @if(isset($properties) && $properties->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($properties as $property)
                                <div
                                    class="border border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden bg-white dark:bg-gray-800 shadow-sm hover:shadow-md transition duration-200">
                                    <div class="h-44 bg-gray-200 dark:bg-gray-700 relative">
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
                                                <span class="text-gray-600 dark:text-gray-400">Sin imagen</span>
                                            </div>
                                        @endif

                                        <!-- Precio destacado -->
                                        <div
                                            class="absolute top-0 right-0 bg-gradient-to-l from-indigo-600 to-indigo-500 text-white px-3 py-1 rounded-bl-lg font-bold shadow-sm">
                                            {{ number_format($property->price) }}€
                                        </div>
                                    </div>
                                    <div class="p-4">
                                        <h4 class="font-bold text-lg text-gray-900 dark:text-white mb-1">{{ $property->title }}</h4>
                                        <p class="text-gray-600 dark:text-gray-300 mb-3 flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-gray-500" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                            {{ $property->city ?? $property->location }}
                                        </p>
                                        <div class="flex justify-end">
                                            <a href="{{ route('properties.show', $property) }}"
                                                class="inline-flex items-center px-3 py-1.5 bg-indigo-100 hover:bg-indigo-200 text-indigo-800 dark:bg-indigo-800/30 dark:hover:bg-indigo-700/50 dark:text-indigo-300 rounded transition">
                                                <span>Ver detalles</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                        @endforeach
                    </div>

                    @if($properties->count() > 3)
                        <div class="mt-6 text-center">
                            <a href="{{ route('properties.my-properties') }}"
                                class="inline-flex items-center px-5 py-2.5 bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 rounded-md shadow-sm transition">
                                {{ __('Ver todas mis propiedades') }}
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </a>
                        </div>
                    @endif
                @else
                    <div
                        class="text-center py-12 bg-gray-50 dark:bg-gray-700/20 rounded-lg border border-dashed border-gray-300 dark:border-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400 dark:text-gray-500 mb-4"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        <p class="text-gray-600 dark:text-gray-400 mb-4 text-lg">
                            {{ __('Aún no has añadido ninguna propiedad') }}</p>
                        <a href="{{ route('properties.create') }}"
                            class="px-6 py-3 bg-emerald-600 hover:bg-emerald-700 text-white rounded-md shadow-sm transition inline-flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            {{ __('Añadir mi primera propiedad') }}
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <!-- Acciones rápidas -->
        <div
            class="bg-white dark:bg-gray-800 overflow-hidden shadow-md border border-gray-200 dark:border-gray-700 rounded-lg">
            <div class="p-6">
                <h3
                    class="text-xl font-bold mb-6 text-gray-900 dark:text-white border-b pb-2 border-gray-200 dark:border-gray-700">
                    {{ __('Acciones rápidas') }}
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <a href="{{ route('profile.edit') }}"
                        class="flex items-center p-6 border border-gray-200 dark:border-gray-700 rounded-lg bg-indigo-50 hover:bg-indigo-100 dark:bg-indigo-900/10 dark:hover:bg-indigo-900/20 transition duration-200 group">
                        <div
                            class="mr-4 p-3 bg-indigo-100 dark:bg-indigo-800/30 rounded-full group-hover:bg-indigo-200 dark:group-hover:bg-indigo-800/50 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-indigo-600 dark:text-indigo-400"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div>
                            <p
                                class="font-bold text-lg text-gray-900 dark:text-white group-hover:text-indigo-700 dark:group-hover:text-indigo-300 transition">
                                {{ __('Editar información') }}</p>
                            <p class="text-gray-600 dark:text-gray-400">{{ __('Actualiza tu nombre y email') }}</p>
                        </div>
                    </a>

                    <a href="{{ route('profile.edit') }}#password"
                        class="flex items-center p-6 border border-gray-200 dark:border-gray-700 rounded-lg bg-emerald-50 hover:bg-emerald-100 dark:bg-emerald-900/10 dark:hover:bg-emerald-900/20 transition duration-200 group">
                        <div
                            class="mr-4 p-3 bg-emerald-100 dark:bg-emerald-800/30 rounded-full group-hover:bg-emerald-200 dark:group-hover:bg-emerald-800/50 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-emerald-600 dark:text-emerald-400"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <div>
                            <p
                                class="font-bold text-lg text-gray-900 dark:text-white group-hover:text-emerald-700 dark:group-hover:text-emerald-300 transition">
                                {{ __('Cambiar contraseña') }}</p>
                            <p class="text-gray-600 dark:text-gray-400">
                                {{ __('Actualiza tu contraseña para mayor seguridad') }}</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
