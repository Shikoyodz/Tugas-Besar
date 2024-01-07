<?php

namespace App\Observers;

use App\Models\Booking;
use App\Enums\RoomStatusEnum;

class BookingObserver
{
    public function created(Booking $booking)
    {
        $booking->room()->update([
            'status' => RoomStatusEnum::Booked->value
        ]);
    }
}
