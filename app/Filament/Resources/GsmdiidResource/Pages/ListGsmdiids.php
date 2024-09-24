<?php

namespace App\Filament\Resources\GsmdiidResource\Pages;

use App\Filament\Resources\GsmdiidResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Konnco\FilamentImport\Actions\ImportField;
use Konnco\FilamentImport\Actions\ImportAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use pxlrbt\FilamentExcel\Actions\Pages\ExportAction;

class ListGsmdiids extends ListRecords
{
    protected static string $resource = GsmdiidResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            ImportAction::make() 
                ->uniqueField('nama')
                ->fields([
                    ImportField::make('no_account')
                        ->label('No MDIID'),
                        //->required(),
                    ImportField::make('nama')
                        //->required()
                        ->label('Nama'),
                    //ImportField::make('total'),
                        //->required(),
                    ImportField::make('pph')
                        ->label('PPH'),
                        //->required(),
                ]),
                
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
