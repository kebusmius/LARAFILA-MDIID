<?php

namespace App\Filament\Resources\EspelangganResource\Pages;

use App\Models\Espelanggan;
use App\Filament\Resources\EsmdiidResource;
use App\Filament\Resources\EspelangganResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use pxlrbt\FilamentExcel\Actions\Pages\ExportAction;
use Konnco\FilamentImport\Actions\ImportField;
use Konnco\FilamentImport\Actions\ImportAction;

class ListEspelanggans extends ListRecords
{
    protected static string $resource = EspelangganResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('New Pelanggan'),

            ImportAction::make() 
                ->color('info')
                ->uniqueField('no_customer')
                ->fields([
                    //ImportField::make('pelanggan.no_account'),
                    ImportField::make('esmdiid.no_account')
                        ->label('No MDIID'), // Mengubah label dari "Category name" menjadi "Pelanggan Name"
                    ImportField::make('no_customer')
                        ->label('No Telepon'),
                ])
                ->handleRecordCreation(function(array $data) {
                        // Validate no_customer to ensure it's a string
                        $noCustomer = strval($data['no_customer']);
                        
                        // Ensure no_customer is exactly 11 digits
                        if (strlen($noCustomer) > 15) {
                        throw new \Exception("NO TELEPON should be at most 15 digits.");
                        }
                        
                        if ($esmdiid = EsmdiidResource::getEloquentQuery()->where('no_account', $data['esmdiid']['no_account'])->first()) {
                        return Espelanggan::create([
                        'esmdiid_id' => $esmdiid->id,
                        'no_customer' => $noCustomer,
                        ]);
                        }

                    return new Espelanggan();
                }),

            ExportAction::make() 
                ->color('success')
                ->exports([
                    ExcelExport::make()
                        ->fromTable()
                        ->withFilename(fn ($resource) => $resource::getModelLabel() . '-' . date('Y-m-d'))
                        ->withWriterType(\Maatwebsite\Excel\Excel::XLSX)
                        
                ]),
        ];
    }
}
