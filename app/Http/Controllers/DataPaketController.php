<?php

namespace App\Http\Controllers;

use App\Models\DataPaket; // Importing the DataPaket model
use App\Models\Histori; // Importing the Histori model
use App\Models\LacakPaket; // Importing the LacakPaket model
use App\Models\Ekspedisi; // Importing the Ekspedisi model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon; // Importing Carbon for date handling

class DataPaketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataPakets = DataPaket::with('ekspedisi')->paginate(10); // Memuat relasi ekspedisi

        // Sending data to the view
        return view('dataPaket', compact('dataPakets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'You must be logged in to create a data package.');
        }

        // Ambil semua data ekspedisi dari database
        $ekspedisis = Ekspedisi::all();

        return view('paket', compact('user', 'ekspedisis')); // Pastikan 'ekspedisis' ada di compact
    }



    public function store(Request $request)
    {
        // Validasi input dari formulir
        $request->validate([
            'no_resi' => 'required|string|unique:data_paket,no_resi',
            'nama_produk' => 'required|string',
            'no_hpPenerima' => 'required|string',
            'ekspedisi_id' => 'required|exists:ekspedisi,Id_ekpedisi', // Validasi ID ekspedisi
            'tgl_tiba' => 'required|date',
            'nama_pemilik' => 'required|string|max:255', // Validasi untuk nama pemilik
            'bukti_serah_terima' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi untuk foto
        ]);

        // Cek apakah pengguna sudah terautentikasi
        if (!auth()->check()) {
            Log::warning('Pengguna tidak terautentikasi saat mencoba membuat data paket.');
            return redirect()->route('login')->with('error', 'Anda harus login untuk membuat data paket.');
        }

        // Ambil ID pengguna yang terautentikasi
        $userId = auth()->id();
        $userName = auth()->user()->name; // Ambil nama pengguna yang terautentikasi
        Log::info('ID Pengguna Terautentikasi: ' . $userId);

        // Format nomor telepon sebelum disimpan
        $formattedPhoneNumber = $this->formatPhoneNumber($request->no_hpPenerima);

        // Menyimpan bukti serah terima jika ada
        $buktiPath = null;
        if ($request->hasFile('bukti_serah_terima')) {
            $buktiPath = $request->file('bukti_serah_terima')->store('uploads', 'public'); // Simpan di folder public/uploads
        }

        // Siapkan data untuk membuat data paket
        $dataToCreate = array_merge($request->all(), [
            'user_id' => $userId, // Simpan ID pengguna yang terautentikasi
            'security_name' => $userName, // Simpan nama security
            'lokasi' => 'Pos Security', // Set lokasi default
            'status' => 'Belum Diterima', // Set status default
            'bukti_serah_terima' => $buktiPath, // Simpan path bukti serah terima
        ]);

        // Simpan data paket dengan user_id
        $dataPaket = DataPaket::create($dataToCreate);

        // Log data paket yang telah dibuat
        Log::info('Data Paket Dibuat: ', $dataPaket->toArray());

        // Simpan ke histori
        Histori::create([
            'no_resi' => $dataPaket->no_resi,
            'nama_produk' => $dataPaket->nama_produk,
            'ekspedisi_id' => $dataPaket->ekspedisi_id, // Simpan ID ekspedisi
            'no_hpPenerima' => $formattedPhoneNumber, // Menggunakan nomor telepon yang diformat
            'tgl_tiba' => $dataPaket->tgl_tiba,
            'lokasi' => $dataPaket->lokasi, // Menggunakan lokasi dari input
            'status' => $dataPaket->status,
            'nama_pemilik' => $request->nama_pemilik, // Simpan nama pemilik
        ]);

        // Simpan ke pelacakan
        LacakPaket::create([
            'no_resi' => $dataPaket->no_resi,
            'nama_produk' => $dataPaket->nama_produk,
            'ekspedisi_id' => $dataPaket->ekspedisi_id, // Simpan ID ekspedisi
            'tgl_tiba' => $dataPaket->tgl_tiba,
            'lokasi' => $dataPaket->lokasi, // Menggunakan lokasi dari input
            'nama_pemilik' => $request->nama_pemilik, // Simpan nama pemilik
        ]);

        // Kirim pesan WhatsApp
        $whatsappUrl = $this->sendWhatsAppClickToChat($formattedPhoneNumber, $dataPaket->no_resi, $dataPaket->lokasi);

        // Redirect ke URL WhatsApp untuk mengirim pesan
        return redirect()->away($whatsappUrl);
    }

    public function update(Request $request, $no_resi)
    {
        // Validasi input
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'no_hpPenerima' => 'required|string|max:15',
            'ekspedisi_id' => 'required|exists:ekspedisi,Id_ekpedisi', // Validasi ID ekspedisi
            'tgl_tiba' => 'required|date',
            'nama_pemilik' => 'required|string|max:255', // Tambahkan validasi untuk nama pemilik
        ]);

        // Ambil data paket yang akan diperbarui
        $dataPaket = DataPaket::where('no_resi', $no_resi)->firstOrFail();

        // Siapkan data untuk diperbarui
        $dataToUpdate = [
            'nama_produk' => $request->nama_produk,
            'no_hpPenerima' => $this->formatPhoneNumber($request->no_hpPenerima),
            'ekspedisi_id' => $request->ekspedisi_id, // Simpan ID ekspedisi
            'tgl_tiba' => $request->tgl_tiba,
            'nama_pemilik' => $request->nama_pemilik, // Tambahkan nama pemilik
        ];

        // Perbarui data paket
        $dataPaket->update($dataToUpdate);

        // Perbarui histori terkait lokasi baru
        $history = Histori::where('no_resi', $no_resi)->first();
        if ($history) {
            $history->update([
                'nama_produk' => $request->nama_produk,
                'ekspedisi_id' => $dataToUpdate['ekspedisi_id'], // Simpan ID ekspedisi
                'no_hpPenerima' => $dataToUpdate['no_hpPenerima'], // Menggunakan nomor telepon yang diformat
                'tgl_tiba' => $request->tgl_tiba,
                'lokasi' => $history->lokasi, // Pertahankan lokasi yang ada
            ]);
        } else {
            // Jika tidak ada histori, Anda bisa memutuskan untuk membuat entri baru atau mengabaikan
            Log::warning("Tidak ada histori untuk no_resi: $no_resi");
        }

        // Perbarui pelacakan terkait lokasi baru
        $tracking = LacakPaket::where('no_resi', $no_resi)->first();
        if ($tracking) {
            $tracking->update([
                'nama_produk' => $request->nama_produk,
                'ekspedisi_id' => $dataToUpdate['ekspedisi_id'], // Simpan ID ekspedisi
                'tgl_tiba' => $request->tgl_tiba,
                // Lokasi tidak diubah
            ]);
        } else {
            // Jika tidak ada pelacakan, Anda bisa memutuskan untuk membuat entri baru atau mengabaikan
            Log::warning("Tidak ada pelacakan untuk no_resi: $no_resi");
        }

        // Kirim pesan WhatsApp
        $whatsappUrl = $this->sendWhatsAppClickToChat($dataToUpdate['no_hpPenerima'], $dataPaket->no_resi, $history ? $history->lokasi : 'Lokasi tidak tersedia');

        // Redirect ke URL WhatsApp untuk mengirim pesan
        return redirect()->away($whatsappUrl);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($no_resi)
    {
        // Fetch data package based on no_resi
        $dataPaket = DataPaket::where('no_resi', $no_resi)->firstOrFail();

         // Ambil semua data ekspedisi dari database
         $ekspedisis = Ekspedisi::all();

        // Return the view to edit the package
        return view('editPaket', compact('dataPaket','ekspedisis'));
    }

    public function search(Request $request)
    {
        $request->validate([
            'resi' => 'required|string|max:255',
        ]);

        $no_resi = $request->input('resi');

        $dataPaket = DataPaket::where('no_resi', 'LIKE', "%{$no_resi}%")
            ->orWhere('nama_pemilik', 'LIKE', "%{$no_resi}%")
            ->orWhere('no_hpPenerima', 'LIKE', "%{$no_resi}%")
            ->paginate(5); // Use paginate for better UX

        // Count the total number of data packages
        $jumlahDataMasuk = DataPaket::count();
        $jumlahDataMasukPosSecurity = DataPaket::where('lokasi', 'Pos Security')->count();
        $jumlahDataMasukRumahTangga = DataPaket::where('lokasi', 'Rumah Tangga')->count();

        // Return the view with the found data
        return view('beranda', compact('dataPaket', 'jumlahDataMasuk', 'jumlahDataMasukPosSecurity', 'jumlahDataMasukRumahTangga'));
    }

    public function destroy($no_resi)
    {
        // Find the package by no_resi
        $dataPaket = DataPaket::where('no_resi', $no_resi)->first();

        if (!$dataPaket) {
            return redirect()->route('data-paket.index')->with('error', 'Data paket tidak ditemukan.');
        }

        // Delete the package
        $dataPaket->delete();

        // Redirect back with a success message
        return redirect()->route('data-paket.index')->with('success', 'Data paket berhasil dihapus.');
    }

    /**
     * Send Click to Chat WhatsApp message.
     */
    private function sendWhatsAppClickToChat($phoneNumber, $noResi, $location)
    {
        // Prepare message
        $message = "Paket Anda sudah berada di lokasi: $location.\n\n" .
        "Mohon segera mengambil paket Anda. Jika Anda ingin melihat lokasi paket Anda, silakan kunjungi link berikut: .... dan masukkan No. Resi Anda: $noResi.\n\n" .
        "Terima kasih.";

        // Create Click to Chat URL
        $url = "https://wa.me/$phoneNumber?text=" . urlencode($message);

        // Log Click to Chat URL
        Log::info('WhatsApp Click to Chat URL: ' . $url);

        // Return the URL for redirect
        return $url;
    }

    /**
     * Format phone number to international format.
     */
    private function formatPhoneNumber($phoneNumber)
    {
        // Check if the phone number starts with '0'
        if (substr($phoneNumber, 0, 1) === '0') {
            // Replace '0' with '+62'
            return '+62' . substr($phoneNumber, 1);
        }
        // If the number is already in international format, return as is
        return $phoneNumber;
    }
}
