<?php

namespace App\Filament\Resources\EspelangganResource\Pages;

use App\Filament\Resources\EspelangganResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateEspelanggan extends CreateRecord
{
    protected static string $resource = EspelangganResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}


