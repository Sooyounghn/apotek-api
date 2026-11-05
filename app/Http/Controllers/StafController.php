<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class StafController extends Controller
{
    private $apiUrl = 'http://127.0.0.1:8001/api/staf';

    // Menampilkan semua data staf
    public function index()
    {
        try {
            $response = Http::acceptJson()->get($this->apiUrl);

            $hasil = $response->successful()
                ? $response->json()
                : [];

            $staf = $hasil['data'] ?? $hasil;

            if (!is_array($staf)) {
                $staf = [];
            }

            return view('staf.index', compact('staf'));

        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return view('staf.index', [
                'staf' => []
            ])->with('error', 'Tidak dapat terhubung ke API.');
        }
    }

    // Menambahkan staf
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'tempat_lahir' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
        ]);

        try {
            $response = Http::acceptJson()
                ->asJson()
                ->post($this->apiUrl, $validated);

            if ($response->successful()) {
                return redirect()->route('staf.index')
                    ->with('success', 'Data staf berhasil ditambahkan.');
            }

            return back()->withInput()
                ->with('error', 'Gagal menambahkan data staf.');

        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return back()->withInput()
                ->with('error', 'Tidak dapat terhubung ke API.');
        }
    }

    // Menampilkan detail staf
    public function show($id)
    {
        $response = Http::acceptJson()
            ->get($this->apiUrl . '/' . $id);

        if (!$response->successful()) {
            return redirect()->route('staf.index')
                ->with('error', 'Data staf tidak ditemukan.');
        }

        $hasil = $response->json();
        $staf = $hasil['data'] ?? $hasil;

        return view('staf.show', compact('staf'));
    }

    // Form edit staf
    public function edit($id)
    {
        $response = Http::acceptJson()
            ->get($this->apiUrl . '/' . $id);

        if (!$response->successful()) {
            return redirect()->route('staf.index')
                ->with('error', 'Data staf tidak ditemukan.');
        }

        $hasil = $response->json();
        $staf = $hasil['data'] ?? $hasil;

        return view('staf.edit', compact('staf'));
    }

    // Memperbarui data staf
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'tempat_lahir' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
        ]);

        $response = Http::acceptJson()
            ->asJson()
            ->put($this->apiUrl . '/' . $id, $validated);

        if ($response->successful()) {
            return redirect()->route('staf.index')
                ->with('success', 'Data staf berhasil diperbarui.');
        }

        return back()->withInput()
            ->with('error', 'Gagal memperbarui data staf.');
    }

    // Menghapus data staf
    public function destroy($id)
    {
        $response = Http::acceptJson()
            ->delete($this->apiUrl . '/' . $id);

        if ($response->successful()) {
            return redirect()->route('staf.index')
                ->with('success', 'Data staf berhasil dihapus.');
        }

        return redirect()->route('staf.index')
            ->with('error', 'Gagal menghapus data staf.');
    }
}
