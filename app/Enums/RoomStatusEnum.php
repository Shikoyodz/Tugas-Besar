<?php

namespace App\Enums;

use App\Enums\Traits\BaseEnums;

enum RoomStatusEnum : string
{
    use BaseEnums;

    case Ready = 'Ready';
    case Maintenance = 'Maintenance';
    case Booked = 'Booked';

    public function getLabel(): ?string
    {
        return $this->name;
    }
}

