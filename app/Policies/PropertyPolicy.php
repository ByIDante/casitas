<?php

namespace App\Policies;

use App\Models\Property;
use App\Models\User;

class PropertyPolicy
{
    public function viewAny(): bool
    {
        return true; // Anyone can view the properties list
    }
    
    public function view(): bool
    {
        return true; // Anyone can view a property
    }
    
    public function create(): bool
    {
        return true; // Any authenticated user can create a property
    }
    
    public function update(User $user, Property $property): bool
    {
        return $user->id === $property->user_id || $user->isAdmin();
    }
    
    public function delete(User $user, Property $property): bool
    {
        return $user->id === $property->user_id || $user->isAdmin();
    }
    
    public function manage(User $user): bool
    {
        return $user->isAdmin();
    }
}
