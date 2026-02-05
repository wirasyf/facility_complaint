<?php

namespace App\Filament\Siswa\Resources\Aspirations;

use App\Filament\Siswa\Resources\Aspirations\Pages\CreateAspiration;
use App\Filament\Siswa\Resources\Aspirations\Pages\EditAspiration;
use App\Filament\Siswa\Resources\Aspirations\Pages\ListAspirations;
use App\Filament\Siswa\Resources\Aspirations\Schemas\AspirationForm;
use App\Filament\Siswa\Resources\Aspirations\Tables\AspirationsTable;
use App\Models\InputAspiration;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AspirationResource extends Resource
{
    protected static ?string $model = InputAspiration::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'aspirasi';

    public static function form(Schema $schema): Schema
    {
        return AspirationForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AspirationsTable::configure($table);
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
            'index' => ListAspirations::route('/'),
            'create' => CreateAspiration::route('/create'),
            'edit' => EditAspiration::route('/{record}/edit'),
        ];
    }
}
