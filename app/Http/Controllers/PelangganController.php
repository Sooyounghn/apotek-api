<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PelangganController extends Controller
{
    private $apiUrl = 'http://127.0.0.1:8001/api/pelanggan';

    // Menampilkan daftar pelanggan
    public function index()
    {
        try {
            $response = Http::acceptJson()
                ->timeout(10)
                ->get($this->apiUrl);

            $hasil = $response->successful()
                ? $response->json()
                : [];

            $pelanggan = $hasil['data'] ?? $hasil;

            if (!is_array($pelanggan)) {
                $pelanggan = [];
            }

            return view('pelanggan.index', compact('pelanggan'));

        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return view('pelanggan.index', [
                'pelanggan' => []
            ])->with('error', 'Tidak dapat terhubung ke API.');
        }
    }

    // Menyimpan pelanggan baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_hp' => 'required|string|max:20',
        ]);

        try {
            $response = Http::acceptJson()
                ->asJson()
                ->timeout(10)
                ->post($this->apiUrl, $validated);

            if ($response->successful()) {
                return redirect()->route('pelanggan.index')
                    ->with('success', 'Data pelanggan berhasil ditambahkan.');
            }

            return back()->withInput()
                ->with('error', 'Gagal menambahkan pelanggan.');

        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return back()->withInput()
                ->with('error', 'Tidak dapat terhubung ke API.');
        }
    }

    // Menampilkan detail pelanggan
    public function show($id)
    {
        $response = Http::acceptJson()
            ->get($this->apiUrl . '/' . $id);

        if (!$response->successful()) {
            return redirect()->route('pelanggan.index')
                ->with('error', 'Data pelanggan tidak ditemukan.');
        }

        $hasil = $response->json();
        $pelanggan = $hasil['data'] ?? $hasil;

        return view('pelanggan.show', compact('pelanggan'));
    }

    // Menampilkan form edit
    public function edit($id)
    {
        $response = Http::acceptJson()
            ->get($this->apiUrl . '/' . $id);

        if (!$response->successful()) {
            return redirect()->route('pelanggan.index')
                ->with('error', 'Data pelanggan tidak ditemukan.');
        }

        $hasil = $response->json();
        $pelanggan = $hasil['data'] ?? $hasil;

        return view('pelanggan.edit', compact('pelanggan'));
    }

    // Memperbarui data pelanggan
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_hp' => 'required|string|max:20',
        ]);

        $response = Http::acceptJson()
            ->asJson()
            ->put($this->apiUrl . '/' . $id, $validated);

        if ($response->successful()) {
            return redirect()->route('pelanggan.index')
                ->with('success', 'Data pelanggan berhasil diperbarui.');
        }

        return back()->withInput()
            ->with('error', 'Gagal memperbarui data pelanggan.');
    }

    // Menghapus pelanggan
    public function destroy($id)
    {
        $response = Http::acceptJson()
            ->delete($this->apiUrl . '/' . $id);

        if ($response->successful()) {
            return redirect()->route('pelanggan.index')
                ->with('success', 'Data pelanggan berhasil dihapus.');
        }

        return redirect()->route('pelanggan.index')
            ->with('error', 'Gagal menghapus data pelanggan.');
    }
}
