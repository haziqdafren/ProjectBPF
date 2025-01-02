<?php

namespace App\Http\Controllers;

use App\Models\DataPaket; // Pastikan untuk mengimpor model DataPaket
use App\Models\Histori; // Pastikan untuk mengimpor model Histori
use App\Models\LacakPaket; // Pastikan untuk mengimpor model LacakPaket
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;



class DataPaketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil data paket dengan pagination
        $dataPakets = \App\Models\DataPaket::latest()->paginate(2); // Ambil 10 data per halaman

        // Kirim data ke view
        return view('dataPaket', compact('dataPakets'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('paket'); // Ganti dengan view yang sesuai
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'no_resi' => 'required|string|unique:data_paket,no_resi',
            'nama_produk' => 'required|string',
            'no_hpPenerima' => 'required|string',
            'nama_ekspedisi' => 'required|in:JNE,Tiki,Pos Indonesia,Gojek,Grab',
            'tgl_tiba' => 'required|date',
            'lokasi' => 'required|in:Kampus A,Kampus B,Kampus C', // Pastikan nilai ini sesuai
            'status' => 'required|in:Dikirim,Dalam Perjalanan,Sampai',
        ]);

        // Simpan data paket
        $dataPaket = DataPaket::create($request->all());

        // Simpan ke histori
        Histori::create([
            'no_resi' => $dataPaket->no_resi,
            'nama_produk' => $dataPaket->nama_produk,
            'nama_ekspedisi' => $dataPaket->nama_ekspedisi,
            'no_hpPenerima' => $dataPaket->no_hpPenerima,
            'tgl_tiba' => $dataPaket->tgl_tiba,
            'lokasi' => $dataPaket->lokasi,
            'status' => $dataPaket->status,
        ]);

        // Simpan ke lacak paket
        LacakPaket::create([
            'no_resi' => $dataPaket->no_resi,
            'nama_produk' => $dataPaket->nama_produk,
            'nama_ekspedisi' => $dataPaket->nama_ekspedisi,
            'tgl_tiba' => $dataPaket->tgl_tiba,
            'lokasi' => $dataPaket->lokasi,
        ]);

        // Kirim pesan WhatsApp (jika diperlukan)
        // $this->sendWhatsAppMessage($dataPaket->no_hpPenerima, $dataPaket->no_resi);

        // Redirect dengan pesan sukses
        return redirect()->route('data-paket.index')->with('success', 'Data paket berhasil disimpan!');
    }


    /**
     * Display the specified resource.
     */
    public function show($no_resi)
    {
        $dataPaket = DataPaket::where('no_resi', $no_resi)->firstOrFail();
        return view('editPaket', compact('dataPaket', 'currentNoResi')); // Ganti 'your_view_name' dengan nama view Anda
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($no_resi)
    {
        $dataPaket = DataPaket::where('no_resi', $no_resi)->firstOrFail();
        return view('editPaket', compact('dataPaket'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $no_resi)
    {
        // Validasi input
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'no_hpPenerima' => 'required|string|max:15',
            'nama_ekspedisi' => 'required|in:JNE,Tiki,Pos Indonesia,Gojek,Grab',
            'tgl_tiba' => 'required|date',
            'lokasi' => 'required|in:Kampus A,Kampus B,Kampus C',
        ]);

        // Ambil data paket untuk diperbarui
        $dataPaket = DataPaket::where('no_resi', $no_resi)->firstOrFail();

        // Perbarui data paket
        $dataPaket->update($request->all());

        // Perbarui riwayat yang terkait
        $history = Histori::where('no_resi', $no_resi)->first();
        if ($history) {
            $history->update([
                'nama_produk' => $request->nama_produk,
                'nama_ekspedisi' => $request->nama_ekspedisi,
                'no_hpPenerima' => $request->no_hpPenerima,
                'tgl_tiba' => $request->tgl_tiba,
                'lokasi' => $request->lokasi,
                // Anda bisa menambahkan kolom lain yang perlu diperbarui di sini
            ]);
        }

        return redirect()->route('data-paket.index')->with('success', 'Data paket berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($no_resi)
    {
        // Temukan data berdasarkan no_resi, bukan id
        $dataPaket = DataPaket::where('no_resi', $no_resi)->firstOrFail();
        $dataPaket->delete();

        return redirect()->route('data-paket.index')->with('success', 'Data paket berhasil dihapus!');
    }

    public function search(Request $request)
    {
        // Validasi input
        $request->validate([
            'resi' => 'required|string|max:255',
        ]);

        $no_resi = $request->input('resi');

        // Cari data berdasarkan no_resi
        $dataPaket = DataPaket::where('no_resi', $no_resi)->get();

        // Hitung jumlah data yang masuk
        $jumlahDataMasuk = DataPaket::count();

        // Kembalikan view dengan data yang ditemukan
        return view('beranda', compact('dataPaket', 'jumlahDataMasuk'));
    }

}

