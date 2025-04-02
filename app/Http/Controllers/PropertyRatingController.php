<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePropertyRatingRequest;
use App\Models\Property;
use App\Models\PropertyRating;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class PropertyRatingController extends Controller
{
    /**
     * Almacena una nueva valoración para una propiedad.
     */
    public function store(StorePropertyRatingRequest $request, Property $property): RedirectResponse
    {
        // Verificar si el usuario ya ha valorado esta propiedad
        $existingRating = PropertyRating::where('user_id', Auth::id())
            ->where('property_id', $property->id)
            ->first();

        if ($existingRating) {
            $existingRating->update([
                'rating' => $request->rating,
                'comment' => $request->comment,
            ]);

            $message = 'Valoración actualizada correctamente';
        } else {
            PropertyRating::create([
                'property_id' => $property->id,
                'user_id' => Auth::id(),
                'rating' => $request->rating,
                'comment' => $request->comment,
            ]);

            $message = 'Valoración añadida correctamente';
        }

        return redirect()
            ->route('properties.show', $property)
            ->with('success', $message);
    }

    /**
     * Elimina una valoración.
     */
    public function destroy(PropertyRating $rating): RedirectResponse
    {
        $this->authorize('delete', $rating);

        $property = $rating->property;
        $rating->delete();

        return redirect()
            ->route('properties.show', $property)
            ->with('success', 'Valoración eliminada correctamente');
    }
}
