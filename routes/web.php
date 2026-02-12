<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('clients', \App\Http\Controllers\ClientController::class);
Route::resource('measurement_units', \App\Http\Controllers\MeasurementUnitController::class);
Route::resource('products', \App\Http\Controllers\ProductController::class);
