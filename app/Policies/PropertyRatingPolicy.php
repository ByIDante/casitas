<?php

namespace App\Policies;

use App\Models\PropertyRating;
use App\Models\User;

class PropertyRatingPolicy
{
    public function create(): bool
    {
        return true; // Any authenticated user can create a rating
    }
    
    public function delete(User $user, PropertyRating $rating): bool
    {
        return $user->id === $rating->user_id || $user->isAdmin();
    }
}
