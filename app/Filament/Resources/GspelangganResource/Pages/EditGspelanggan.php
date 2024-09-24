<?php

namespace App\Filament\Resources\GspelangganResource\Pages;

use App\Filament\Resources\GspelangganResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGspelanggan extends EditRecord
{
    protected static string $resource = GspelangganResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
