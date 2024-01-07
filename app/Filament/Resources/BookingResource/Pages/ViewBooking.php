<?php

namespace App\Filament\Resources\BookingResource\Pages;

use Filament\Actions;
use App\Enums\BookingStatusEnum;
use Filament\Pages\Actions\Action;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\BookingResource;

class ViewBooking extends ViewRecord
{
    protected static string $resource = BookingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('Cancel')
                ->label('Cancel Booking')
                ->color('danger')
                ->icon('heroicon-o-exclamation-triangle')
                ->action(fn() => $this->record->update([
                    'status' => BookingStatusEnum::Cancelled->value
                ]))
                ->visible($this->record->status == BookingStatusEnum::Active->value)
                ->requiresConfirmation(),
            Actions\EditAction::make(),
        ];
    }
}
