<div>
    <label class="block text-sm font-medium text-gray-700 mb-1">{{ $label ?? 'Características' }}</label>

    <div class="grid grid-cols-2 md:grid-cols-3 gap-2 border p-3 rounded-md bg-gray-50">
        @foreach($features as $feature)
            <div class="flex items-center">
                <input type="checkbox" name="features[]" id="feature-{{ $feature->id }}" value="{{ $feature->id }}"
                    class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500" @if(in_array($feature->id, $selectedFeatures ?? [])) checked @endif>
                <label for="feature-{{ $feature->id }}" class="ml-2 block text-sm text-gray-900">
                    {{ $feature->name }}
                </label>
            </div>
        @endforeach
    </div>

    @error('features')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror

    @if($features->isEmpty())
        <p class="text-sm text-yellow-600 mt-1">
            No hay características disponibles. <a href="{{ route('admin.features.create') }}" class="underline">Crear
                características</a>
        </p>
    @endif
</div>
