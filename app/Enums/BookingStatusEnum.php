<?php

namespace App\Enums;

use App\Enums\Traits\BaseEnums;

enum BookingStatusEnum : string
{
    use BaseEnums;

    case Active = 'Active';
    case Cancelled = 'Canceled';
    case Completed = 'Completed';

    public function getLabel(): ?string
    {
        return $this->name;
    }
}

