<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PackageService;

class HomeController extends Controller
{
    protected $packageService;

    public function __construct(PackageService $packageService)
    {
        $this->packageService = $packageService;
    }

    public function home()
    {
        // Get statistics using service
        $statistics = $this->packageService->getStatistics();

        // Extract for backward compatibility with views
        $jumlahDataMasuk = $statistics['total'];
        $jumlahDataMasukPosSecurity = $statistics['pos_security'];
        $jumlahDataMasukRumahTangga = $statistics['rumah_tangga'];

        // Send data to view
        return view('beranda', compact('jumlahDataMasuk', 'jumlahDataMasukPosSecurity', 'jumlahDataMasukRumahTangga'));
    }

    public function search(Request $request)
    {
        // Validate input
        $request->validate([
            'query' => 'required|string|max:255',
        ]);

        $query = $request->input('query');

        // Use service for search
        $dataPaket = $this->packageService->searchPackages($query, 5);

        // Get statistics
        $statistics = $this->packageService->getStatistics();
        $jumlahDataMasuk = $statistics['total'];
        $jumlahDataMasukPosSecurity = $statistics['pos_security'];
        $jumlahDataMasukRumahTangga = $statistics['rumah_tangga'];

        // Return view with found data
        return view('beranda', compact('dataPaket', 'jumlahDataMasuk', 'jumlahDataMasukPosSecurity', 'jumlahDataMasukRumahTangga'));
    }
}
