<?php

namespace App\Filament\Widgets;

use App\Models\Estransaksi;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;

class EstransaksiChart extends ChartWidget
{
    protected static ?int $sort = 3;

    protected static ?string $heading = 'Report Harian Berdasarkan Bulan';

    protected function getData(): array
    {
        // Ambil periode dari query string atau default ke 'daily'
        $periode = request()->query('periode', 'daily');

        if ($periode !== 'daily') {
            $periode = 'daily';
        }

        // Ambil rentang tanggal dari query string
        $startDate = request()->query('start_date');
        $endDate = request()->query('end_date');

        // Query untuk report harian berdasarkan field bulan
        $query = Estransaksi::query()
            ->selectRaw('bulan as period, SUM(nominal) as total')
            ->groupBy('bulan')
            ->orderBy('bulan');

        if ($startDate) {
            $query->whereDate('bulan', '>=', $startDate);
        }

        if ($endDate) {
            $query->whereDate('bulan', '<=', $endDate);
        }

        $transaksi = $query->get();

        $labels = [];
        $totals = [];

        foreach ($transaksi as $data) {
            $labels[] = Carbon::parse($data->period)->format('d M Y'); // Format tanggal
            $totals[] = $data->total;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Total Nilai Transaksi Harian',
                    'data' => $totals,
                    'backgroundColor' => 'rgba(245, 158, 11, 0.1)',
                    'borderColor' => '#f59e0b',
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line'; // Menggunakan bar chart
    }
}
