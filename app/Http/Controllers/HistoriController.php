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
    public function index(Request $request)
    {
        // Ambil query pencarian dari request, jika ada
        $search = $request->get('search');

        // Jika ada query pencarian, filter data berdasarkan nomor resi
        if ($search) {
            $histories = Histori::where('no_resi', 'like', '%' . $search . '%')
                ->latest() // Sortir berdasarkan tanggal terbaru
                ->paginate(2); // Paginate dengan 2 data per halaman
        } else {
            // Ambil semua data histori dengan pagination jika tidak ada pencarian
            $histories = Histori::latest()->paginate(5);
        }

        // Kirim data ke view
        return view('laravel-examples.histori', compact('histories'));
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
            'lokasi' => 'required|in:Pos Security,Rumah Tangga',
            'status' => 'required|in:Sudah Diterima,Belum Diterima',
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
    public function show(string $no_resi)
    {
        // Tampilkan detail histori berdasarkan no_resi
        $history = Histori::where('no_resi', $no_resi)->firstOrFail();
        return view('histori.show', compact('history'));
    }

    public function edit(string $no_resi)
    {
        // Cari histori berdasarkan no_resi
        $history = Histori::where('no_resi', $no_resi)->firstOrFail();
        return view('editHistoriFoto', compact('history'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $no_resi)
    {
        // Validasi input
        $request->validate([
            'foto_serah_terima' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi foto
            'status' => 'required|in:Sudah Diterima,Belum Diterima', // Validasi status
        ]);

        // Temukan histori berdasarkan no_resi
        $history = Histori::where('no_resi', $no_resi)->firstOrFail();

        // Cek jika ada foto baru yang diupload
        if ($request->hasFile('foto_serah_terima')) {
            // Hapus foto lama jika ada
            if ($history->foto_serah_terima) {
                Storage::disk('public')->delete($history->foto_serah_terima);
            }
            // Simpan foto baru
            $history->foto_serah_terima = $request->file('foto_serah_terima')->store('uploads', 'public');
        }

        // Update entri histori dengan foto baru dan status
        $history->update([
            'foto_serah_terima' => $history->foto_serah_terima,
            'status' => $request->input('status'), // Update status dari request
        ]);

        // Redirect kembali ke index setelah memperbarui
        return redirect()->route('histori.index')->with('success', 'Foto dan status berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $no_resi)
    {
        // Hapus histori berdasarkan no_resi
        $history = Histori::where('no_resi', $no_resi)->firstOrFail();

        // Hapus foto jika ada
        if ($history->foto_serah_terima) {
            Storage::disk('public')->delete($history->foto_serah_terima);
        }

        $history->delete();

        return redirect()->route('histori.index')->with('success', 'Histori berhasil dihapus.');
    }

    /**
     * Search for a specific resource.
     */
    public function search(Request $request)
    {
        // Implementasi pencarian jika diperlukan
    }
}
