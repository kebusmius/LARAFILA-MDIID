<?php

namespace App\Filament\Resources\EsmdiidResource\Pages;

use App\Filament\Resources\EsmdiidResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEsmdiid extends EditRecord
{
    protected static string $resource = EsmdiidResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
