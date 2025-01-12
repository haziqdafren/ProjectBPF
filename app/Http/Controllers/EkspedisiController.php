<?php

namespace App\Http\Controllers;

use App\Models\Ekspedisi;
use Illuminate\Http\Request;

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
        // Validasi data input
        $request->validate([
            'Id_ekspedisi' => 'required|string|max:255', // Pastikan 'ekspedisis' adalah nama tabel yang benar
            'nama_ekspedisi' => 'required|string|max:255',
            'kontak' => 'required|string|max:255',
        ]);

        // Menyimpan data ekspedisi baru
        Ekspedisi::create([
            'Id_ekspedisi' => $request->Id_ekspedisi,
            'nama_ekspedisi' => $request->nama_ekspedisi,
            'kontak' => $request->kontak,
        ]);

        // Redirect ke halaman daftar ekspedisi dengan pesan sukses
        return redirect()->route('ekspedisi.index')->with('success', 'Data ekspedisi berhasil disimpan.');
    }

    public function edit(Ekspedisi $ekspedisi)
    {
        return view('editDataEkpedisi', compact('ekspedisis'));
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
