<?php

namespace App\Services;

use App\Models\Property;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class PropertyImageService
{
    /**
     * Store images for a property.
     *
     * @param \App\Models\Property $property
     * @param array $images
     * @return void
     */
    public function storeImages(Property $property, array $images): void
    {
        $isFirstImage = $property->images->isEmpty();

        foreach ($images as $image) {
            $path = $this->saveImage($image);

            $property->images()->create([
                'path' => $path,
                'is_main' => $isFirstImage,
            ]);

            $isFirstImage = false;
        }
    }

    /**
     * Save an image and return its path.
     *
     * @param \Illuminate\Http\UploadedFile $image
     * @return string
     */
    private function saveImage(UploadedFile $image): string
    {
        $fileName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

        return $image->storeAs('properties', $fileName, 'public');
    }

    /**
     * Delete images for a property.
     *
     * @param \App\Models\Property $property
     * @return void
     */
    public function deleteImages(Property $property): void
    {
        foreach ($property->images as $image) {
            if (Storage::disk('public')->exists($image->path)) {
                Storage::disk('public')->delete($image->path);
            }

            $image->delete();
        }
    }

    /**
     * Set an image as the main image for a property.
     *
     * @param \App\Models\Property $property
     * @param int $imageId
     * @return void
     */
    public function setMainImage(Property $property, int $imageId): void
    {
        $property->images()->update(['is_main' => false]);

        $property->images()
            ->where('id', $imageId)
            ->update(['is_main' => true]);
    }
}
