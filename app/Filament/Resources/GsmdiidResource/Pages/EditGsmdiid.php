<?php

namespace App\Filament\Resources\GsmdiidResource\Pages;

use App\Filament\Resources\GsmdiidResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGsmdiid extends EditRecord
{
    protected static string $resource = GsmdiidResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
