<?php

namespace App\Filament\Siswa\Resources\Aspirations\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;

class AspirationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('lokasi')
                    ->label('Lokasi')
                    ->required(),
                Textarea::make('ket')
                    ->label('Keterangan')
                    ->required(),
                Select::make('id_kategori')
                    ->label('Kategori')
                    ->relationship('category', 'ket_kategori')
                    ->required(),

            ]);
    }
}
