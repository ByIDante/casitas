@extends('layouts.app')

@section('title', 'Recuperar contraseña')

@section('header', 'Recuperar contraseña')

@section('content')
<div class="max-w-md mx-auto bg-white rounded-lg shadow-md overflow-hidden">
    <div class="p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Recupera tu contraseña</h2>
        
        <p class="text-gray-600 mb-6">¿Olvidaste tu contraseña? No te preocupes. Indícanos tu dirección de correo electrónico y te enviaremos un enlace para que puedas crear una nueva.</p>
        
        @if (session('status'))
            <div class="alert alert-success mb-4">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Correo electrónico -->
            <div class="form-group">
                <label for="email" class="form-label">Correo electrónico</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus 
                       class="form-input">
                @error('email')
                    <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <div class="mt-6">
                <button type="submit" class="btn-primary w-full">
                    Enviar enlace de recuperación
                </button>
            </div>
        </form>

        <div class="mt-6 text-center text-sm">
            <a href="{{ route('login') }}" class="text-blue-600 hover:underline">
                Volver a iniciar sesión
            </a>
        </div>
    </div>
</div>
@endsection
