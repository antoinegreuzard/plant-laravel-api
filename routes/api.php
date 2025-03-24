<?php

use App\Http\Controllers\PlantController;
use App\Http\Controllers\PlantPhotoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

// Routes PUBLIQUES
Route::get('plants', [PlantController::class, 'index']);
Route::get('plants/{plant}', [PlantController::class, 'show']);
Route::get('plants/{plant}/photos', [PlantPhotoController::class, 'index']);

// Routes PROTÉGÉES
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('plants', [PlantController::class, 'store']);
    Route::put('plants/{plant}', [PlantController::class, 'update']);
    Route::delete('plants/{plant}', [PlantController::class, 'destroy']);

    Route::post('plants/{plant}/photos', [PlantPhotoController::class, 'store']);
});
