<?php

namespace App\Filament\Resources\Aspirations;

use App\Filament\Resources\Aspirations\Pages\ListAspirations;
use App\Filament\Resources\Aspirations\Schemas\AspirationForm;
use App\Filament\Resources\Aspirations\Tables\AspirationsTable;
use App\Models\Aspiration;
use App\Models\InputAspiration;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class AspirationResource extends Resource
{
    protected static ?string $model = InputAspiration::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::ChatBubbleBottomCenterText;

    protected static string | UnitEnum | null $navigationGroup = 'Aspiration';

    protected static ?string $navigationLabel = 'Pengaduan';

    protected static ?string $modelLabel = 'Pengaduan';

    protected static ?string $pluralModelLabel = 'Pengaduan';

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

    public static function canCreate(): bool
    {
        return false;
    }

    public static function getNavigationBadge(): ?string
    {
        $pendingCount = InputAspiration::whereDoesntHave('aspiration')
            ->orWhereHas('aspiration', fn ($query) => $query->where('status', 'Menunggu'))
            ->count();

        return $pendingCount > 0 ? (string) $pendingCount : null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning';
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAspirations::route('/'),
        ];
    }
}

