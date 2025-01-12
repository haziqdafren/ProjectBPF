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
        // Validate input
        $request->validate([
            'resi' => 'required|string|max:255',
        ]);

        $no_resi = $request->input('resi');

        // Search for data based on no_resi
        $dataPaket = DataPaket::where('no_resi', $no_resi)->paginate(5); // Use paginate for better UX

        // Count the total number of data packages
        $jumlahDataMasuk = DataPaket::count();
        $jumlahDataMasukPosSecurity = DataPaket::where('lokasi', 'Pos Security')->count();
        $jumlahDataMasukRumahTangga = DataPaket::where('lokasi', 'Rumah Tangga')->count();

        // Return the view with the found data
        return view('beranda', compact('dataPaket', 'jumlahDataMasuk', 'jumlahDataMasukPosSecurity', 'jumlahDataMasukRumahTangga'));
    }
}
