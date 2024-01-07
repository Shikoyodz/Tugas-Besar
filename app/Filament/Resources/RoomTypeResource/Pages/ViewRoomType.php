<?php

namespace App\Filament\Resources\RoomTypeResource\Pages;

use Filament\Actions;
use App\Enums\RoomStatusEnum;
use Filament\Pages\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\RoomTypeResource;

class ViewRoomType extends ViewRecord
{
    protected static string $resource = RoomTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
