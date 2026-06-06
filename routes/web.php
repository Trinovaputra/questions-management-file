<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\MateriController;
use App\Http\Controllers\DashboardController;

Route::redirect('/', '/login');
Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', function () {
        return view('auth.register');
    })->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/materi', [MateriController::class, 'siswaIndex'])->name('materi.index');
    Route::get('/siswa/dashboard', [DashboardController::class, 'siswa'])->name('siswa.dashboard');
    Route::get('/materi/{id}', [MateriController::class, 'showSiswa'])->name('materi.show');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Admin Routes
Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::view('/admin/materi/create', 'admin.materi.create')->name('materi.admin.create');
    Route::get('/admin/materi/{id}/edit', [MateriController::class, 'edit'])->name('materi.admin.edit');
    Route::put('/admin/materi/{id}', [MateriController::class, 'update'])->name('materi.admin.update');
    Route::get('/admin/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');
    Route::get('/admin/materi', [MateriController::class, 'index'])->name('materi.admin.index');
    Route::get('/admin/materi/{id}', [MateriController::class, 'show'])->name('materi.admin.show');
});
