<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Accomodation;
use Filament\Resources\Resource;
use App\Supports\ShieldPermissionTrait;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\AccomodationResource\Pages;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;
use App\Filament\Resources\AccomodationResource\RelationManagers;

class AccomodationResource extends Resource implements HasShieldPermissions
{
    use ShieldPermissionTrait;
    
    protected static ?string $model = Accomodation::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->inlineLabel()
                    ->columnSpanFull()
                    ->required(),
                TextInput::make('price')
                    ->prefix('RP.')
                    ->inlineLabel()
                    ->columnSpanFull()
                    ->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('price')
                    ->money('RP.')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Created')
                    ->sortable()
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->modalWidth('md'),
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
            'index' => Pages\ListAccomodations::route('/'),
            // 'create' => Pages\CreateAccomodation::route('/create'),
            // 'edit' => Pages\EditAccomodation::route('/{record}/edit'),
        ];
    }
}
