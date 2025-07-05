<?php

use App\Http\Controllers\Admin\AdminHargaController;
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\LandingPageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PurchasingController;
use App\Http\Controllers\PurchasingDataController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [LandingPageController::class, 'index']);

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
//user
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('customer.dashboard');
    Route::get('/pembelian-pulsa', [PurchasingController::class, 'index'])->name('purchasing');
    Route::get('/pembelian-data', [PurchasingDataController::class, 'index'])->name('purchasing');
    Route::get('/paket-data/{provider}', [PurchasingDataController::class, 'getByProvider']);
    Route::post('/pembelian/paket-data', [PurchasingDataController::class, 'store']);
    Route::get('/produk/by-provider/{provider}', [PurchasingDataController::class, 'getProdukByProvider']);
    Route::get('/pulsa/by-provider/{provider}', [PurchasingController::class, 'getProdukByProvider']);

});


// admin
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [DashboardAdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/atur-harga', [AdminHargaController::class, 'index'])->name('admin.harga.index');
    Route::put('/atur-harga/{id}', [AdminHargaController::class, 'update'])->name('admin.harga.update');
    Route::get('/atur-harga/create', [AdminHargaController::class, 'create'])->name('admin.harga.create');
    Route::post('/atur-harga', [AdminHargaController::class, 'store'])->name('admin.harga.store');
    Route::get('/atur-harga/{id}/edit', [AdminHargaController::class, 'edit'])->name('admin.harga.edit');
    Route::put('/atur-harga/{id}', [AdminHargaController::class, 'update'])->name('admin.harga.update');
    Route::delete('/atur-harga/{id}', [AdminHargaController::class, 'destroy'])->name('admin.harga.destroy');
});



