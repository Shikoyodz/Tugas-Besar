<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Booking;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use App\Supports\ShieldPermissionTrait;
use Filament\Forms\Components\Fieldset;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Placeholder;
use App\Filament\Resources\BookingResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\BookingResource\RelationManagers;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;

class BookingResource extends Resource implements HasShieldPermissions
{
    use ShieldPermissionTrait;
    
    protected static ?string $model = Booking::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(12)
                    ->schema([
                        Section::make()
                            ->label('Booking Information')
                            ->columnSpan([
                                'default' => 12,
                                'md' => 9
                            ])
                            ->schema([
                                Placeholder::make('user')
                                    ->label('Customer')
                                    ->inlineLabel()
                                    ->content(fn(?Model $record) => $record->user?->name),
                                Placeholder::make('room_type')
                                    ->label('Room Type')
                                    ->inlineLabel()
                                    ->content(fn(?Model $record) => $record->room_type),
                                Placeholder::make('room_name')
                                    ->label('Room Name')
                                    ->inlineLabel()
                                    ->content(fn(?Model $record) => $record->room_name),
                                Placeholder::make('status')
                                    ->label('Status')
                                    ->inlineLabel()
                                    ->content(fn(?Model $record) => $record->status),
                                Placeholder::make('check_in')
                                    ->label('Check In')
                                    ->inlineLabel()
                                    ->content(fn(?Model $record) => \Carbon\Carbon::parse($record->check_in)->format('d M Y')),
                                Placeholder::make('check_out')
                                    ->label('Check Out')
                                    ->inlineLabel()
                                    ->content(fn(?Model $record) => \Carbon\Carbon::parse($record->check_out)->format('d M Y')),
                                Fieldset::make('billing-detail')
                                    ->label('Billing Details')
                                    ->schema([
                                        Placeholder::make('name')
                                            ->label('Name')
                                            ->inlineLabel()
                                            ->content(fn(?Model $record) => $record->billingDetail->name),
                                        Placeholder::make('phone')
                                            ->label('Phone')
                                            ->inlineLabel()
                                            ->content(fn(?Model $record) => $record->billingDetail->phone),
                                        Placeholder::make('email')
                                            ->label('Email')
                                            ->inlineLabel()
                                            ->content(fn(?Model $record) => $record->billingDetail->email),
                                        Placeholder::make('card_number')
                                            ->label('Card Number')
                                            ->inlineLabel()
                                            ->content(fn(?Model $record) => $record->billingDetail->card_number),
                                        Placeholder::make('vcc')
                                            ->label('VCC')
                                            ->inlineLabel()
                                            ->content(fn(?Model $record) => $record->billingDetail->vcc),
                                        Placeholder::make('booking')
                                            ->label('Booking For ')
                                            ->inlineLabel()
                                            ->content(fn(?Model $record) => $record->billingDetail->qty . ' / Night'),
                                        Placeholder::make('price')
                                            ->label('Price')
                                            ->inlineLabel()
                                            ->content(fn(?Model $record) => money($record->billingDetail->price,'IDR')),
                                        Placeholder::make('accomodation_total')
                                            ->label('Accomodation')
                                            ->inlineLabel()
                                            ->content(fn(?Model $record) => money($record->billingDetail->accomodation_total,'IDR')),
                                        Placeholder::make('tax')
                                            ->label('TAX')
                                            ->inlineLabel()
                                            ->content(fn(?Model $record) => money($record->billingDetail->tax,'IDR')),
                                        Placeholder::make('total')
                                            ->label('Total')
                                            ->inlineLabel()
                                            ->content(fn(?Model $record) => money($record->billingDetail->total,'IDR')),
                                    ])
                            ]),
                        Card::make()
                            ->columnSpan([
                                'default' => 12,
                                'md' => 3
                            ])
                            ->schema([
                                Placeholder::make('created_at')
                                    ->label('Created')
                                    ->inlineLabel()
                                    ->content(fn(?Model $record) => $record->created_at),
                                Placeholder::make('updated_at')
                                    ->label('Updated')
                                    ->inlineLabel()
                                    ->content(fn(?Model $record) => $record->created_at)
                            ])
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('billingDetail.name')
                    ->searchable(),
                TextColumn::make('room_type')
                    ->searchable()
                    ->label('Type'),
                TextColumn::make('room_name')
                    ->searchable()
                    ->label('Room'),
                TextColumn::make('status')
                    ->label('Status'),
                TextColumn::make('check_in')
                    ->sortable()
                    ->label('Checkin')
                    ->dateTime(),
                TextColumn::make('check_out')
                    ->sortable()
                    ->label('Checkout')
                    ->dateTime(),
                TextColumn::make('billingDetail.qty')
                    ->sortable()
                    ->suffix(' / Night')
                    ->label('Booking'),
                TextColumn::make('billingDetail.total')
                    ->label('Total')
                    ->money('Rp.')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->sortable()
                    ->label('Created')
                    ->dateTime()
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                // Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBookings::route('/'),
            // 'create' => Pages\CreateBooking::route('/create'),
            'view' => Pages\ViewBooking::route('/{record}'),
            // 'edit' => Pages\EditBooking::route('/{record}/edit'),
        ];
    }
}
