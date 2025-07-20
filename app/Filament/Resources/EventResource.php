<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventResource\Pages;
use App\Filament\Resources\EventResource\RelationManagers;
use App\Models\Event;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;
    protected static ?string $navigationIcon = 'heroicon-s-calendar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Utama')
                    ->description('Detail dasar mengenai acara.')
                    ->schema([
                        Forms\Components\TextInput::make('name')->required()->live(onBlur: true),
                        Forms\Components\TextInput::make('slug')->required()->unique(ignoreRecord: true),
                        Forms\Components\DateTimePicker::make('event_time')->required(),
                    ])->columns(2),

                Forms\Components\Section::make('Lokasi')
                    ->schema([
                        Forms\Components\TextInput::make('venue')->label('Nama Tempat/Venue')->required(),
                        Forms\Components\TextInput::make('city')->label('Kota')->required(),
                    ])->columns(2),

                Forms\Components\RichEditor::make('description')
                    ->label('Deskripsi Acara')
                    ->columnSpanFull(),

                Forms\Components\Section::make('Lineup Band')
                    ->schema([
                        Forms\Components\Select::make('bands')
                            ->relationship('bands', 'name')
                            ->multiple() // <-- Kunci untuk multi-select
                            ->searchable() // <-- UX: Memungkinkan admin mencari nama band
                            ->required(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('city')->searchable(),
                Tables\Columns\TextColumn::make('event_time')->dateTime()->sortable(),
            ])
            ->defaultSort('event_time', 'desc')
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
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
        ];
    }
}
