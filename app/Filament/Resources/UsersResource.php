<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UsersResource\Pages;

//use App\Filament\Resources\UsersResource\RelationManagers;
use App\Models\User;
use Closure;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class UsersResource extends Resource
{
    public static ?string $label = 'Пользователя';
    public static ?string $pluralLabel = 'Пользователи';
    protected static ?string $model = User::class;
    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(256),
                        Forms\Components\TextInput::make('first_name')
                            ->required()
                            ->maxLength(256),
                        Forms\Components\TextInput::make('last_name')
                            ->required()
                            ->maxLength(256),
                        Forms\Components\TextInput::make('password')
                            ->required()
                            ->password()
                            ->maxLength(256),

                    ])->columnSpan(8),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('first_name')->sortable(),
                Tables\Columns\TextColumn::make('last_name')->sortable(),
                Tables\Columns\TextColumn::make('email')->searchable(['first_name', 'email'])->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->sortable()
                    ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'create' => Pages\CreateUsers::route('/create'),
            'edit' => Pages\EditUsers::route('/{record}/edit'),
            'view' => Pages\ViewUser::route('/{record}'),

        ];
    }
}
