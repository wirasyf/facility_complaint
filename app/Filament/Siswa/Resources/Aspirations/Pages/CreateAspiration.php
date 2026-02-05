<?php

namespace App\Filament\Siswa\Resources\Aspirations\Pages;

use App\Filament\Siswa\Resources\Aspirations\AspirationResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateAspiration extends CreateRecord
{
    protected static string $resource = AspirationResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['nis'] = Auth::user()->nis;
        return $data;
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Pengaduan berhasil dibuat';
    }
}
