<?php

namespace App\Http\Controllers;

use App\Models\LacakPaket; // Pastikan model ini ada
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

        // Membangun query
        $results = LacakPaket::with('ekspedisi')
            ->where('no_resi', 'LIKE', "%{$query}%") // Mencari berdasarkan no_resi
            ->orWhere('nama_pemilik', 'LIKE', "%{$query}%") // Mencari berdasarkan nama_pemilik
            ->paginate(5); // Gunakan paginate untuk membatasi hasil

        // Kembalikan view dengan data yang ditemukan
        return view('session.lacakpaket', compact('results'));
    }






    public function index(){
        return view('session/lacakpaket');
    }
}
