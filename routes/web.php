<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TemperatureHistoryController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/temperature-history', [TemperatureHistoryController::class, 'index'])->name('temperature.history');
