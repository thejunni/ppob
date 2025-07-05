<?php
use App\Http\Controllers\Api\DigiflazzController;
use Illuminate\Support\Facades\Route;

Route::get('/digiflazz/saldo', [DigiflazzController::class, 'cekSaldo']);
Route::get('/digiflazz/pricelist', [DigiflazzController::class, 'priceList']);
Route::post('/digiflazz/beli', [DigiflazzController::class, 'beliPulsa']);
