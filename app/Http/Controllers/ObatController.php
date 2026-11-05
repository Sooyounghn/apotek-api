<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ObatController extends Controller
{
    private $apiUrl = 'http://127.0.0.1:8001/api/obat';

    // Menampilkan semua data obat
    public function index()
    {
        try {
            $response = Http::acceptJson()
                ->timeout(10)
                ->get($this->apiUrl);

            $hasil = $response->successful()
                ? $response->json()
                : [];

            $obat = $hasil['data'] ?? $hasil;

            if (!is_array($obat)) {
                $obat = [];
            }

            return view('obat.index', compact('obat'));

        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return view('obat.index', [
                'obat' => []
            ])->with('error', 'Tidak dapat terhubung ke API.');
        }
    }

    // Menambahkan obat baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_obat' => 'required|string|max:255',
            'stock_obat' => 'required|integer|min:0',
            'tanggal_kadaluarsa' => 'required|date',
        ]);

        try {
            $response = Http::acceptJson()
                ->asJson()
                ->timeout(10)
                ->post($this->apiUrl, $validated);

            if ($response->successful()) {
                return redirect()->route('obat.index')
                    ->with('success', 'Data obat berhasil ditambahkan.');
            }

            Log::error('API obat gagal menyimpan: ' . $response->body());

            return back()->withInput()
                ->with('error', 'Gagal menambahkan data obat.');

        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return back()->withInput()
                ->with('error', 'Tidak dapat terhubung ke API.');
        }
    }

    // Menampilkan detail obat
    public function show($kode_obat)
    {
        $response = Http::acceptJson()
            ->get($this->apiUrl . '/' . $kode_obat);

        if (!$response->successful()) {
            return redirect()->route('obat.index')
                ->with('error', 'Data obat tidak ditemukan.');
        }

        $hasil = $response->json();
        $obat = $hasil['data'] ?? $hasil;

        return view('obat.show', compact('obat'));
    }

    // Form edit obat
    public function edit($kode_obat)
    {
        $response = Http::acceptJson()
            ->get($this->apiUrl . '/' . $kode_obat);

        if (!$response->successful()) {
            return redirect()->route('obat.index')
                ->with('error', 'Data obat tidak ditemukan.');
        }

        $hasil = $response->json();
        $obat = $hasil['data'] ?? $hasil;

        return view('obat.edit', compact('obat'));
    }

    // Memperbarui data obat
    public function update(Request $request, $kode_obat)
    {
        $validated = $request->validate([
            'nama_obat' => 'required|string|max:255',
            'stock_obat' => 'required|integer|min:0',
            'tanggal_kadaluarsa' => 'required|date',
        ]);

        $response = Http::acceptJson()
            ->asJson()
            ->put($this->apiUrl . '/' . $kode_obat, $validated);

        if ($response->successful()) {
            return redirect()->route('obat.index')
                ->with('success', 'Data obat berhasil diperbarui.');
        }

        return back()->withInput()
            ->with('error', 'Gagal memperbarui data obat.');
    }

    // Menghapus data obat
    public function destroy($kode_obat)
    {
        $response = Http::acceptJson()
            ->delete($this->apiUrl . '/' . $kode_obat);

        if ($response->successful()) {
            return redirect()->route('obat.index')
                ->with('success', 'Data obat berhasil dihapus.');
        }

        return redirect()->route('obat.index')
            ->with('error', 'Gagal menghapus data obat.');
    }
}