<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\StafController;
use App\Http\Controllers\ObatController;

// DASHBOARD
Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// PELANGGAN WEB UI
Route::get('/pelanggan', [PelangganController::class, 'index'])->name('pelanggan.index');
Route::get('/pelanggan/tambah', [PelangganController::class, 'create'])->name('pelanggan.create');
Route::post('/pelanggan', [PelangganController::class, 'store'])->name('pelanggan.store');
Route::get('/pelanggan/{id}/detail', [PelangganController::class, 'show'])->name('pelanggan.show');
Route::get('/pelanggan/{id}/edit', [PelangganController::class, 'edit'])->name('pelanggan.edit');
Route::put('/pelanggan/{id}', [PelangganController::class, 'update'])->name('pelanggan.update');
Route::delete('/pelanggan/{id}', [PelangganController::class, 'destroy'])->name('pelanggan.destroy');

// STAF
Route::get('/staf', [StafController::class, 'index'])->name('staf.index');
Route::get('/staf/tambah', function () { return view('staf.create'); })->name('staf.create');
Route::post('/staf', [StafController::class, 'store'])->name('staf.store');
Route::get('/staf/{id}/detail', [StafController::class, 'show'])->name('staf.show');
Route::get('/staf/{id}/edit', [StafController::class, 'edit'])->name('staf.edit');
Route::put('/staf/{id}', [StafController::class, 'update'])->name('staf.update');
Route::delete('/staf/{id}', [StafController::class, 'destroy'])->name('staf.destroy');

// OBAT
Route::get('/obat', [ObatController::class, 'index'])->name('obat.index');
Route::get('/obat/tambah', function () { return view('obat.create'); })->name('obat.create');
Route::post('/obat', [ObatController::class, 'store'])->name('obat.store');
Route::get('/obat/{kode_obat}/detail', [ObatController::class, 'show'])->name('obat.show');
Route::get('/obat/{kode_obat}/edit', [ObatController::class, 'edit'])->name('obat.edit');
Route::put('/obat/{kode_obat}', [ObatController::class, 'update'])->name('obat.update');
Route::delete('/obat/{kode_obat}', [ObatController::class, 'destroy'])->name('obat.destroy');