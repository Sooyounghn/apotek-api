<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Obat;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    public function index()
    {
        return response()->json(Obat::all(), 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_obat' => 'required|string',
            'stock_obat' => 'required|integer',
            'tanggal_kadaluarsa' => 'required|date',
        ]);

        $obat = Obat::create($validated);
        return response()->json($obat, 201);
    }

    public function show($id)
    {
        $obat = Obat::findOrFail($id);
        return response()->json($obat, 200);
    }

    public function update(Request $request, $id)
    {
        $obat = Obat::findOrFail($id);

        $validated = $request->validate([
            'nama_obat' => 'sometimes|required|string',
            'stock_obat' => 'sometimes|required|integer',
            'tanggal_kadaluarsa' => 'sometimes|required|date',
        ]);

        $obat->update($validated);
        return response()->json($obat, 200);
    }

    public function destroy($id)
    {
        $obat = Obat::findOrFail($id);
        $obat->delete();
        return response()->json(['message' => 'Data obat berhasil dihapus'], 200);
    }
}
