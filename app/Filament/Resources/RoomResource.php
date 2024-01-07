<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Room;
use Filament\Tables;
use App\Models\Feature;
use App\Models\RoomType;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Enums\RoomTypeEnum;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use App\Supports\ShieldPermissionTrait;
use Filament\Forms\Components\Repeater;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\BadgeColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\RoomResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\RoomResource\RelationManagers;
use Awcodes\FilamentTableRepeater\Components\TableRepeater;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;

class RoomResource extends Resource implements HasShieldPermissions
{
    use ShieldPermissionTrait;
    
    protected static ?string $model = Room::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->inlineLabel(),
                        Select::make('room_type_id')
                            ->label('Type')
                            ->required()
                            ->options(RoomType::get()->mapWithKeys(fn($item) => [$item->id => $item->name . ' - ' . money($item->price,'IDR')]))
                            ->inlineLabel(),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(), 
                BadgeColumn::make('status'),
                TextColumn::make('type.name'),
                TextColumn::make('created_at')
                    ->label('Created')
                    ->sortable()
                    ->dateTime()
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListRooms::route('/'),
            'create' => Pages\CreateRoom::route('/create'),
            'edit' => Pages\EditRoom::route('/{record}/edit'),
        ];
    }
}
