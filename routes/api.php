<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PelangganController;
use App\Http\Controllers\Api\StafController;
use App\Http\Controllers\Api\ObatController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route API Apotek (Semua diberi alias api. biar gak bentrok sama Web Blade)
Route::apiResource('pelanggan', PelangganController::class)->names([
    'index'   => 'api.pelanggan.index',
    'store'   => 'api.pelanggan.store',
    'show'    => 'api.pelanggan.show',
    'update'  => 'api.pelanggan.update',
    'destroy' => 'api.pelanggan.destroy',
]);

Route::apiResource('staf', StafController::class)->names([
    'index'   => 'api.staf.index',
    'store'   => 'api.staf.store',
    'show'    => 'api.staf.show',
    'update'  => 'api.staf.update',
    'destroy' => 'api.staf.destroy',
]);

Route::apiResource('obat', ObatController::class)->names([
    'index'   => 'api.obat.index',
    'store'   => 'api.obat.store',
    'show'    => 'api.obat.show',
    'update'  => 'api.obat.update',
    'destroy' => 'api.obat.destroy',
]);
