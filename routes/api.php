<?php

use App\Http\Controllers\PlantController;
use App\Http\Controllers\PlantPhotoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('plants', [PlantController::class, 'store']);
    Route::put('plants/{plant}', [PlantController::class, 'update']);
    Route::delete('plants/{plant}', [PlantController::class, 'destroy']);
    Route::post('plants/{plant}/photos', [PlantPhotoController::class, 'store']);
});
