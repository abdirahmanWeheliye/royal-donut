<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DonutController;

Route::get('/retrieve-donuts', [DonutController::class, 'index']);
Route::post('/create-donut', [DonutController::class, 'store']);
Route::delete('/delete-donut/{id}', [DonutController::class, 'destroy']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
