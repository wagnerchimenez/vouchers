<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OfertaController;
use Illuminate\Support\Facades\Route;

Route::resource('/clientes', ClienteController::class);
Route::resource('/ofertas', OfertaController::class);

Route::get('/', [HomeController::class, 'index'])->name('home');
