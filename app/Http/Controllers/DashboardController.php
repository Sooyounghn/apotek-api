<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPelanggan = 0;
        $totalStaf = 0;
        $totalObat = 0;

        try {
            // Mengambil data pelanggan
            $responsePelanggan = Http::acceptJson()
                ->timeout(10)
                ->get('http://127.0.0.1:8001/api/pelanggan');

            if ($responsePelanggan->successful()) {
                $hasil = $responsePelanggan->json();
                $data = $hasil['data'] ?? $hasil;

                if (is_array($data)) {
                    $totalPelanggan = count($data);
                }
            }

            // Mengambil data staf
            $responseStaf = Http::acceptJson()
                ->timeout(10)
                ->get('http://127.0.0.1:8001/api/staf');

            if ($responseStaf->successful()) {
                $hasil = $responseStaf->json();
                $data = $hasil['data'] ?? $hasil;

                if (is_array($data)) {
                    $totalStaf = count($data);
                }
            }

            // Mengambil data obat
            $responseObat = Http::acceptJson()
                ->timeout(10)
                ->get('http://127.0.0.1:8001/api/obat');

            if ($responseObat->successful()) {
                $hasil = $responseObat->json();
                $data = $hasil['data'] ?? $hasil;

                if (is_array($data)) {
                    $totalObat = count($data);
                }
            }

        } catch (\Exception $e) {
            Log::error('Dashboard API Error: ' . $e->getMessage());
        }

        return view('dashboard', compact(
            'totalPelanggan',
            'totalStaf',
            'totalObat'
        ));
    }
}
