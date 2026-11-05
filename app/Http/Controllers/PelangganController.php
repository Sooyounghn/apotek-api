<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;
use Illuminate\Support\Facades\Log;

class PelangganController extends Controller
{
    // 1. Menampilkan daftar pelanggan di UI Web
    public function index()
    {
        try {
            $pelanggan = Pelanggan::latest()->get();
            return view('pelanggan.index', compact('pelanggan'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return view('pelanggan.index', ['pelanggan' => []])
                ->with('error', 'Gagal mengambil data pelanggan.');
        }
    }

    // 2. Menampilkan form tambah pelanggan
    public function create()
    {
        return view('pelanggan.create');
    }

    // 3. Menyimpan data langsung ke DB & REDIRECT KE TABEL UI (/pelanggan)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'   => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_hp'  => 'required|string|max:20',
        ]);

        try {
            // Simpan langsung ke database via Eloquent Model
            Pelanggan::create($validated);

            // Redirect paksa ke halaman UI tabel pelanggan
            return redirect()->route('pelanggan.index')
                ->with('success', 'Data pelanggan berhasil ditambahkan.');

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->withInput()->with('error', 'Gagal menyimpan data pelanggan.');
        }
    }

    // 4. Detail pelanggan
    public function show($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        return view('pelanggan.show', compact('pelanggan'));
    }

    // 5. Form Edit
    public function edit($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        return view('pelanggan.edit', compact('pelanggan'));
    }

    // 6. Update data pelanggan
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama'   => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_hp'  => 'required|string|max:20',
        ]);

        try {
            $pelanggan = Pelanggan::findOrFail($id);
            $pelanggan->update($validated);

            return redirect()->route('pelanggan.index')
                ->with('success', 'Data pelanggan berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->withInput()->with('error', 'Gagal memperbarui data pelanggan.');
        }
    }

    // 7. Hapus pelanggan
    public function destroy($id)
    {
        try {
            $pelanggan = Pelanggan::findOrFail($id);
            $pelanggan->delete();

            return redirect()->route('pelanggan.index')
                ->with('success', 'Data pelanggan berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('pelanggan.index')
                ->with('error', 'Gagal menghapus data pelanggan.');
        }
    }
}