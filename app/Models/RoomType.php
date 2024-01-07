<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class RoomType extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    public function rooms() : HasMany
    {
        return $this->hasMany(Room::class);
    }

    public function features() : BelongsToMany
    {
        return $this->belongsToMany(Feature::class,'room_type_features');
    }

    public function roomTypeFeatures() : HasMany
    {
        return $this->hasMany(RoomTypeFeature::class);
    }

    public function bookings() : HasMany
    {
        return $this->hasMany(Booking::class);
    }
}
