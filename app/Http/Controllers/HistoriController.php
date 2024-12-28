<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Histori; // Pastikan untuk mengimpor model Histori
use Illuminate\Support\Facades\Storage; // Untuk menyimpan file jika diperlukan

class HistoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua data histori dari database
        $histories = Histori::all(); // Atau gunakan paginate() jika data banyak

        // Kirim data ke view
        return view('laravel-examples/histori', compact('histories')); // Ganti 'histori.index' dengan nama view Anda
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Tampilkan form untuk menambah histori baru
        return view('histori.create'); // Ganti dengan nama view yang sesuai
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'no_resi' => 'required|string|max:255',
            'nama_produk' => 'required|string|max:255',
            'nama_ekspedisi' => 'required|in:JNE,Tiki,Pos Indonesia,Gojek,Grab',
            'no_hpPenerima' => 'required|string|max:15',
            'tgl_tiba' => 'required|date',
            'lokasi' => 'required|in:Kampus A,Kampus B,Kampus C',
            'status' => 'required|in:Dikirim,Dalam Perjalanan,Sampai',
            'foto_serah_terima' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi untuk foto
        ]);

        // Menyimpan foto jika ada
        $fotoPath = null;
        if ($request->hasFile('foto_serah_terima')) {
            $fotoPath = $request->file('foto_serah_terima')->store('uploads', 'public'); // Simpan di folder public/uploads
        }

        // Buat histori baru
        Histori::create([
            'no_resi' => $request->no_resi,
            'nama_produk' => $request->nama_produk,
            'nama_ekspedisi' => $request->nama_ekspedisi,
            'no_hpPenerima' => $request->no_hpPenerima,
            'tgl_tiba' => $request->tgl_tiba,
            'lokasi' => $request->lokasi,
            'status' => $request->status,
            'foto_serah_terima' => $fotoPath, // Simpan path foto
        ]);

        return redirect()->route('histori.index')->with('success', 'Histori berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Tampilkan detail histori berdasarkan ID
        $history = Histori::findOrFail($id);
        return view('histori.show', compact('history')); // Ganti dengan nama view yang sesuai
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Ambil data histori untuk diedit
        $history = Histori::findOrFail($id);
        return view('histori.edit', compact('history')); // Ganti dengan nama view yang sesuai
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi input
        $request->validate([
            'no_resi' => 'required|string|max:255',
            'nama_produk' => 'required|string|max:255',
            'nama_ekspedisi' => 'required|in:JNE,Tiki,Pos Indonesia,Gojek,Grab',
            'no_hpPenerima' => 'required|string|max:15',
            'tgl_tiba' => 'required|date',
            'lokasi' => 'required|in:Kampus A,Kampus B,Kampus C',
            'status' => 'required|in:Dikirim,Dalam Perjalanan,Sampai',
            'foto_serah_terima' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi untuk foto
        ]);

        // Ambil histori yang akan diperbarui
        $history = Histori::findOrFail($id);

        // Menyimpan foto jika ada
        if ($request->hasFile('foto_serah_terima')) {
            // Hapus foto lama jika ada
            if ($history->foto_serah_terima) {
                Storage::disk('public')->delete($history->foto_serah_terima);
            }
            $history->foto_serah_terima = $request->file('foto_serah_terima')->store('uploads', 'public'); // Simpan foto baru
        }

        // Perbarui data histori
        $history->update([
            'no_resi' => $request->no_resi,
            'nama_produk' => $request->nama_produk,
            'nama_ekspedisi' => $request->nama_ekspedisi,
            'no_hpPenerima' => $request->no_hpPenerima,
            'tgl_tiba' => $request->tgl_tiba,
            'lokasi' => $request->lokasi,
            'status' => $request->status,
        ]);

        return redirect()->route('histori.index')->with('success', 'Histori berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Hapus histori berdasarkan ID
        $history = Histori::findOrFail($id);

        // Hapus foto jika ada
        if ($history->foto_serah_terima) {
            Storage::disk('public')->delete($history->foto_serah_terima);
        }

        $history->delete();

        return redirect()->route('histori.index')->with('success', 'Histori berhasil dihapus.');
    }
}

