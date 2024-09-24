<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pelanggancustomer; // Gantikan TabelAsal dengan model yang sesuai

class pelangganController extends Controller
{
    public function index($no_account)
    {
        // Ambil data dari database berdasarkan nomor akun
        $data = TabelAsal::where('no_account', $no_account)->get();
        
        // Kemudian, tampilkan tabel asal atau lakukan aksi yang sesuai
        return models('pelanggan', ['data' => $data]); // Gantikan 'tabel_asal' dengan nama view yang sesuai
    }
}
