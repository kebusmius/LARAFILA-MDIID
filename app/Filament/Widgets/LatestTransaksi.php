<?php

namespace App\Filament\Widgets;

use App\Models\Estransaksi;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;

class LatestTransaksi extends BaseWidget
{
    use HasWidgetShield;

    protected static ?int $sort = 5;

    protected int | string | array $columnSpan = 'full';
    public function table(Table $table): Table
    {
        return $table
            ->query(
                Estransaksi::query()
                    ->latest('created_at') // Mengurutkan berdasarkan tanggal input terakhir
                    ->limit(10)
            )
            ->columns([
                Tables\Columns\TextColumn::make('espelanggan.esmdiid.no_account')
                    ->label('No MDIID'),
                Tables\Columns\TextColumn::make('espelanggan.no_customer')
                    ->label('No Telepon'),
                Tables\Columns\TextColumn::make('espelanggan.esmdiid.nama')
                    ->label('Perusahaan'),
                Tables\Columns\TextColumn::make('nominal')
                    ->label('Nominal')
                    ->money('idr', true), // Format sebagai mata uang
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal Transaksi')
                    ->dateTime('d/m/Y'), // Format tanggal dan waktu
            ]);
    }
}
