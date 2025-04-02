@extends('layouts.app')

@section('title', 'Registro')

@section('header', 'Crear una cuenta')

@section('content')
<div class="max-w-md mx-auto bg-white rounded-lg shadow-md overflow-hidden">
    <div class="p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Regístrate para comenzar</h2>
        
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Nombre -->
            <div class="form-group">
                <label for="name" class="form-label">Nombre completo</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus 
                       class="form-input" autocomplete="name">
                @error('name')
                    <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- Correo electrónico -->
            <div class="form-group">
                <label for="email" class="form-label">Correo electrónico</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required 
                       class="form-input" autocomplete="username">
                @error('email')
                    <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- Contraseña -->
            <div class="form-group">
                <label for="password" class="form-label">Contraseña</label>
                <input id="password" type="password" name="password" required 
                       class="form-input" autocomplete="new-password">
                <small class="text-gray-500">Mínimo 8 caracteres</small>
                @error('password')
                    <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- Confirmar Contraseña -->
            <div class="form-group">
                <label for="password_confirmation" class="form-label">Confirmar contraseña</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required 
                       class="form-input" autocomplete="new-password">
                @error('password_confirmation')
                    <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- Términos y condiciones -->
            <div class="form-group flex items-start mt-6">
                <div class="flex items-center h-5">
                    <input id="terms" type="checkbox" name="terms" required class="form-checkbox">
                </div>
                <div class="ml-3 text-sm">
                    <label for="terms" class="text-gray-700">
                        Acepto los <a href="#" class="text-blue-600 hover:underline">términos y condiciones</a> y la 
                        <a href="#" class="text-blue-600 hover:underline">política de privacidad</a>
                    </label>
                </div>
            </div>

            <div class="mt-6">
                <button type="submit" class="btn-primary w-full">
                    Crear cuenta
                </button>
            </div>
        </form>

        <div class="mt-6 text-center text-sm">
            <p>¿Ya tienes una cuenta? <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Inicia sesión</a></p>
        </div>
    </div>
</div>
@endsection
