<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TemperatureController;

Route::middleware('check.token')->group(function () {
    Route::get('temperature-history', [TemperatureController::class, 'getTemperatureHistory']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
