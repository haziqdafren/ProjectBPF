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
        $dataPakets = DataPaket::latest()->paginate(5); // Fetching 5 data per page

        // Sending data to the view
        return view('dataPaket', compact('dataPakets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Get the authenticated user
        $user = auth()->user(); // This retrieves the currently authenticated user

        // Check if the user is authenticated
        if (!$user) {
            return redirect()->route('login')->with('error', 'You must be logged in to create a data package.');
        }

        // Pass the user to the view
        return view('paket', compact('user')); // Ensure 'paket' is the correct view name
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'no_resi' => 'required|string|unique:data_paket,no_resi',
            'nama_produk' => 'required|string',
            'no_hpPenerima' => 'required|string',
            'nama_ekspedisi' => 'required|in:JNE,Tiki,Pos Indonesia,Gojek,Grab',
            'tgl_tiba' => 'required|date',
            'lokasi' => 'required|in:Pos Security,Rumah Tangga',
            'status' => 'required|in:Sudah Diterima,Belum Diterima',
        ]);

        // Check if the user is authenticated
        if (!auth()->check()) {
            Log::warning('User not authenticated when trying to create data paket.');
            return redirect()->route('login')->with('error', 'You must be logged in to create a data package.');
        }

        // Get the authenticated user's ID
        $userId = auth()->id();
        Log::info('Authenticated User ID: ' . $userId);

        // Format phone number before saving
        $formattedPhoneNumber = $this->formatPhoneNumber($request->no_hpPenerima);

        // Check if the package is older than 2 days
        $tglTiba = Carbon::parse($request->tgl_tiba);
        $isOlderThanTwoDays = $tglTiba->isPast() && $tglTiba->diffInDays(Carbon::now()) > 2;

        // Set location based on the date check
        $location = $isOlderThanTwoDays ? 'Rumah Tangga' : $request->lokasi;

        // Prepare data for creating the data package
        $dataToCreate = array_merge($request->all(), [
            'lokasi' => $location,
            'user_id' => $userId // Store the ID of the authenticated user
        ]);

        // Save data package with user_id
        $dataPaket = DataPaket::create($dataToCreate);

        // Log the created data package
        Log::info('Data Paket Created: ', $dataPaket->toArray());

        // Save to history with updated location
        Histori::create([
            'no_resi' => $dataPaket->no_resi,
            'nama_produk' => $dataPaket->nama_produk,
            'nama_ekspedisi' => $dataPaket->nama_ekspedisi,
            'no_hpPenerima' => $formattedPhoneNumber, // Using the formatted phone number
            'tgl_tiba' => $dataPaket->tgl_tiba,
            'lokasi' => $location, // Using the updated location
            'status' => $dataPaket->status,
        ]);

        // Save to tracking with updated location
        LacakPaket::create([
            'no_resi' => $dataPaket->no_resi,
            'nama_produk' => $dataPaket->nama_produk,
            'nama_ekspedisi' => $dataPaket->nama_ekspedisi,
            'tgl_tiba' => $dataPaket->tgl_tiba,
            'lokasi' => $location, // Using the updated location
        ]);

        // Redirect to a specific route with a success message
        return redirect()->route('data-paket.index')->with('success', 'Data Paket created successfully.');
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

        // Generate Click to Chat URL
        return $this->sendWhatsAppClickToChat($formattedPhoneNumber, $dataPaket->no_resi, $location);
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


    /**
     * Send Click to Chat WhatsApp message.
     */
    private function sendWhatsAppClickToChat($phoneNumber, $noResi, $location)
    {
        // Prepare message
        $message = "Paket Anda sudah berada di lokasi: $location.\n\n" .
        "Mohon segera mengambil paket Anda. Jika Anda ingin melihat lokasi paket Anda, silakan kunjungi link berikut: [surpa.com](https://surpa.com) dan masukkan No. Resi Anda: $noResi.\n\n" .
        "Terima kasih.";

        // Create Click to Chat URL
        $url = "https://wa.me/$phoneNumber?text=" . urlencode($message);

        // Log Click to Chat URL
        Log::info('WhatsApp Click to Chat URL: ' . $url);

        // Redirect user to Click to Chat URL
        return redirect()->away($url);
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
