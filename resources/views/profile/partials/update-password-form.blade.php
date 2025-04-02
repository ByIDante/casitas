<section>
    <header>
        <p class="text-sm text-gray-600 dark:text-gray-400">
            {{ __('Asegúrate de usar una contraseña segura para proteger tu cuenta.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div class="form-group">
            <label for="current_password" class="form-label">{{ __('Contraseña actual') }}</label>
            <input id="current_password" name="current_password" type="password" class="form-input"
                autocomplete="current-password">
            @error('current_password', 'updatePassword')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password" class="form-label">{{ __('Nueva contraseña') }}</label>
            <input id="password" name="password" type="password" class="form-input" autocomplete="new-password">
            @error('password', 'updatePassword')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password_confirmation" class="form-label">{{ __('Confirmar contraseña') }}</label>
            <input id="password_confirmation" name="password_confirmation" type="password" class="form-input"
                autocomplete="new-password">
            @error('password_confirmation', 'updatePassword')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="btn-primary">{{ __('Guardar') }}</button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600 dark:text-green-400">{{ __('Guardado.') }}</p>
            @endif
        </div>
    </form>
</section>
