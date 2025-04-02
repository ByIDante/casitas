<?php

namespace App\Repositories;

use App\Enums\PropertyStatusEnum;
use App\Models\Property;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class PropertyRepository
{
    /**
     * Get paginated available properties with relationships.
     *
     * @param int $perPage
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getPaginated(int $perPage = 12): LengthAwarePaginator
    {
        return Property::with(['images', 'user', 'ratings'])
            ->where('status', PropertyStatusEnum::AVAILABLE)
            ->latest()
            ->paginate($perPage);
    }

    /**
     * Get properties belonging to the authenticated user.
     *
     * @param int $perPage
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getMyProperties(int $perPage = 12): LengthAwarePaginator
    {
        return Property::where('user_id', Auth::id())
            ->with(['images'])
            ->latest()
            ->paginate($perPage);
    }

    /**
     * Get all properties with relationships for admin.
     *
     * @param int $perPage
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getAllForAdmin(int $perPage = 15): LengthAwarePaginator
    {
        return Property::with(['user', 'images'])
            ->latest()
            ->paginate($perPage);
    }

    /**
     * Get a property with all its relationships.
     *
     * @param \App\Models\Property $property
     * @return \App\Models\Property
     */
    public function getWithRelationships(Property $property): Property
    {
        return $property->load(['images', 'user', 'ratings.user', 'features']);
    }
}
