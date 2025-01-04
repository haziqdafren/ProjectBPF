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
    // Menambahkan pencarian berdasarkan nomor resi
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
        return view('laravel-examples.histori',compact('histories'));
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
        // Tampilkan detail histori
        $history = Histori::where('no_resi', $no_resi)->firstOrFail();
        return view('histori.show', compact('history'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $no_resi)
    {
        // Cari histori berdasarkan no_resi
        $history = Histori::where('no_resi', $no_resi)->firstOrFail();
        return view('editHistoriFoto', compact('history')); // Mengarahkan ke file yang benar
    }
    public function update(Request $request, string $no_resi)
    {
        // Validate the incoming request
        $request->validate([
            'foto_serah_terima' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate the photo upload
            'status' => 'required|in:Sudah Diterima,Belum Diterima', // Validate the status as an enum
        ]);

        // Find the history entry by no_resi
        $history = Histori::where('no_resi', $no_resi)->firstOrFail();

        // Check if a new photo is uploaded
        if ($request->hasFile('foto_serah_terima')) {
            // Delete the old photo if it exists
            if ($history->foto_serah_terima) {
                Storage::disk('public')->delete($history->foto_serah_terima);
            }
            // Store the new photo
            $history->foto_serah_terima = $request->file('foto_serah_terima')->store('uploads', 'public');
        }

        // Update the history entry with the new photo and status
        $history->update([
            'foto_serah_terima' => $history->foto_serah_terima,
            'status' => $request->input('status'), // Update the status from the request
        ]);

        // Redirect back to the index after updating
        return redirect()->route('histori.index')->with('success', 'Foto dan status berhasil diperbarui.');
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

    public function search(Request $request)
    {
    }
}

