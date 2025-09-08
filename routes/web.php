<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController as AuthController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\TripItemController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\HotelPricingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/
// Route::view('register', 'register');
// Route::view('login', 'login');

Route::get('/', [ListingController::class, 'index'])->name('home');
Route::middleware('guest')->group(function () {
    // Show Registration Form
    Route::get('register', [AuthController::class, 'createRegister'])->name('register');
    // Handle Registration Submission
    Route::post('register', [AuthController::class, 'storeRegister']);

    // Show Login Form
    Route::get('login', [AuthController::class, 'createLogin'])->name('login');
    // Handle Login Submission
    Route::post('login', [AuthController::class, 'storeLogin']);
});
Route::post('logout', [AuthController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

// Listings, Reviews, and Media
Route::prefix('listings/{listing}')->group(function () {
    Route::get('/', [ListingController::class, 'show'])->name('listings.show');
    
    // Middleware ensures only authenticated users can post
    Route::middleware('auth')->group(function () {
        Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
        Route::post('/media', [MediaController::class, 'store'])->name('media.store');
    });
});


// Trip Planning (requires authentication)
Route::middleware('auth')->prefix('trips')->name('trips.')->group(function () {
    Route::get('/', [TripController::class, 'index'])->name('index');
    Route::post('/', [TripController::class, 'store'])->name('store');
    Route::get('/{trip}', [TripController::class, 'show'])->name('show');
    
    // Adding/removing items from a specific trip
    Route::post('/{trip}/items', [TripItemController::class, 'store'])->name('items.store');
    Route::delete('/{trip}/items/{item}', [TripItemController::class, 'destroy'])->name('items.destroy');
});


// Community Forums
Route::prefix('forums')->name('forums.')->group(function () {
    Route::get('/', [ForumController::class, 'index'])->name('index');
    Route::get('/threads/{thread}', [ForumController::class, 'show'])->name('show');

    Route::middleware('auth')->group(function () {
        Route::post('/threads', [ForumController::class, 'storeThread'])->name('threads.store');
        Route::post('/threads/{thread}/posts', [ForumController::class, 'storePost'])->name('posts.store');
    });
});


// API-like route for fetching hotel prices
Route::get('/api/hotels/{listing}/prices', [HotelPricingController::class, 'getPrices'])->name('hotels.prices');

// Add Laravel's default authentication routes if you have them installed
// Auth::routes();