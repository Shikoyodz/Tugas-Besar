<?php

namespace App\Enums;

use App\Enums\Traits\BaseEnums;

enum RoomTypeEnum : string
{
    use BaseEnums;

    case Deluxe = 'Deluxe';
    case Executive = 'Executive';
    case Residential = 'Residential';

    public function getLabel(): ?string
    {
        return $this->name;
    }
}

