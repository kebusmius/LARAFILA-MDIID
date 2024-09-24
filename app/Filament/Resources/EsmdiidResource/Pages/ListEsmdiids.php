<?php

namespace App\Filament\Resources\EsmdiidResource\Pages;

use App\Filament\Resources\EsmdiidResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Konnco\FilamentImport\Actions\ImportField;
use Konnco\FilamentImport\Actions\ImportAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use pxlrbt\FilamentExcel\Actions\Pages\ExportAction;

class ListEsmdiids extends ListRecords
{
    protected static string $resource = EsmdiidResource::class;
    
    protected function getHeaderActions(): array
    {
        return [
            
            Actions\CreateAction::make()
                ->label('New Perusahaan'),

            ImportAction::make() 
                ->uniqueField('no_account')
                ->color('info')
                ->fields([
                    ImportField::make('no_account')
                        ->label('No Account')
                        ->required(),
                    ImportField::make('nama')
                        //->required()
                        ->label('Nama Perusahaan'),
                    ImportField::make('pph')
                        ->label('PPH')
                        ->required(),
                ]),
            
            
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
