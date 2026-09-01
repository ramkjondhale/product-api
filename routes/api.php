<?php

use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ProductTypesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('product', ProductController::class);
Route::apiResource('product-type', ProductTypesController::class);
