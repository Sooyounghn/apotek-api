<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PelangganController;
use App\Http\Controllers\Api\StafController;
use App\Http\Controllers\Api\ObatController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route API Apotek
Route::apiResource('pelanggan', PelangganController::class);
Route::apiResource('staf', StafController::class);
Route::apiResource('obat', ObatController::class);
