<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
use App\Http\Controllers\ProductoController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('productos', ProductoController::class);