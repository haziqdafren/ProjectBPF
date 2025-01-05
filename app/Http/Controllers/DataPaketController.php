<?php

namespace App\Http\Controllers;

use App\Models\DataPaket; // Importing the DataPaket model
use App\Models\Histori; // Importing the Histori model
use App\Models\LacakPaket; // Importing the LacakPaket model
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
        // Fetching data packages with pagination
        $dataPakets = DataPaket::latest()->paginate(5);

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

        return view('paket', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input dari formulir
        $request->validate([
            'no_resi' => 'required|string|unique:data_paket,no_resi',
            'nama_produk' => 'required|string',
            'no_hpPenerima' => 'required|string',
            'nama_ekspedisi' => 'required|in:JNE,Tiki,Pos Indonesia,Gojek,Grab',
            'tgl_tiba' => 'required|date',
            'lokasi' => 'required|in:Pos Security,Rumah Tangga',
            'status' => 'required|in:Sudah Diterima,Belum Diterima',
        ]);

        // Cek apakah pengguna sudah terautentikasi
        if (!auth()->check()) {
            Log::warning('Pengguna tidak terautentikasi saat mencoba membuat data paket.');
            return redirect()->route('login')->with('error', 'Anda harus login untuk membuat data paket.');
        }

        // Ambil ID pengguna yang terautentikasi
        $userId = auth()->id();
        Log::info('ID Pengguna Terautentikasi: ' . $userId);

        // Format nomor telepon sebelum disimpan
        $formattedPhoneNumber = $this->formatPhoneNumber($request->no_hpPenerima);

        // Cek apakah paket lebih dari 2 hari
        $tglTiba = Carbon::parse($request->tgl_tiba);
        $isOlderThanTwoDays = $tglTiba->isPast() && $tglTiba->diffInDays(Carbon::now()) > 2;

        // Tentukan lokasi berdasarkan pengecekan tanggal
        $location = $isOlderThanTwoDays ? 'Rumah Tangga' : $request->lokasi;

        // Siapkan data untuk membuat data paket
        $dataToCreate = array_merge($request->all(), [
            'lokasi' => $location,
            'user_id' => $userId // Simpan ID pengguna yang terautentikasi
        ]);

        // Simpan data paket dengan user_id
        $dataPaket = DataPaket::create($dataToCreate);

        // Log data paket yang telah dibuat
        Log::info('Data Paket Dibuat: ', $dataPaket->toArray());

        // Simpan ke histori dengan lokasi yang diperbarui
        Histori::create([
            'no_resi' => $dataPaket->no_resi,
            'nama_produk' => $dataPaket->nama_produk,
            'nama_ekspedisi' => $dataPaket->nama_ekspedisi,
            'no_hpPenerima' => $formattedPhoneNumber, // Menggunakan nomor telepon yang diformat
            'tgl_tiba' => $dataPaket->tgl_tiba,
            'lokasi' => $location, // Menggunakan lokasi yang diperbarui
            'status' => $dataPaket->status,
        ]);

        // Simpan ke pelacakan dengan lokasi yang diperbarui
        LacakPaket::create([
            'no_resi' => $dataPaket->no_resi,
            'nama_produk' => $dataPaket->nama_produk,
            'nama_ekspedisi' => $dataPaket->nama_ekspedisi,
            'tgl_tiba' => $dataPaket->tgl_tiba,
            'lokasi' => $location, // Menggunakan lokasi yang diperbarui
        ]);

        // Kirim pesan WhatsApp
        $whatsappUrl = $this->sendWhatsAppClickToChat($formattedPhoneNumber, $dataPaket->no_resi, $location);

        // Redirect ke URL WhatsApp untuk mengirim pesan
        return redirect()->away($whatsappUrl);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $no_resi)
    {
        // Validate input
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'no_hpPenerima' => 'required|string|max:15',
            'nama_ekspedisi' => 'required|in:JNE,Tiki,Pos Indonesia,Gojek,Grab',
            'tgl_tiba' => 'required|date',
            'lokasi' => 'required|in:Pos Security,Rumah Tangga',
        ]);

        // Fetch the data package to be updated
        $dataPaket = DataPaket::where('no_resi', $no_resi)->firstOrFail();

        // Check if the package is older than 2 days
        $tglTiba = Carbon::parse($request->tgl_tiba);
        $isOlderThanTwoDays = $tglTiba->isPast() && $tglTiba->diffInDays(Carbon::now()) > 2;

        // Set location based on the date check
        $location = $isOlderThanTwoDays ? 'Rumah Tangga' : $request->lokasi;

        // Update data package
        $dataPaket->update(array_merge($request->all(), ['lokasi' => $location]));

        // Format phone number before sending message
        $formattedPhoneNumber = $this->formatPhoneNumber($request->no_hpPenerima);

        // Update history related to the new location
        $history = Histori::where('no_resi', $no_resi)->first();
        if ($history) {
            $history->update([
                'nama_produk' => $request->nama_produk,
                'nama_ekspedisi' => $request->nama_ekspedisi,
                'no_hpPenerima' => $formattedPhoneNumber, // Using the formatted phone number
                'tgl_tiba' => $request->tgl_tiba,
                'lokasi' => $location, // Using the updated location
            ]);
        }

        // Update tracking related to the new location
        $tracking = LacakPaket::where('no_resi', $no_resi)->first();
        if ($tracking) {
            $tracking->update([
                'nama_produk' => $request->nama_produk,
                'nama_ekspedisi' => $request->nama_ekspedisi,
                'tgl_tiba' => $request->tgl_tiba,
                'lokasi' => $location, // Using the updated location
            ]);
        }

        // Kirim pesan WhatsApp
        $whatsappUrl = $this->sendWhatsAppClickToChat($formattedPhoneNumber, $dataPaket->no_resi, $location);

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

        // Return the view to edit the package
        return view('editPaket', compact('dataPaket'));
    }

    public function search(Request $request)
    {
        $request->validate([
            'resi' => 'required|string|max:255',
        ]);

        $no_resi = $request->input('resi');

        $dataPaket = DataPaket::where('no_resi', 'LIKE', "%{$no_resi}%")
            ->orWhere('nama_produk', 'LIKE', "%{$no_resi}%")
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
