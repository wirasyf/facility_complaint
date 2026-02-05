<?php

namespace App\Filament\Siswa\Resources\Aspirations\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class AspirationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('category.ket_kategori')
                    ->label('Kategori')
                    ->badge()
                    ->searchable(),
                TextColumn::make('lokasi')
                    ->label('Lokasi')
                    ->searchable(),
                TextColumn::make('ket')
                    ->label('Keterangan')
                    ->limit(30)
                    ->searchable(),
                TextColumn::make('aspiration.status')
                    ->label('Status')
                    ->badge()
                    ->default('Menunggu')
                    ->color(fn ($state): string => match ($state) {
                        'Menunggu' => 'warning',
                        'Proses' => 'info',
                        'Selesai' => 'success',
                        default => 'warning',
                    }),
                TextColumn::make('aspiration.feedback')
                    ->label('Feedback')
                    ->limit(30)
                    ->default('-')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
