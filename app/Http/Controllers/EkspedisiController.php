<?php

namespace App\Http\Controllers;

use App\Models\Ekspedisi;
use Illuminate\Http\Request;

class EkspedisiController extends Controller
{
    public function index()
    {
        $ekspedisis = Ekspedisi::all();
        return view('ekspedisi_index', compact('ekspedisis'));
    }

    public function create()
    {
        return view('tambahDataEkpedisi');
    }

    public function store(Request $request)
    {
        $request->validate([
            'Id_ekpedisi' => 'required',
            'nama_ekspedisi' => 'required',
            'kontak' => 'required',
        ]);

        Ekspedisi::create($request->all());
        return redirect()->route('ekspedisi.index')->with('success', 'Data ekspedisi berhasil disimpan.');
    }

    public function edit(Ekspedisi $ekspedisi)
    {
        return view('ekspedisi.edit', compact('ekspedisi'));
    }

    public function update(Request $request, Ekspedisi $ekspedisi)
    {
        $request->validate([
            'Id_ekpedisi' => 'required',
            'nama_ekspedisi' => 'required',
            'kontak' => 'required',
        ]);

        $ekspedisi->update($request->all());
        return redirect()->route('ekspedisi.index')->with('success', 'Data ekspedisi berhasil diperbarui.');
    }

    public function destroy(Ekspedisi $ekspedisi)
    {
        $ekspedisi->delete();
        return redirect()->route('ekspedisi.index')->with('success', 'Data ekspedisi berhasil dihapus.');
    }
}
