<?php

namespace App\Filament\Resources\RoomResource\Pages;

use Filament\Actions;
use App\Enums\RoomStatusEnum;
use Filament\Pages\Actions\Action;
use Filament\Forms\Components\Select;
use App\Filament\Resources\RoomResource;
use Filament\Resources\Pages\EditRecord;

class EditRoom extends EditRecord
{
    protected static string $resource = RoomResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('change_status')
                ->label('Change Status')
                ->requiresConfirmation()
                ->modalWidth('sm')
                ->form([
                    Select::make('status')
                        ->label('Status')
                        ->options(RoomStatusEnum::toOptions())
                        ->required()
                ])
                ->action(fn($data) => $this->record->update(['status' => data_get($data,'status')])),
            Actions\DeleteAction::make(),
        ];
    }
}
