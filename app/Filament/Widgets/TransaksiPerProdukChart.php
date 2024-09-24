<?php

namespace App\Filament\Widgets;
use App\Models\Estransaksi;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Widgets\ChartWidget;

class TransaksiPerProdukChart extends ChartWidget
{
    use HasWidgetShield;

    protected static ?string $heading = 'Chart';

    protected static ?int $sort = 4;

    protected function getData(): array
    {
        // Ambil jumlah transaksi berdasarkan produk
        $data = Estransaksi::selectRaw('COUNT(*) as total, produk_id')
            ->with('produk') // Memuat relasi dengan produk
            ->groupBy('produk_id')
            ->get();

        // Buat array untuk label nama produk dan jumlah transaksi
        $labels = [];
        $totals = [];
        foreach ($data as $item) {
            $labels[] = $item->produk->nama; // Nama produk dari relasi
            $totals[] = $item->total; // Jumlah transaksi produk tersebut
        }

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Transaksi',
                    'data' => $totals,
                    'backgroundColor' => [
                        '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40'
                    ],
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
