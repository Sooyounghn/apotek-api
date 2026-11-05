<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staf;
use Illuminate\Support\Facades\Log;

class StafController extends Controller
{
    public function index()
    {
        try {
            $staf = Staf::latest()->get();
            return view('staf.index', compact('staf'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return view('staf.index', ['staf' => []])
                ->with('error', 'Gagal mengambil data staf.');
        }
    }

    public function create()
    {
        return view('staf.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'          => 'required|string|max:255',
            'alamat'        => 'required|string',
            'tanggal_lahir' => 'required|date',
            'tempat_lahir'  => 'required|string|max:255',
            'no_hp'         => 'required|string|max:20',
        ]);

        try {
            Staf::create($validated);
            return redirect()->route('staf.index')
                ->with('success', 'Data staf berhasil ditambahkan.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->withInput()->with('error', 'Gagal menyimpan data staf.');
        }
    }

    public function show($id)
    {
        $staf = Staf::findOrFail($id);
        return view('staf.show', compact('staf'));
    }

    public function edit($id)
    {
        $staf = Staf::findOrFail($id);
        return view('staf.edit', compact('staf'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama'          => 'required|string|max:255',
            'alamat'        => 'required|string',
            'tanggal_lahir' => 'required|date',
            'tempat_lahir'  => 'required|string|max:255',
            'no_hp'         => 'required|string|max:20',
        ]);

        try {
            $staf = Staf::findOrFail($id);
            $staf->update($validated);

            return redirect()->route('staf.index')
                ->with('success', 'Data staf berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->withInput()->with('error', 'Gagal memperbarui data staf.');
        }
    }

    public function destroy($id)
    {
        try {
            $staf = Staf::findOrFail($id);
            $staf->delete();

            return redirect()->route('staf.index')
                ->with('success', 'Data staf berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('staf.index')
                ->with('error', 'Gagal menghapus data staf.');
        }
    }
}
