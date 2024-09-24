<?php

namespace App\Filament\Widgets;

use App\Models\Gsmdiid;
use App\Models\Gspelanggan;
use App\Models\Esmdiid;
use App\Models\Espelanggan;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;

class StatsOverview extends BaseWidget
{
    use HasWidgetShield;
    
    protected static ?int $sort = 2;
    protected function getStats(): array
    {
        return [
            Stat::make('Pelanggan ES', Esmdiid::count())
                ->description('Total Pelanggan ES')
                ->descriptionIcon('heroicon-m-user-group', IconPosition::Before)
                ->chart([8, 2, 10, 3, 15, 4, 17])
                ->color('success'),
            Stat::make('Telepon ES', Espelanggan::count())
                ->description('Total Telepon ES')
                ->descriptionIcon('heroicon-s-phone', IconPosition::Before)
                ->color('info'),
                Stat::make('Total Transaksi', number_format(\App\Models\Estransaksi::sum('nominal'), 0, ',', '.'))
                ->description('Total Penjumlahan Transaksi')
                ->descriptionIcon('heroicon-m-currency-dollar', IconPosition::Before)
                ->color('success'),
        ];
    }
}
