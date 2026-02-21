<?php

namespace App\Services;

use App\Models\DataPaket;

class PackageService
{
    /**
     * Search packages by receipt number, owner name, or phone number
     *
     * @param string $query Search query
     * @param int $perPage Items per page for pagination
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function searchPackages(string $query, int $perPage = 5)
    {
        return DataPaket::where('no_resi', 'LIKE', "%{$query}%")
            ->orWhere('nama_pemilik', 'LIKE', "%{$query}%")
            ->orWhere('no_hpPenerima', 'LIKE', "%{$query}%")
            ->with('ekspedisi') // Eager load ekspedisi relationship
            ->latest('tgl_tiba') // Most recent first
            ->paginate($perPage);
    }

    /**
     * Get package statistics
     *
     * @return array
     */
    public function getStatistics(): array
    {
        return [
            'total' => DataPaket::count(),
            'pos_security' => DataPaket::where('lokasi', 'Pos Security')->count(),
            'rumah_tangga' => DataPaket::where('lokasi', 'Rumah Tangga')->count(),
            'belum_diterima' => DataPaket::where('status', 'Belum Diterima')->count(),
            'sudah_diterima' => DataPaket::where('status', 'Sudah Diterima')->count(),
        ];
    }

    /**
     * Get recent packages
     *
     * @param int $limit Number of packages to retrieve
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getRecentPackages(int $limit = 10)
    {
        return DataPaket::with('ekspedisi')
            ->latest('created_at')
            ->limit($limit)
            ->get();
    }

    /**
     * Format phone number to Indonesian international format
     *
     * @param string $phoneNumber
     * @return string
     */
    public function formatPhoneNumber(string $phoneNumber): string
    {
        // Remove any whitespace
        $phoneNumber = trim($phoneNumber);

        // Check if the phone number starts with '0'
        if (substr($phoneNumber, 0, 1) === '0') {
            // Replace '0' with '+62'
            return '+62' . substr($phoneNumber, 1);
        }

        // If already starts with +62 or 62
        if (substr($phoneNumber, 0, 3) === '+62') {
            return $phoneNumber;
        }

        if (substr($phoneNumber, 0, 2) === '62') {
            return '+' . $phoneNumber;
        }

        // If the number is already in international format, return as is
        return $phoneNumber;
    }
}
