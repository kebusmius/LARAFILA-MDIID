<?php

namespace App\Filament\Resources\GstransaksiResource\Pages;

use App\Models\Gstransaksi;
use App\Filament\Resources\GspelangganResource;
use App\Filament\Resources\GstransaksiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Konnco\FilamentImport\Actions\ImportField;
use Konnco\FilamentImport\Actions\ImportAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use pxlrbt\FilamentExcel\Actions\Pages\ExportAction;


class ListGstransaksis extends ListRecords
{
    protected static string $resource = GstransaksiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            ImportAction::make()
                ->handleBlankRows(true)
                ->fields([
                    ImportField::make('gspelanggan.no_customer')
                        ->label('No Telepon'), // Mengubah label dari "Category name" menjadi "Pelanggan Name"
                    ImportField::make('nominal')
                        ->label('Tagihan'),
                    ImportField::make('bulan')
                        ->label('Bulan (Y-m-d)'),
                    
                ])
                ->handleRecordCreation(function(array $data) { 
                    if ($gspelanggan = GspelangganResource::getEloquentQuery()->where('no_customer', $data['gspelanggan']['no_customer'])->first()) {
                        return Gstransaksi::create([
                            'gspelanggan_id' => $gspelanggan->id,
                            'nominal' => $data['nominal'],
                            'bulan' => date('Y-m-d', strtotime($data['bulan'])),
                            
                            
                        ]);
                    }
 
                    return new Gstransaksi();
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
