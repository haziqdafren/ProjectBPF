<?php

namespace App\Http\Controllers;

use App\Models\DataPaket; // Mengimpor model DataPaket
use App\Models\Histori; // Mengimpor model Histori
use App\Models\LacakPaket; // Mengimpor model LacakPaket
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon; // Mengimpor Carbon untuk penanganan tanggal

class DataPaketController extends Controller
{
    /**
     * Menampilkan daftar sumber daya.
     */
    public function index()
    {
        // Mengambil data paket dengan paginasi
        $dataPakets = DataPaket::latest()->paginate(5); // Mengambil 2 data per halaman

        // Mengirim data ke tampilan
        return view('dataPaket', compact('dataPakets'));
    }

    /**
     * Menampilkan formulir untuk membuat sumber daya baru.
     */
    public function create()
    {
        return view('paket'); // Mengembalikan tampilan untuk membuat paket baru
    }

    /**
     * Menyimpan sumber daya yang baru dibuat ke dalam penyimpanan.
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
            'lokasi' => 'required|in:Pos Security,Rumah Tangga',
            'status' => 'required|in:Sudah Diterima,Belum Diterima',
        ]);

        // Memformat nomor telepon sebelum disimpan
        $formattedPhoneNumber = $this->formatPhoneNumber($request->no_hpPenerima);

        // Memeriksa apakah paket lebih dari 2 hari
        $tglTiba = Carbon::parse($request->tgl_tiba);
        $isOlderThanTwoDays = $tglTiba->isPast() && $tglTiba->diffInDays(Carbon::now()) > 2;

        // Menetapkan lokasi berdasarkan pemeriksaan tanggal
        $location = $isOlderThanTwoDays ? 'Rumah Tangga' : $request->lokasi;

        // Menyimpan data paket
        $dataPaket = DataPaket::create(array_merge($request->all(), ['lokasi' => $location]));

        // Menyimpan ke histori dengan lokasi yang diperbarui
        Histori::create([
            'no_resi' => $dataPaket->no_resi,
            'nama_produk' => $dataPaket->nama_produk,
            'nama_ekspedisi' => $dataPaket->nama_ekspedisi,
            'no_hpPenerima' => $formattedPhoneNumber, // Menggunakan nomor telepon yang diformat
            'tgl_tiba' => $dataPaket->tgl_tiba,
            'lokasi' => $location, // Menggunakan lokasi yang diperbarui
            'status' => $dataPaket->status,
        ]);

        // Menyimpan untuk melacak paket dengan lokasi yang diperbarui
        LacakPaket::create([
            'no_resi' => $dataPaket->no_resi,
            'nama_produk' => $dataPaket->nama_produk,
            'nama_ekspedisi' => $dataPaket->nama_ekspedisi,
            'tgl_tiba' => $dataPaket->tgl_tiba,
            'lokasi' => $location, // Menggunakan lokasi yang diperbarui
        ]);

        // Menghasilkan URL Click to Chat
        return $this->sendWhatsAppClickToChat($formattedPhoneNumber, $dataPaket->no_resi, $location);
    }


    /**
     * Memperbarui sumber daya yang ditentukan dalam penyimpanan.
     */
    public function update(Request $request, $no_resi)
    {
        // Validasi input
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'no_hpPenerima' => 'required|string|max:15',
            'nama_ekspedisi' => 'required|in:JNE,Tiki,Pos Indonesia,Gojek,Grab',
            'tgl_tiba' => 'required|date',
            'lokasi' => 'required|in:Pos Security,Rumah Tangga',
        ]);

        // Mengambil paket data yang akan diperbarui
        $dataPaket = DataPaket::where('no_resi', $no_resi)->firstOrFail();

        // Memeriksa apakah paket lebih dari 2 hari
        $tglTiba = Carbon::parse($request->tgl_tiba);
        $isOlderThanTwoDays = $tglTiba->isPast() && $tglTiba->diffInDays(Carbon::now()) > 2;

        // Menetapkan lokasi berdasarkan pemeriksaan tanggal
        $location = $isOlderThanTwoDays ? 'Rumah Tangga' : $request->lokasi;

        // Memperbarui paket data
        $dataPaket->update(array_merge($request->all(), ['lokasi' => $location]));

        // Memformat nomor telepon sebelum mengirim pesan
        $formattedPhoneNumber = $this->formatPhoneNumber($request->no_hpPenerima);

        // Memperbarui histori terkait dengan lokasi baru
        $history = Histori::where('no_resi', $no_resi)->first();
        if ($history) {
            $history->update([
                'nama_produk' => $request->nama_produk,
                'nama_ekspedisi' => $request->nama_ekspedisi,
                'no_hpPenerima' => $formattedPhoneNumber, // Menggunakan nomor telepon yang diformat
                'tgl_tiba' => $request->tgl_tiba,
                'lokasi' => $location, // Menggunakan lokasi yang diperbarui
            ]);
        }

        // Memperbarui paket pelacakan terkait dengan lokasi baru
        $tracking = LacakPaket::where('no_resi', $no_resi)->first();
        if ($tracking) {
            $tracking->update([
                'nama_produk' => $request->nama_produk,
                'nama_ekspedisi' => $request->nama_ekspedisi,
                'tgl_tiba' => $request->tgl_tiba,
                'lokasi' => $location, // Menggunakan lokasi yang diperbarui
            ]);
        }

        // Menghasilkan URL Click to Chat
        return $this->sendWhatsAppClickToChat($formattedPhoneNumber, $dataPaket->no_resi, $location);
    }

    public function edit($no_resi)
{
    // Mengambil data paket berdasarkan no_resi
    $dataPaket = DataPaket::where('no_resi', $no_resi)->firstOrFail();

    // Mengembalikan tampilan untuk mengedit paket
    return view('editPaket', compact('dataPaket'));
}

    /**
     * Mengirim pesan Click to Chat WhatsApp.
     */
    private function sendWhatsAppClickToChat($phoneNumber, $noResi, $location)
    {
        // Menyiapkan pesan
        $message = "Paket Anda sudah berada di lokasi: $location.\n\n" .
        "Mohon segera mengambil paket Anda. Jika Anda ingin melihat lokasi paket Anda, silakan kunjungi link berikut: [surpa.com](https://surpa.com) dan masukkan No. Resi Anda: $noResi.\n\n" .
        "Terima kasih.";

        // Membuat URL Click to Chat
        $url = "https://wa.me/$phoneNumber?text=" . urlencode($message);

        // Mencatat URL Click to Chat
        Log::info('WhatsApp Click to Chat URL: ' . $url);

        // Mengarahkan pengguna ke URL Click to Chat
        return redirect()->away($url);
    }

    /**
     * Memformat nomor telepon ke format internasional.
     */
    private function formatPhoneNumber($phoneNumber)
    {
        // Memeriksa apakah nomor telepon dimulai dengan '0'
        if (substr($phoneNumber, 0, 1) === '0') {
            // Mengganti '0' dengan '+62'
            return '+62' . substr($phoneNumber, 1);
        }
        // Jika nomor sudah dalam format internasional, kembalikan seperti semula
        return $phoneNumber;
    }
}
