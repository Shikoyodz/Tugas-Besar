<?php

namespace App\Filament\Resources\AccomodationResource\Pages;

use App\Filament\Resources\AccomodationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAccomodation extends EditRecord
{
    protected static string $resource = AccomodationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
