<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use Barryvdh\DomPDF\Facade\Pdf;

class PDFController extends Controller
{
    public function exportInvoice($id)
    {
        // Ambil data invoice
        $invoice = Invoice::findOrFail($id);

        // Muat tampilan PDF
        $pdf = Pdf::loadView('pdf.invoice', ['invoice' => $invoice]);

        // Kembalikan PDF sebagai unduhan
        return $pdf->download('invoice-' . $invoice->no_invoice . '.pdf');
    }

    public function preview($id)
    {
        // Ambil data invoice
        $invoice = Invoice::findOrFail($id);

        // Muat tampilan PDF dan tampilkan di browser
        $pdf = Pdf::loadView('pdf.invoice', ['invoice' => $invoice]);

        return $pdf->stream('invoice-' . $invoice->no_invoice . '.pdf');
    }
}
