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

Route::get('/', [ListingController::class, 'index'])->name('home');
Route::get('/search', [ListingController::class, 'search'])->name('listings.search');
// --- AUTHENTICATION ROUTES ---
Route::middleware('guest')->group(function () {
    Route::get('register', [AuthController::class, 'createRegister'])->name('register');
    Route::post('register', [AuthController::class, 'storeRegister']);
    Route::get('login', [AuthController::class, 'createLogin'])->name('login');
    Route::post('login', [AuthController::class, 'storeLogin']);
});

Route::post('logout', [AuthController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

// --- LISTINGS, REVIEWS, AND MEDIA ---
Route::prefix('listings/{listing}')->group(function () {
    Route::get('/', [ListingController::class, 'show'])->name('listings.show');

    Route::middleware('auth')->group(function () {
        Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
        Route::post('/media', [MediaController::class, 'store'])->name('media.store');
    });
});

// --- TRIP PLANNING ---
Route::middleware('auth')->prefix('trips')->name('trips.')->group(function () {
    Route::get('/', [TripController::class, 'index'])->name('index');
    Route::post('/', [TripController::class, 'store'])->name('store');
    Route::get('/{trip}', [TripController::class, 'show'])->name('show');
    Route::post('/{trip}/items', [TripItemController::class, 'store'])->name('items.store');
    Route::delete('/{trip}/items/{item}', [TripItemController::class, 'destroy'])->name('items.destroy');
});

// --- COMMUNITY FORUMS ---
Route::prefix('forums')->name('forums.')->group(function () {
    Route::get('/threads/create', [ForumController::class, 'create'])->name('threads.create');
    Route::get('/', [ForumController::class, 'index'])->name('index');
    Route::get('/threads/{thread}', [ForumController::class, 'show'])->name('show');

    Route::middleware('auth')->group(function () {
        Route::get('/threads/create', [ForumController::class, 'create'])->name('threads.create');
        Route::post('/threads', [ForumController::class, 'storeThread'])->name('threads.store');
        Route::post('/threads/{thread}/posts', [ForumController::class, 'storePost'])->name('posts.store');
    });
});
