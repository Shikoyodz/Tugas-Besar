<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Booking extends Model
{
    use HasFactory;

    protected $cast = [
        'check_in' => 'datetime',
        'check_out' => 'datetime'
    ];

    public function room() : BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    public function type() : BelongsTo
    {
        return $this->belongsTo(RoomType::class,'room_type_id');
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function billingDetail() : HasOne
    {
        return $this->hasOne(BillingDetail::class);
    }

    public function accomodations() : BelongsToMany
    {
        return $this->belongsToMany(Accomodation::class);
    }

    public function bookingAccomodations() : HasMany
    {
        return $this->hasMany(BookingAccomodation::class);
    }
}
