<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MateriController;

// Public API routes (authenticated users)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/materi', [MateriController::class, 'index']);
    Route::get('/materi/{id}', [MateriController::class, 'show']);
    Route::get('/materi/{id}/download', [MateriController::class, 'download']);
});

// Admin-only API routes
Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::get('/admin/materi/{id}', [MateriController::class, 'show']);
    Route::post('/materi', [MateriController::class, 'store']);
    Route::put('/materi/{id}', [MateriController::class, 'update']);
    Route::delete('/materi/{id}', [MateriController::class, 'destroy']);
});

