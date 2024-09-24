<?php

namespace App\Filament\Resources\GstransaksiResource\Pages;

use App\Filament\Resources\GstransaksiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGstransaksi extends EditRecord
{
    protected static string $resource = GstransaksiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
