<?php

namespace App\Filament\Resources\Aspirations\Tables;

use App\Models\Aspiration;
use App\Models\Category;
use Carbon\Carbon;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;

class AspirationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->poll('10s')
            ->columns([
                TextColumn::make('nis')
                    ->label('NIS Siswa')
                    ->searchable(),
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
                TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('bulan')
                    ->label('Bulan')
                    ->options([
                        '01' => 'Januari',
                        '02' => 'Februari',
                        '03' => 'Maret',
                        '04' => 'April',
                        '05' => 'Mei',
                        '06' => 'Juni',
                        '07' => 'Juli',
                        '08' => 'Agustus',
                        '09' => 'September',
                        '10' => 'Oktober',
                        '11' => 'November',
                        '12' => 'Desember',
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query->when(
                            $data['value'],
                            fn (Builder $query, $month): Builder => $query->whereMonth('created_at', $month)
                        );
                    }),
                SelectFilter::make('id_kategori')
                    ->label('Kategori')
                    ->relationship('category', 'ket_kategori'),
            ])
            ->recordActions([
                ActionGroup::make([
                    Action::make('set_menunggu')
                        ->label('Set Menunggu')
                        ->icon('heroicon-o-clock')
                        ->color('warning')
                        ->action(function ($record) {
                            self::updateStatus($record, 'Menunggu');
                        }),
                    Action::make('set_proses')
                        ->label('Set Proses')
                        ->icon('heroicon-o-arrow-path')
                        ->color('info')
                        ->action(function ($record) {
                            self::updateStatus($record, 'Proses');
                        }),
                    Action::make('set_selesai')
                        ->label('Set Selesai')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->action(function ($record) {
                            self::updateStatus($record, 'Selesai');
                        }),
                ])->label('Ubah Status')->icon('heroicon-o-pencil-square'),

                Action::make('beri_feedback')
                    ->label('Beri Feedback')
                    ->icon('heroicon-o-chat-bubble-left-right')
                    ->color('info')
                    ->form([
                        Textarea::make('feedback')
                            ->label('Feedback')
                            ->required()
                    ])
                    ->action(function ($record, array $data) {
                        $aspiration = Aspiration::firstOrCreate(
                            ['id_pelaporan' => $record->id],
                            ['id_kategori' => $record->id_kategori, 'status' => 'Selesai']
                        );

                        $aspiration->update(['status' => 'Selesai', 'feedback' => $data['feedback']]);

                        Notification::make()
                            ->title('Feedback berhasil dikirim')
                            ->success()
                            ->send();
                    }), 
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    private static function updateStatus($record, string $status): void
    {
        // Cari atau buat record Aspiration yang terhubung
        $aspiration = Aspiration::firstOrCreate(
            ['id_pelaporan' => $record->id],
            ['id_kategori' => $record->id_kategori, 'status' => $status]
        );

        // Update status
        $aspiration->update(['status' => $status]);

        Notification::make()
            ->title('Status diubah menjadi ' . $status)
            ->success()
            ->send();
    }
}

