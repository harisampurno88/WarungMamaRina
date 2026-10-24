<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController; // Tambahkan baris ini
use Illuminate\Support\Facades\Route;

// 1. Halaman utama publik untuk pelanggan (tanpa login)
Route::get('/', [MenuController::class, 'katalogPelanggan'])->name('katalog');

// Route untuk menerima form pesanan dari pelanggan
Route::post('/pesan', [OrderController::class, 'store'])->name('order.store'); // Tambahkan baris ini

// 2. Grup Route khusus Admin (wajib login)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Route untuk CRUD Menu (Otomatis membuat jalur create, read, update, delete)
    Route::resource('menu', MenuController::class);
});

// 3. Route Profil bawaan Breeze (Biarkan saja untuk pengaturan akun admin)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';