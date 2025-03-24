<?php

use App\Http\Controllers\PlantController;
use App\Http\Controllers\PlantPhotoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('plants/', [PlantController::class, 'index'])->name('plant-list');
Route::get('plants/{plant}/', [PlantController::class, 'show'])->name('plant-detail');
Route::get('plants/{plant}/photos/', [PlantPhotoController::class, 'index'])->name('plant-photos-list');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('plants/', [PlantController::class, 'store']);
    Route::put('plants/{plant}/', [PlantController::class, 'update']);
    Route::delete('plants/{plant}/', [PlantController::class, 'destroy']);

    Route::post('plants/{plant}/upload-photo/', [PlantPhotoController::class, 'store'])
        ->name('plant-upload-photo');
});
