<div class="bg-white shadow rounded-lg p-4 mt-6">
    <h3 class="text-lg font-bold mb-4">Deja tu valoración</h3>

    <form action="{{ route('property.ratings.store', $property) }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-700 mb-2">Puntuación</label>
            <div class="flex">
                @for ($i = 1; $i <= 5; $i++)
                    <div class="mr-2">
                        <input type="radio" name="rating" id="rating-{{ $i }}" value="{{ $i }}" required
                            class="hidden peer">
                        <label for="rating-{{ $i }}" class="cursor-pointer text-2xl peer-checked:text-yellow-500">★</label>
                    </div>
                @endfor
            </div>
        </div>

        <div class="mb-4">
            <label for="comment" class="block text-gray-700 mb-2">Comentario (opcional)</label>
            <textarea name="comment" id="comment" rows="3" class="border rounded w-full p-2"></textarea>
        </div>

        <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700">Enviar
            valoración</button>
    </form>
</div>