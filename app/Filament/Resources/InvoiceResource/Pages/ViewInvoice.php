<?php

namespace App\Filament\Resources\InvoiceResource\Pages;

use App\Filament\Resources\InvoiceResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewInvoice extends ViewRecord
{
    protected static string $resource = InvoiceResource::class;

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
