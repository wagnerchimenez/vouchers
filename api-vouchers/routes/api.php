<?php

use App\Http\Controllers\Api\ClienteController;
use App\Http\Controllers\Api\OfertaController;
use App\Http\Controllers\Api\VoucherController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::apiResource('/clientes', ClienteController::class);
Route::apiResource('/ofertas', OfertaController::class);
Route::post('/ofertas/{ofertas_id}/vouchers', [OfertaController::class, 'gerarVouchers'])->name('ofertas.voucher.store');
Route::apiResource('/vouchers', VoucherController::class);
