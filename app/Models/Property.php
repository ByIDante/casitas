<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'price',
        'address',
        'city',
        'postal_code',
        'square_meters',
        'bedrooms',
        'bathrooms',
        'is_for_sale',
        'is_for_rent',
        'type',
        'status',
        'user_id',
        'property_type_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function propertyType(): BelongsTo
    {
        return $this->belongsTo(PropertyType::class);
    }

    public function features(): BelongsToMany
    {
        return $this->belongsToMany(Feature::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(PropertyImage::class);
    }

    public function ratings(): HasMany
    {
        return $this->hasMany(PropertyRating::class);
    }

    // HELPERS
    public function getAverageRatingAttribute(): mixed
    {
        return $this->ratings->avg('rating');
    }
}
