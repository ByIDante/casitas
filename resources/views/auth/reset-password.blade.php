@extends('layouts.app')

@section('title', 'Establecer nueva contraseña')

@section('header', 'Establecer nueva contraseña')

@section('content')
<div class="max-w-md mx-auto bg-white rounded-lg shadow-md overflow-hidden">
    <div class="p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Crea una nueva contraseña</h2>
        
        <form method="POST" action="{{ route('password.store') }}">
            @csrf
            
            <!-- Token de restablecimiento de contraseña -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Correo electrónico -->
            <div class="form-group">
                <label for="email" class="form-label">Correo electrónico</label>
                <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus 
                       class="form-input" readonly>
                @error('email')
                    <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- Contraseña -->
            <div class="form-group">
                <label for="password" class="form-label">Nueva contraseña</label>
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

            <div class="mt-6">
                <button type="submit" class="btn-primary w-full">
                    Restablecer contraseña
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
