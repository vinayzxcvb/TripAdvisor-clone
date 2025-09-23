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
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Admin\ListingController as AdminListingController;
use App\Http\Controllers\Admin\DashboardController;

// --- ADMIN ROUTES ---
Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {
    // Route::get('/dashboard', function () {
    //     return view('admin.dashboard');
    // })->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Listing Management Routes
    Route::get('/listings', [AdminListingController::class, 'index'])->name('listings.index'); // View all
    Route::get('/listings/create', [AdminListingController::class, 'create'])->name('listings.create');
    Route::post('/listings', [AdminListingController::class, 'store'])->name('listings.store');
    Route::get('/listings/{listing}/edit', [AdminListingController::class, 'edit'])->name('listings.edit'); // Show edit form
    Route::put('/listings/{listing}', [AdminListingController::class, 'update'])->name('listings.update'); // Handle update
    Route::delete('/listings/{listing}', [AdminListingController::class, 'destroy'])->name('listings.destroy'); // Handle delete
});
// --- WISHLIST & BOOKING ROUTES ---
Route::middleware('auth')->group(function () {
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/{listing}', [WishlistController::class, 'toggle'])->name('wishlist.toggle');
    Route::post('/bookings/{listing}', [BookingController::class, 'store'])->name('bookings.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
});

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
