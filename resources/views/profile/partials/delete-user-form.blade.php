<section>
    <header>
        <p class="text-sm text-gray-600 dark:text-gray-400">
            {{ __('Al eliminar tu cuenta, toda tu información y recursos asociados serán eliminados permanentemente. Antes de eliminar tu cuenta, por favor descarga cualquier dato o información que desees conservar.') }}
        </p>
    </header>

    <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="btn-danger mt-6">{{ __('Eliminar cuenta') }}</button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('¿Estás seguro de que quieres eliminar tu cuenta?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Una vez que tu cuenta sea eliminada, todos sus recursos y datos serán eliminados permanentemente. Por favor, introduce tu contraseña para confirmar que deseas eliminar tu cuenta definitivamente.') }}
            </p>

            <div class="mt-6 form-group">
                <label for="password" class="form-label">{{ __('Contraseña') }}</label>
                <input id="password" name="password" type="password" class="form-input"
                    placeholder="{{ __('Contraseña') }}" />
                @error('password', 'userDeletion')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mt-6 flex justify-end">
                <button type="button" class="btn-outline" x-on:click="$dispatch('close')">
                    {{ __('Cancelar') }}
                </button>

                <button type="submit" class="btn-danger ml-3">
                    {{ __('Eliminar cuenta') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>
