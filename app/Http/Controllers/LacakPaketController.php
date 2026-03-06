<?php

namespace App\Http\Controllers;

use App\Models\DataPaket; // Use DataPaket model instead
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class LacakPaketController extends Controller
{

    public function search(Request $request)
    {
        // Validasi input
        $request->validate([
            'query' => 'required|string|max:255', // Validasi untuk query
        ]);

        $query = $request->input('query');

        // Membangun query menggunakan DataPaket model
        $results = DataPaket::with('ekspedisi')
            ->where('no_resi', 'LIKE', "%{$query}%") // Mencari berdasarkan no_resi
            ->orWhere('nama_pemilik', 'LIKE', "%{$query}%") // Mencari berdasarkan nama_pemilik
            ->get(); // Use get() instead of paginate for guest page

        // Kembalikan view dengan data yang ditemukan
        return view('session.lacakpaket', compact('results'));
    }






    public function index(){
        return view('session/lacakpaket');
    }
}
