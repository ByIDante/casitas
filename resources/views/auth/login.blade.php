@extends('layouts.app')

@section('title', 'Iniciar sesión')

@section('header', 'Accede a tu cuenta')

@section('content')
<div class="max-w-md mx-auto bg-white rounded-lg shadow-md overflow-hidden">
    <div class="p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Iniciar sesión</h2>
        
        @if (session('status'))
            <div class="alert alert-success mb-4">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Correo electrónico -->
            <div class="form-group">
                <label for="email" class="form-label">Correo electrónico</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus 
                       class="form-input" autocomplete="username">
                @error('email')
                    <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- Contraseña -->
            <div class="form-group">
                <label for="password" class="form-label">Contraseña</label>
                <input id="password" type="password" name="password" required 
                       class="form-input" autocomplete="current-password">
                @error('password')
                    <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- Recuérdame -->
            <div class="form-group flex items-center">
                <div class="flex items-center h-5">
                    <input id="remember_me" type="checkbox" name="remember" class="form-checkbox">
                </div>
                <div class="ml-3 text-sm">
                    <label for="remember_me" class="text-gray-700">Recordar sesión</label>
                </div>
            </div>

            <div class="mt-6">
                <button type="submit" class="btn-primary w-full">
                    Iniciar sesión
                </button>
            </div>

            <div class="flex items-center justify-between mt-4">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:underline">
                        ¿Olvidaste tu contraseña?
                    </a>
                @endif
            </div>
        </form>

        <div class="mt-6 text-center text-sm">
            <p>¿No tienes una cuenta? <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Regístrate aquí</a></p>
        </div>
    </div>
</div>
@endsection
