<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventResource\Pages;

//use App\Filament\Resources\EventResource\RelationManagers;
use App\Models\Event;
use Closure;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class EventResource extends Resource
{
    public static ?string $label = 'Мероприятие';
    public static ?string $pluralLabel = 'Мероприятия';
    protected static ?string $model = Event::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\Select::make('lector_id')
                            ->relationship(name: 'lector',
                                modifyQueryUsing: fn(
                                    Builder $query
                                ) => $query->orderBy('first_name')->orderBy('last_name')
                            )->getOptionLabelFromRecordUsing(fn(Model $record
                            ) => "{$record->first_name} {$record->last_name}")->required(),
                        Forms\Components\Select::make('category_id')
                            ->relationship(name: 'category',
                                titleAttribute: 'name')->required(),
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(2048),
                        Forms\Components\RichEditor::make('description')
                            ->required(),
                        Forms\Components\Toggle::make('active')
                            ->required(),
                        Forms\Components\DatePicker::make('date')
                            ->required(),
                        Forms\Components\TimePicker::make('time')->seconds(false)
                            ->required(),
                        Forms\Components\TextInput::make('duration')
                            ->required(),
                        Forms\Components\Select::make('type')
                            ->options($options = ['online', 'offline']),
                        Forms\Components\Repeater::make('sources')
                            ->relationship()
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->required(),
                                Forms\Components\TextInput::make('link')
                                    ->required()
                            ])
                            ->columns(2),
                        Forms\Components\Repeater::make('questions')
                            ->relationship()
                            ->schema([
                                Forms\Components\TextInput::make('message')
                                    ->disabled(),
                                Forms\Components\TextInput::make('votes')
                                    ->disabled()
                            ])
                            ->columns(2),
//                            ->itemLabel(fn(array $state): ?string => $state['name'] ?? null)
//                        Forms\Components\Select::make('sources')
//                            ->relationship('sources', titleAttribute: 'name')
//                            ->createOptionForm([
//                                Forms\Components\TextInput::make('name')
//                                    ->required(),
//                                Forms\Components\TextInput::make('link')
//                                    ->required()
//                            ]),
                        Forms\Components\TextInput::make('link'),
                        Forms\Components\TextInput::make('record_link'),
                        Forms\Components\TextInput::make('max_participants')->integer(),
                    ])->columnSpan(8),

                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\FileUpload::make('main_image'),
                    ])->columnSpan(4)
            ])->columns(12);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->searchable(['title', 'description'])->sortable(),

                Tables\Columns\TextColumn::make('lector.full_name'),
                Tables\Columns\TextColumn::make('category.name'),
                Tables\Columns\TextColumn::make('date')
                    ->date(),
                Tables\Columns\TextColumn::make('time')
                    ->time(format: 'h:m'),

                Tables\Columns\IconColumn::make('active')
                    ->sortable()
                    ->boolean(),
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
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
        ];
    }
}
