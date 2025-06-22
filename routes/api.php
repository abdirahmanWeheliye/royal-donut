<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\DonutController;
use App\Models\Donut;

Route::get('/retrieve-donuts', function () { return Donut::all();});

Route::post('/create-donut', [DonutController::class, 'store']);
Route::delete('/delete-donut/{id}', [DonutController::class, 'destroy']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
