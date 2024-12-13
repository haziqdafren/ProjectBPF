<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataPaket;

class DataPaketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil data paket dan paginasi
        $dataPakets = DataPaket::latest()->paginate(10);

        // Kirim data ke view
        return view('dataPaket', compact('dataPakets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Tampilkan form untuk membuat data baru
        return view('dataPaketCreate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'produk' => 'required|string|max:255',
            'pemilik' => 'required|string|max:255',
            'ekspedisi' => 'required|in:ekspedisi1,ekspedisi2,ekspedisi3,ekspedisi4',
            'tanggal_tiba' => 'nullable|date',
        ]);

        // Simpan data ke database
        DataPaket::create($validated);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('data_pakets.index')->with('success', 'Data paket berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Ambil data berdasarkan ID
        $dataPaket = DataPaket::findOrFail($id);

        // Tampilkan data di view
        return view('dataPaketShow', compact('dataPaket'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Ambil data untuk diedit
        $dataPaket = DataPaket::findOrFail($id);

        // Tampilkan form edit
        return view('dataPaketEdit', compact('dataPaket'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi input
        $validated = $request->validate([
            'produk' => 'required|string|max:255',
            'pemilik' => 'required|string|max:255',
            'ekspedisi' => 'required|in:ekspedisi1,ekspedisi2,ekspedisi3,ekspedisi4',
            'tanggal_tiba' => 'nullable|date',
        ]);

        // Update data
        $dataPaket = DataPaket::findOrFail($id);
        $dataPaket->update($validated);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('data_pakets.index')->with('success', 'Data paket berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Hapus data berdasarkan ID
        $dataPaket = DataPaket::findOrFail($id);
        $dataPaket->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('data_pakets.index')->with('success', 'Data paket berhasil dihapus.');
    }
}
