<?php
namespace App\Http\Controllers;

use App\Models\Pelanggancustomer;
use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelanggansController extends Controller
{
    public function updateTotalTagihan()
    {
        // Mengambil data pelanggancustomer dan menghitung total tagihan per pelanggan
        $tagihanPerPelanggan = Pelanggancustomer::select('pelanggan_id', \DB::raw('SUM(tagihan) as total_tagihan'))
            ->groupBy('pelanggan_id')
            ->get();

        // Memasukkan total tagihan ke dalam tabel pelanggan
        foreach ($tagihanPerPelanggan as $tagihan) {
            $pelanggan = Pelanggan::find($tagihan->pelanggan_id);
            if ($pelanggan) {
                $pelanggan->update(['total' => $tagihan->total_tagihan]);
            }
        }

        return redirect()->route('pelanggan.index')->with('success', 'Total tagihan berhasil diperbarui');
    }
}
?>