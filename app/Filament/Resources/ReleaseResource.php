<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Release;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Enums\Release\Type;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\ReleaseResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use App\Filament\Resources\ReleaseResource\RelationManagers;
use Filament\Forms\Components\Repeater;
use Illuminate\Support\Str;

class ReleaseResource extends Resource
{
    protected static ?string $model = Release::class;
    protected static ?string $navigationIcon = 'heroicon-m-check-badge';
    protected static ?string $navigationGroup = 'Band Management';

    public static function canViewAny(): bool
    {
        return auth()->user()->hasRole('admin|editor');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('band_id')
                    ->relationship('band', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\TextInput::make('title')->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (string $operation, $state, Forms\Set $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),
                Forms\Components\Select::make('type')->options(Type::class)->required(),
                Forms\Components\DatePicker::make('release_date')->required(),
                SpatieMediaLibraryFileUpload::make('release_cover')
                    ->collection('release_covers')
                    ->image()
                    ->imageEditor()
                    ->columnSpanFull(),
                Repeater::make('tracks')
                    ->relationship()
                    ->schema([
                        Forms\Components\TextInput::make('track_number')->numeric()->required()->label('No.'),
                        Forms\Components\TextInput::make('title')->required(),
                        Forms\Components\TextInput::make('duration')->label('Duration (e.g., 3:45)'),
                    ])
                    ->orderColumn('track_number')
                    ->reorderableWithButtons()
                    ->columns(3)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('band.name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('type')->badge(),
                Tables\Columns\TextColumn::make('release_date')->date()->sortable(),
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
            'index' => Pages\ListReleases::route('/'),
            'create' => Pages\CreateRelease::route('/create'),
            'edit' => Pages\EditRelease::route('/{record}/edit'),
        ];
    }
}
