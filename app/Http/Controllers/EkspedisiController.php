<?php

namespace App\Http\Controllers;

use App\Models\Ekspedisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EkspedisiController extends Controller
{
    public function index()
    {
        // Mengambil semua data ekspedisi dari database
        $ekspedisis = Ekspedisi::all();

        // Pastikan variabel $ekspedisis dikirim ke view
        return view('ekspedisi_index', compact('ekspedisis')); // Menampilkan daftar ekspedisi
    }

    public function create()
    {
        return view('tambahDataEkpedisi');
    }

    public function store(Request $request)
    {
        $request->validate([
            'Id_ekpedisi' => 'required|string|max:255|unique:ekspedisi,Id_ekpedisi', // Add unique validation
            'nama_ekspedisi' => 'required|string|max:255',
            'kontak' => 'required|string|max:20',
        ]);

        Ekspedisi::create([
            'Id_ekpedisi' => $request->Id_ekpedisi,
            'nama_ekspedisi' => $request->nama_ekspedisi,
            'kontak' => $request->kontak,
        ]);

        return redirect()->route('ekspedisi.index')->with('success', 'Data ekspedisi berhasil disimpan.');
    }

    public function edit(Ekspedisi $ekspedisi)
    {
        // Ambil semua data ekspedisi dari database
         $ekspedisis = Ekspedisi::all();

        return view('editDataEkpedisi',compact('ekspedisis', 'ekspedisi'));
    }

    public function update(Request $request, Ekspedisi $ekspedisi)
    {
        // Validasi data input
        $request->validate([
            'nama_ekspedisi' => 'required|string|max:255',
            'kontak' => 'required|string|max:255',
        ]);

        // Update data ekspedisi yang sudah ada
        $ekspedisi->update([
            'nama_ekspedisi' => $request->nama_ekspedisi,
            'kontak' => $request->kontak,
        ]);

        return redirect()->route('ekspedisi.index')->with('success', 'Data ekspedisi berhasil diperbarui.');
    }
    public function destroy(Ekspedisi $ekspedisi)
    {
        // Menghapus ekspedisi yang dipilih
        $ekspedisi->delete();

        // Redirect ke halaman daftar ekspedisi dengan pesan sukses
        return redirect()->route('ekspedisi.index')->with('success', 'Data ekspedisi berhasil dihapus.');
    }
}
