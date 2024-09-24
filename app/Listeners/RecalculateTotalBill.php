<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\CalculateTotalBill;


class RecalculateTotalBill
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(CalculateTotalBill $event)
    {
        $pelanggan = $event->pelanggan;
        $totalTagihan = $pelanggan->pelanggancustomers()->sum('tagihan');
        $pelanggan->update(['total' => $totalTagihan]);
    }
}
