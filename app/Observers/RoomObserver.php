<?php

namespace App\Observers;

use App\Models\Room;
use App\Enums\RoomStatusEnum;

class RoomObserver
{
    public function creating(Room $room)
    {
        $room->setAttribute('status',RoomStatusEnum::Maintenance->value);
    }
}
