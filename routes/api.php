<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Public routes for authentication
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected routes (routes that require a valid token)
Route::middleware('auth:sanctum')->group(function () {
    // Example: Get the authenticated user's details
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Add other protected API routes here...
    // e.g., Route::post('/trips', [TripController::class, 'store']);
});