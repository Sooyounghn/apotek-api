<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Staf;
use Illuminate\Http\Request;

class StafController extends Controller
{
    public function index()
    {
        return response()->json(Staf::all(), 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string',
            'alamat' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'tempat_lahir' => 'required|string',
            'no_hp' => 'required|string',
        ]);

        $staf = Staf::create($validated);
        return response()->json($staf, 201);
    }

    public function show($id)
    {
        $staf = Staf::findOrFail($id);
        return response()->json($staf, 200);
    }

    public function update(Request $request, $id)
    {
        $staf = Staf::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'sometimes|required|string',
            'alamat' => 'sometimes|required|string',
            'tanggal_lahir' => 'sometimes|required|date',
            'tempat_lahir' => 'sometimes|required|string',
            'no_hp' => 'sometimes|required|string',
        ]);

        $staf->update($validated);
        return response()->json($staf, 200);
    }

    public function destroy($id)
    {
        $staf = Staf::findOrFail($id);
        $staf->delete();
        return response()->json(['message' => 'Data staf berhasil dihapus'], 200);
    }
}
