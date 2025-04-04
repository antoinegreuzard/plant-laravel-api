<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PlantController;
use App\Http\Controllers\PlantPhotoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('token/', [AuthController::class, 'login'])->name('token_obtain_pair');
Route::post('token/refresh/', [AuthController::class, 'refresh'])->name('token_refresh');

Route::middleware('auth:api')->get('/user', fn(Request $request) => $request->user());

Route::middleware('auth:api')->group(function () {
    Route::get('plants/', [PlantController::class, 'index'])->name('plant-list');
    Route::get('plants/{plant}/', [PlantController::class, 'show'])->name('plant-detail');
    Route::get('plants/{plant}/photos/', [PlantPhotoController::class, 'index'])->name('plant-photos-list');

    Route::post('plants/', [PlantController::class, 'store']);
    Route::put('plants/{plant}/', [PlantController::class, 'update']);
    Route::delete('plants/{plant}/', [PlantController::class, 'destroy']);

    Route::post('plants/{plant}/upload-photo/', [PlantPhotoController::class, 'store'])
        ->name('plant-upload-photo');
});

Route::get('/health', function () {
    return response()->json(['status' => 'ok']);
});
