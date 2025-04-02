@extends('layouts.app')

@section('title', 'Verificar correo electrónico')

@section('header', 'Verificar correo electrónico')

@section('content')
<div class="max-w-md mx-auto bg-white rounded-lg shadow-md overflow-hidden">
    <div class="p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Verifica tu dirección de correo</h2>
        
        <p class="text-gray-600 mb-6">
            Gracias por registrarte. Antes de comenzar, ¿podrías verificar tu dirección de correo electrónico haciendo clic en el enlace que acabamos de enviarte? Si no has recibido el correo, con gusto te enviaremos otro.
        </p>
        
        @if (session('status') == 'verification-link-sent')
            <div class="alert alert-success mb-4">
                Se ha enviado un nuevo enlace de verificación a la dirección de correo electrónico que proporcionaste durante el registro.
            </div>
        @endif

        <div class="flex flex-col space-y-4">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="btn-primary w-full">
                    Reenviar email de verificación
                </button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-outline w-full">
                    Cerrar sesión
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
