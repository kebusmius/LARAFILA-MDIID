<?php

namespace App\Filament\Resources\ProdukResource\Pages;

use App\Filament\Resources\ProdukResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewProduk extends ViewRecord
{
    protected static string $resource = ProdukResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('back')
            ->label('Back') // Teks tombol
            ->icon('heroicon-s-arrow-left') // Icon pada tombol (opsional)
            ->color('primary') // Warna tombol (opsional)
            ->url(url()->previous()) // URL yang mengarah ke halaman sebelumnya
            ->button(),
        ];
    }
}
