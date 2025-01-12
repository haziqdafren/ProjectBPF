<?php

namespace App\Http\Controllers;

use App\Models\LacakPaket; // Pastikan model ini ada
use Illuminate\Http\Request;

class LacakPaketController extends Controller
{

    public function search(Request $request)
    {
        // Validasi input
        $request->validate([
            'no_resi' => 'required|string|max:255',
            'nama_pemilik' => 'nullable|string|max:255', // Tambahkan validasi untuk nama pemilik
        ]);

        $no_resi = $request->input('no_resi');
        $nama_pemilik = $request->input('nama_pemilik');

        // Cari data berdasarkan no_resi dan nama_pemilik
        $results = LacakPaket::with('ekspedisi') // Memuat relasi ekspedisi
            ->where('no_resi', $no_resi)
            ->orWhere('nama_pemilik', 'like', '%' . $nama_pemilik . '%') // Pencarian berdasarkan nama_pemilik
            ->get();

        // Kembalikan view dengan data yang ditemukan
        return view('session.lacakpaket', compact('results'));
    }



    public function index(){
        return view('session/lacakpaket');
    }
}
