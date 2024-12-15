<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataPaket;
<<<<<<< HEAD
use Illuminate\Support\Facades\Log;

=======
use Illuminate\Support\Facades\Storage;
>>>>>>> bec937a998c5f48ffe82336305fe73ec1c21d77e

class DataPaketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil data paket dan paginasi
<<<<<<< HEAD
        $dataPakets = DataPaket::latest()->paginate(10);

        // Kirim data ke view
        return view('dataPaket', compact('dataPakets'));
=======
        $data_pakets = DataPaket::latest()->paginate(10);

        if (request()->wantsJson()) {
            return response()->json($data_pakets);
        }

        $data['data_pakets'] = $data_pakets;
        return view('dataPaket', $data);
>>>>>>> bec937a998c5f48ffe82336305fe73ec1c21d77e
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Tampilkan form untuk membuat data baru
        return view('data_paket_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
<<<<<<< HEAD
            'produk' => 'required|string|max:255',
            'pemilik' => 'required|string|max:255',
            'ekspedisi' => 'required|in:ekspedisi1,ekspedisi2,ekspedisi3,ekspedisi4',
            'tanggal_tiba' => 'nullable|date',
             'lokasi' => 'required|in:Pos Security Utama,Pos Security GSG, Pos Security Rektorat,Rumah Tangga',
        ]);

=======
            'no_resi' => 'required|string|max:255',
            'produk' => 'required|string|max:255',
            'pemilik' => 'required|string|max:255',
            'ekspedisi' => 'required|string|max:255',
            'tanggal_tiba' => 'required|date',
        ]);
>>>>>>> bec937a998c5f48ffe82336305fe73ec1c21d77e

        // Simpan data ke database
        DataPaket::create($validated);

        // Redirect ke halaman lain atau kembali dengan pesan sukses
        return redirect()->route('data_pakets.index')->with('success', 'Data Paket Berhasil Disimpan');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Ambil data berdasarkan ID
        $dataPaket = DataPaket::findOrFail($id);

        // Tampilkan data di view
        return view('data_paket_show', compact('dataPaket'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Ambil data untuk diedit
        $dataPaket = DataPaket::findOrFail($id);

        // Tampilkan form edit
        return view('data_paket_edit', compact('dataPaket'));
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
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:5000',
        ]);

        // Ambil data yang akan diupdate
        $dataPaket = DataPaket::findOrFail($id);
        $dataPaket->fill($validated);

        // Jika ada foto baru, hapus foto lama dan simpan foto baru
        if ($request->hasFile('foto')) {
            if ($dataPaket->foto && Storage::exists($dataPaket->foto)) {
                Storage::delete($dataPaket->foto);
            }
            $dataPaket->foto = $request->file('foto')->store('public');
        }

        $dataPaket->save();

        return redirect()->route('data_pakets.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Hapus data berdasarkan ID
        $dataPaket = DataPaket::findOrFail($id);

        // Jika ada foto yang terkait, hapus foto dari storage
        if ($dataPaket->foto && Storage::exists($dataPaket->foto)) {
            Storage::delete($dataPaket->foto);
        }

        // Hapus data paket
        $dataPaket->delete();

        return redirect()->route('data_pakets.index');
    }
}
