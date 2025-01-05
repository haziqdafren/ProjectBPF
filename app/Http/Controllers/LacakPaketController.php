<?php

namespace App\Http\Controllers;

use App\Models\LacakPaket; // Pastikan model ini ada
use Illuminate\Http\Request;

class LacakPaketController extends Controller
{
    public function search(Request $request)
    {
        // Validasi input
        $request->validate([
            'resi' => 'required|string|max:255',
        ]);

        $no_resi = $request->input('resi');

        // Cari data berdasarkan no_resi
        $results = LacakPaket::where('no_resi', $no_resi)->get();

        // Kembalikan view dengan data yang ditemukan
        return view('session/lacakpaket', compact('results'));
    }

    public function index(){
        return view('session/lacakpaket'); 
    }
}
