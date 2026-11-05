<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Obat;
use Illuminate\Support\Facades\Log;

class ObatController extends Controller
{
    public function index()
    {
        try {
            $obat = Obat::latest()->get();
            return view('obat.index', compact('obat'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return view('obat.index', ['obat' => []])
                ->with('error', 'Gagal mengambil data obat.');
        }
    }

    public function create()
    {
        return view('obat.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_obat'          => 'required|string|max:255',
            'stock_obat'         => 'required|integer|min:0',
            'tanggal_kadaluarsa' => 'required|date',
        ]);

        try {
            Obat::create($validated);

            return redirect()->route('obat.index')
                ->with('success', 'Data obat berhasil ditambahkan.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->withInput()->with('error', 'Gagal menyimpan data obat.');
        }
    }

    public function show($kode_obat)
    {
        $obat = Obat::findOrFail($kode_obat);
        return view('obat.show', compact('obat'));
    }

    public function edit($kode_obat)
    {
        $obat = Obat::findOrFail($kode_obat);
        return view('obat.edit', compact('obat'));
    }

    public function update(Request $request, $kode_obat)
    {
        $validated = $request->validate([
            'nama_obat'          => 'required|string|max:255',
            'stock_obat'         => 'required|integer|min:0',
            'tanggal_kadaluarsa' => 'required|date',
        ]);

        try {
            $obat = Obat::findOrFail($kode_obat);
            $obat->update($validated);

            return redirect()->route('obat.index')
                ->with('success', 'Data obat berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->withInput()->with('error', 'Gagal memperbarui data obat.');
        }
    }

    public function destroy($kode_obat)
    {
        try {
            $obat = Obat::findOrFail($kode_obat);
            $obat->delete();

            return redirect()->route('obat.index')
                ->with('success', 'Data obat berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('obat.index')
                ->with('error', 'Gagal menghapus data obat.');
        }
    }
}