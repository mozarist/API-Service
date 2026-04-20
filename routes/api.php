<?php

use App\Http\Controllers\StudentController;
use App\Http\Controllers\BookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/api-service', function() {
    return response()->json([
        'message' => 'API service is working'
    ]);
});

Route::apiResource('/students', StudentController::class);
Route::apiResource('/books', BookController::class);