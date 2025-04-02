@extends('layouts.app')

@section('title', 'Confirmar contraseña')

@section('header', 'Confirmar contraseña')

@section('content')
<div class="max-w-md mx-auto bg-white rounded-lg shadow-md overflow-hidden">
    <div class="p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Confirmación de seguridad</h2>
        
        <p class="text-gray-600 mb-6">Esta es un área segura de la aplicación. Por favor, confirma tu contraseña antes de continuar.</p>
        
        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <!-- Contraseña -->
            <div class="form-group">
                <label for="password" class="form-label">Contraseña</label>
                <input id="password" type="password" name="password" required 
                       class="form-input" autocomplete="current-password">
                @error('password')
                    <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <div class="mt-6">
                <button type="submit" class="btn-primary w-full">
                    Confirmar
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
