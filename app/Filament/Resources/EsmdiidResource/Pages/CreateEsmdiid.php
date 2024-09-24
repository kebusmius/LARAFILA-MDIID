<?php

namespace App\Filament\Resources\EsmdiidResource\Pages;

use App\Filament\Resources\EsmdiidResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateEsmdiid extends CreateRecord
{
    protected static string $resource = EsmdiidResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    
}
