<?php

namespace App\Filament\Resources\EstransaksiResource\Pages;

use App\Filament\Resources\EstransaksiResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateEstransaksi extends CreateRecord
{
    protected static string $resource = EstransaksiResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
