<?php

namespace App\Filament\Resources\EstransaksiResource\Pages;

use App\Filament\Resources\EstransaksiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEstransaksi extends EditRecord
{
    protected static string $resource = EstransaksiResource::class;

    

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
