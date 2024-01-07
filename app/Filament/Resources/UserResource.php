<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Support\HtmlString;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use App\Supports\ShieldPermissionTrait;
use Filament\Tables\Columns\TagsColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Placeholder;
use App\Filament\Resources\UserResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\UserResource\RelationManagers;
use Phpsa\FilamentPasswordReveal\Password as FilamentPassword;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;

class UserResource extends Resource implements HasShieldPermissions
{
    use ShieldPermissionTrait;
    
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(12)
                    ->schema([
                        Card::make()
                            ->columnSpan([
                                'default' => 12,
                                'md' => 9
                            ])
                            ->schema([
                                TextInput::make('name')
                                    ->label('Name')
                                    ->inlineLabel()
                                    ->required(),
                                TextInput::make('email')
                                    ->label('Email')
                                    ->email()
                                    ->inlineLabel()
                                    ->unique(ignoreRecord: true)
                                    ->required(),
                                TextInput::make('phone')
                                    ->label('Phone')
                                    ->inlineLabel()
                                    ->mask('(99) 999999999999'),
                                Select::make('roles')
                                    ->multiple()
                                    ->inlineLabel()
                                    ->relationship('roles','name')
                                    ->required(),
                                Section::make('Danger Zone')
                                    ->collapsible()
                                    ->columns(2)
                                    ->schema([
                                        FilamentPassword::make('password')
                                            ->same('passwordConfirmation')
                                            ->password()
                                            ->columnSpan(1)
                                            ->dehydrated(fn($state) => (!empty($state)) ? true : false) 
                                            ->maxLength(255)
                                            ->required(fn ($component, $get, $livewire, $model, $record, $set, $state) => $record === null)
                                            ->dehydrateStateUsing(fn ($state) => ! empty($state) ? Hash::make($state) : ''),
                                        FilamentPassword::make('passwordConfirmation')
                                            ->password()
                                            ->columnSpan(1)
                                            ->dehydrated(false)
                                            ->maxLength(255),
                                    ])
                            ]),
                        Card::make()
                            ->columnSpan([
                                'default' => 12,
                                'md' => 3
                            ])
                            ->hiddenOn(['create'])
                            ->schema([
                                Placeholder::make('information_header')
                                    ->disableLabel()
                                    ->content(new HtmlString('<strong>Information</strong>')),
                                Placeholder::make('created_at')
                                    ->label('Created')
                                    ->content(fn(Model $record) => $record->created_at),
                                Placeholder::make('updated_at')
                                    ->label('Updated')
                                    ->content(fn(Model $record) => $record->updated_at)
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
                TextColumn::make('email')
                    ->searchable(),
                TextColumn::make('phone')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Created')
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
