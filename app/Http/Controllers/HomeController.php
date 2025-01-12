<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataPaket; // Ensure this model exists

class HomeController extends Controller
{
    public function home()
    {
        // Menghitung jumlah data paket
        $jumlahDataMasuk = DataPaket::count();
        $jumlahDataMasukPosSecurity = DataPaket::where('lokasi', 'Pos Security')->count();
        $jumlahDataMasukRumahTangga = DataPaket::where('lokasi', 'Rumah Tangga')->count();

        // Mengirim data di view
        return view('beranda', compact('jumlahDataMasuk', 'jumlahDataMasukPosSecurity', 'jumlahDataMasukRumahTangga'));
    }

    public function search(Request $request)
    {
        // Validasi input
        $request->validate([
            'query' => 'required|string|max:255', // Mengubah nama parameter menjadi 'query'
        ]);

        $query = $request->input('query');

        // Mencari data berdasarkan no_resi atau nama_pemilik
        $dataPaket = DataPaket::where('no_resi', 'LIKE', "%{$query}%")
            ->orWhere('nama_pemilik', 'LIKE', "%{$query}%") // Menambahkan pencarian berdasarkan nama pemilik
            ->paginate(5); // Gunakan paginate untuk pengalaman pengguna yang lebih baik

        // Hitung total jumlah paket data
        $jumlahDataMasuk = DataPaket::count();
        $jumlahDataMasukPosSecurity = DataPaket::where('lokasi', 'Pos Security')->count();
        $jumlahDataMasukRumahTangga = DataPaket::where('lokasi', 'Rumah Tangga')->count();

        // Kembalikan tampilan dengan data yang ditemukan
        return view('beranda', compact('dataPaket', 'jumlahDataMasuk', 'jumlahDataMasukPosSecurity', 'jumlahDataMasukRumahTangga'));
    }

}
