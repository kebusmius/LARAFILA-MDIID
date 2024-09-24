<?php

namespace App\Filament\Resources\EstransaksiResource\Pages;

use App\Models\Estransaksi;
use App\Filament\Resources\EspelangganResource;
use App\Filament\Resources\EstransaksiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Konnco\FilamentImport\Actions\ImportField;
use Konnco\FilamentImport\Actions\ImportAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use pxlrbt\FilamentExcel\Actions\Pages\ExportAction;

class ListEstransaksis extends ListRecords
{
    protected static string $resource = EstransaksiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('New Transaksi'),
            
            ImportAction::make()
                ->color('info')
                ->handleBlankRows(true)
                ->fields([
                    ImportField::make('espelanggan.no_customer')
                        ->label('NO TELEPON'), 
                    ImportField::make('nominal')
                        ->label('TAGIHAN'),
                    ImportField::make('bulan')
                        ->label('BULAN (Format: Y-m-d, Contoh: 2024-08-26, Pastikan di Excel sebagai teks)'),
                    
                ])
                ->handleRecordCreation(function(array $data) { 
                    if ($espelanggan = EspelangganResource::getEloquentQuery()->where('no_customer', $data['espelanggan']['no_customer'])->first()) {
                        
                        // Convert the 'bulan' value to Y-m-d format regardless of input format
                        $bulan = date('Y-m-d', strtotime($data['bulan']));
                        
                        return Estransaksi::create([
                            'espelanggan_id' => $espelanggan->id,
                            'nominal' => $data['nominal'],
                            'bulan' => $bulan,
                        ]);
                    }
 
                    return new Estransaksi();
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
