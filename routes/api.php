<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\CategoryController;
use App\Http\Controllers\Api\V1\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware(['throttle:api'])->prefix('v1')->group(function() {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
});

Route::middleware(['throttle:api', 'auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('posts', PostController::class);
    Route::get('logout', [AuthController::class, 'logout']);
});
