<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataPaket; // Pastikan model ini ada

class HomeController extends Controller
{
    public function home()
    {
        // Hitung jumlah data yang masuk
        $jumlahDataMasuk = DataPaket::count();
        $jumlahDataMasukPosSecurity = DataPaket::where('lokasi', 'Pos Security')->count();
        $jumlahDataMasukRumahTangga = DataPaket::where('lokasi', 'Rumah Tangga')->count();

        // Kirim data ke view beranda
        return view('beranda', compact('jumlahDataMasuk', 'jumlahDataMasukPosSecurity', 'jumlahDataMasukRumahTangga'));
    }
    public function search(Request $request)
    {
        // Validasi input
        $request->validate([
            'resi' => 'required|string|max:255',
        ]);

        $no_resi = $request->input('resi');

        // Cari data berdasarkan no_resi
        $dataPaket = DataPaket::where('no_resi', $no_resi)->get();

        // Hitung jumlah data yang masuk
        $jumlahDataMasuk = DataPaket::count();

        // Kembalikan view dengan data yang ditemukan
        return view('beranda', compact('dataPaket', 'jumlahDataMasuk'));
    }

}
