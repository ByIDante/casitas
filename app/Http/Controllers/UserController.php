<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\PropertyRating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function store(Request $request, Property $property)
    {
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);
        
        // Check if user has already rated this property
        $existingRating = PropertyRating::where('user_id', Auth::id())
            ->where('property_id', $property->id)
            ->first();
            
        if ($existingRating) {
            $existingRating->update([
                'rating' => $validated['rating'],
                'comment' => $validated['comment'] ?? null,
            ]);
            
            $message = 'Valoración actualizada correctamente';
        } else {
            PropertyRating::create([
                'property_id' => $property->id,
                'user_id' => Auth::id(),
                'rating' => $validated['rating'],
                'comment' => $validated['comment'] ?? null,
            ]);
            
            $message = 'Valoración añadida correctamente';
        }
        
        return redirect()->route('properties.show', $property)
            ->with('success', $message);
    }
    
    public function destroy(PropertyRating $rating)
    {
        $this->authorize('delete', $rating);
        
        $property = $rating->property;
        $rating->delete();
        
        return redirect()->route('properties.show', $property)
            ->with('success', 'Valoración eliminada correctamente');
    }
}
