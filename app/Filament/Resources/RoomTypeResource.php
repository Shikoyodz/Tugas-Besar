<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Feature;
use App\Models\RoomType;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use App\Supports\ShieldPermissionTrait;
use Filament\Forms\Components\Repeater;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\RoomTypeResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use App\Filament\Resources\RoomTypeResource\RelationManagers;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;

class RoomTypeResource extends Resource implements HasShieldPermissions
{
    use ShieldPermissionTrait;
    
    protected static ?string $model = RoomType::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('preview')
                            ->collection('preview')
                            ->required(),
                        TextInput::make('name')
                            ->required()
                            ->inlineLabel(),
                        TextInput::make('price')
                            ->required()
                            ->inlineLabel()
                            ->numeric()
                            ->prefix('Rp.'),
                        TextInput::make('capacity')
                            ->required()
                            ->inlineLabel()
                            ->numeric(),
                        Repeater::make('features')
                            ->relationship('roomTypeFeatures')
                            ->columns(2)
                            ->minItems(0)
                            ->schema([
                                Select::make('feature_id')
                                    ->columnSpan(1)
                                    ->label('Feature')
                                    ->options(Feature::pluck('name','id'))
                                    ->required(),
                                TextInput::make('qty')
                                    ->numeric()
                                    ->columnSpan(1)
                                    ->label('Quantity')
                                    ->required()
                            ])
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('price')
                    ->money('Rp.')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Created')
                    ->sortable()
                    ->dateTime()
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListRoomTypes::route('/'),
            'create' => Pages\CreateRoomType::route('/create'),
            'view' => Pages\ViewRoomType::route('/{record}'),
            'edit' => Pages\EditRoomType::route('/{record}/edit'),
        ];
    }
}
