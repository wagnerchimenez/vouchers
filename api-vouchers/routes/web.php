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
Route::get('/vouchers/validar', [VoucherController::class, 'formValidarVoucher'])->name('vouchers.validar');
Route::post('/vouchers/validar', [VoucherController::class, 'validarVoucher'])->name('vouchers.validar.store');
Route::get('/vouchers/validos', [VoucherController::class, 'formVouchersValidos'])->name('vouchers.validos');
Route::post('/vouchers/validos', [VoucherController::class, 'vouchersValidos'])->name('vouchers.validos.buscar');
Route::resource('/vouchers', VoucherController::class);

Route::get('/', [HomeController::class, 'index'])->name('home');
