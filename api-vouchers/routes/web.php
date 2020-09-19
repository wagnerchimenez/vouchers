<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::resource('/clientes', ClienteController::class);

Route::get('/', [HomeController::class, 'index'])->name('home');
