<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BillingDetail extends Model
{
    use HasFactory;

    public function booking() : BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }
}
