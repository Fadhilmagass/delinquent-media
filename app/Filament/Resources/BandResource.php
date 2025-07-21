<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Band;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\BandResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\BandResource\RelationManagers;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class BandResource extends Resource
{
    protected static ?string $model = Band::class;
    protected static ?string $navigationIcon = 'heroicon-o-musical-note';
    protected static ?string $navigationGroup = 'Band Management';

    public static function canViewAny(): bool
    {
        return auth()->user()->hasRole('admin|editor');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required()->unique(ignoreRecord: true),
                TextInput::make('origin')->required(),
                TextInput::make('genre')->required(),
                Textarea::make('bio')->columnSpanFull(),
                SpatieMediaLibraryFileUpload::make('band_photo')
                    ->collection('band_photos') // Nama koleksi media
                    ->image()
                    ->imageEditor(),
                Forms\Components\Section::make('Link Media Sosial')
                    ->schema([
                        Forms\Components\TextInput::make('website_url')->label('Website')->url(),
                        Forms\Components\TextInput::make('bandcamp_url')->label('Bandcamp')->url(),
                        Forms\Components\TextInput::make('spotify_url')->label('Spotify')->url(),
                    ])->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\SpatieMediaLibraryImageColumn::make('band_photo')
                    ->collection('band_photos'),
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('origin')->searchable(),
                Tables\Columns\TextColumn::make('genre')->searchable(),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable(),
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
            RelationManagers\ReleasesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBands::route('/'),
            'create' => Pages\CreateBand::route('/create'),
            'edit' => Pages\EditBand::route('/{record}/edit'),
        ];
    }
}
