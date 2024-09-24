<?php

namespace App\Filament\Resources\GspelangganResource\Pages;

use App\Models\Gspelanggan;
use App\Filament\Resources\GsmdiidResource;
use App\Filament\Resources\GspelangganResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Konnco\FilamentImport\Actions\ImportField;
use Konnco\FilamentImport\Actions\ImportAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use pxlrbt\FilamentExcel\Actions\Pages\ExportAction;

class ListGspelanggans extends ListRecords
{
    protected static string $resource = GspelangganResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            ImportAction::make()
                ->handleBlankRows(true)
                ->fields([
                    ImportField::make('gsmdiid.no_account')
                        ->label('NO MDIID'), 
                    ImportField::make('no_customer')
                        ->label('NO TELEPON'),
                    
                ])
                ->handleRecordCreation(function(array $data) {
                    // Validate no_customer to ensure it's a string
                    $noCustomer = strval($data['no_customer']);
                    
                    // Ensure no_customer is exactly 11 digits
                    if (strlen($noCustomer) > 15) {
                    throw new \Exception("NO TELEPON should be at most 15 digits.");
                    }
                    
                    if ($gsmdiid = GsmdiidResource::getEloquentQuery()->where('no_account', $data['gsmdiid']['no_account'])->first()) {
                    return Gspelanggan::create([
                    'gsmdiid_id' => $gsmdiid->id,
                    'no_customer' => $noCustomer,
                    ]);
                    }
 
                    return new Gspelanggan();
                }),

            ExportAction::make() 
                ->exports([
                    ExcelExport::make()
                        ->fromTable()
                        ->withFilename(fn ($resource) => $resource::getModelLabel() . '-' . date('Y-m-d'))
                        ->withWriterType(\Maatwebsite\Excel\Excel::XLSX)
                        
                ]),
        ];
    }
}
