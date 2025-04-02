<?php

namespace App\Services;

use App\Enums\PropertyStatusEnum;
use App\Models\Property;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PropertyService
{
    /**
     * Create a new property.
     *
     * @param array $data
     * @return \App\Models\Property
     */
    public function create(array $data): Property
    {
        return DB::transaction(function () use ($data): Property {
            $property = Property::create([
                'user_id' => Auth::id(),
                'title' => $data['title'],
                'description' => $data['description'],
                'price' => $data['price'],
                'address' => $data['address'],
                'city' => $data['city'],
                'postal_code' => $data['postal_code'],
                'square_meters' => $data['square_meters'],
                'bedrooms' => $data['bedrooms'],
                'bathrooms' => $data['bathrooms'],
                'type' => $data['type'],
                'for_sale' => isset($data['for_sale']) && $data['for_sale'] == '1',
                'for_rent' => isset($data['for_rent']) && $data['for_rent'] == '1',
                'status' => PropertyStatusEnum::AVAILABLE->value,
            ]);

            if (isset($data['features']) && is_array($data['features'])) {
                $property->features()->sync($data['features']);
            }

            return $property;
        });
    }

    /**
     * Update an existing property.
     *
     * @param \App\Models\Property $property
     * @param array $data
     * @return \App\Models\Property
     */
    public function update(Property $property, array $data): Property
    {
        return DB::transaction(function () use ($property, $data) {
            $property->update([
                'title' => $data['title'],
                'description' => $data['description'],
                'price' => $data['price'],
                'address' => $data['address'],
                'city' => $data['city'],
                'postal_code' => $data['postal_code'],
                'square_meters' => $data['square_meters'],
                'bedrooms' => $data['bedrooms'],
                'bathrooms' => $data['bathrooms'],
                'type' => $data['type'],
                'for_sale' => isset($data['for_sale']) && $data['for_sale'] == '1',
                'for_rent' => isset($data['for_rent']) && $data['for_rent'] == '1',
                'status' => $data['status'],
            ]);

            if (isset($data['features'])) {
                $property->features()->sync($data['features']);
            } else {
                $property->features()->detach();
            }

            return $property;
        });
    }

    /**
     * Delete a property.
     *
     * @param \App\Models\Property $property
     * @return bool
     */
    public function delete(Property $property): bool
    {
        return DB::transaction(function () use ($property) {
            // Delete property images from storage
            foreach ($property->images as $image) {
                if (file_exists(storage_path('app/public/' . $image->path))) {
                    unlink(storage_path('app/public/' . $image->path));
                }
            }

            return $property->delete();
        });
    }
}
