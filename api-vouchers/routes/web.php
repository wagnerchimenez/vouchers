<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OfertaController;
use App\Http\Controllers\VoucherController;
use Illuminate\Support\Facades\Route;

Route::resource('/clientes', ClienteController::class);
Route::resource('/ofertas', OfertaController::class);
Route::get('/ofertas/{ofertas_id}/vouchers', [OfertaController::class, 'formClienteVoucher'])->name('ofertas.voucher.create');
Route::post('/ofertas/{ofertas_id}/vouchers', [OfertaController::class, 'clienteVoucherStore'])->name('ofertas.voucher.store');
Route::resource('/vouchers', VoucherController::class);

Route::get('/', [HomeController::class, 'index'])->name('home');
