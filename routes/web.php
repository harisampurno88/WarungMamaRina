
<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

// ==================================================
// 1. HALAMAN PUBLIK UNTUK PELANGGAN
// ==================================================
// Katalog pelanggan
Route::get('/', [MenuController::class, 'katalogPelanggan'])
    ->name('katalog');

// Form pemesanan satu menu
Route::get('/pesan/{menu}', [OrderController::class, 'create'])
    ->name('order.create');

// Simpan pesanan
Route::post('/pesan', [OrderController::class, 'store'])
    ->name('order.store');

// Detail pesanan setelah berhasil disimpan
Route::get('/pesanan/{order}', [OrderController::class, 'show'])
    ->name('order.show');


// ==================================================
// 2. HALAMAN ADMIN (WAJIB LOGIN DAN VERIFIED)
// ==================================================

Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard admin
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // CRUD menu
    Route::resource('menu', MenuController::class);

});


// ==================================================
// 3. PENGATURAN PROFIL ADMIN
// ==================================================

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

});


// ==================================================
// 4. ROUTE AUTENTIKASI LARAVEL BREEZE
// ==================================================

require __DIR__.'/auth.php';
