<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LectorResource\Pages;
use App\Filament\Resources\LectorResource\RelationManagers;
use App\Models\Lector;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LectorResource extends Resource
{
    public static ?string $label = 'Лектор';
    public static ?string $pluralLabel = 'Лекторы';

    protected static ?string $model = Lector::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\TextInput::make('first_name')
                            ->required()
                            ->maxLength(256),
                        Forms\Components\TextInput::make('last_name')
                            ->required()
                            ->maxLength(256),
                        Forms\Components\TextInput::make('info')
                            ->maxLength(256),
                        Forms\Components\TextInput::make('description'),
                        Forms\Components\TextInput::make('contact_link')
                            ->maxLength(256),
                        Forms\Components\TextInput::make('contact_telegram')
                            ->maxLength(256),
                        Forms\Components\TextInput::make('contact_email')
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
                Tables\Columns\TextColumn::make('contact_email')->searchable(['first_name', 'email'])->sortable(),
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
            'index' => Pages\ListLectors::route('/'),
            'create' => Pages\CreateLector::route('/create'),
            'edit' => Pages\EditLector::route('/{record}/edit'),
        ];
    }
}
