<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;


class ListingController extends Controller
{
    /**
     * Display a paginated list of listings based on search criteria.
     * Uses Redis caching for performance.
     */
    public function index(Request $request)
    {
        $query = $request->input('query', '');
        $cacheKey = 'listings.search.' . md5($query);

        $listings = Cache::remember($cacheKey, now()->addMinutes(10), function () use ($query) {
            return Listing::where('name', 'like', "%{$query}%")
                ->orWhere('description', 'like', "%{$query}%")
                ->paginate(15);
        });

        return view('listings.index', compact('listings'));
    }
    // public function index()
    // {
    //     // 2. Count all reviews in the database
    //     $reviewCount = Review::count();

    //     // Get listings and their individual review counts
    //     $listings = Listing::with('media')
    //         ->withCount('reviews')
    //         ->latest()
    //         ->paginate(15);

    //     // 3. Pass both variables to the view
    //     return view('listings.index', [
    //         'listings' => $listings,
    //         'reviewCount' => $reviewCount
    //     ]);
    // }
    public function search(Request $request)
    {
        // 1. Get the search query from the request
        $query = $request->input('query');

        // 2. Search the database for listings where the name or description matches the query
        $listings = Listing::with('media')
            ->where('name', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->paginate(15);

        // 3. Return a new view with the search results
        return view('listings.results', [
            'listings' => $listings,
            'query' => $query
        ]);
    }
    /**
     * Display the specified listing, eager-loading its reviews and media.
     */
    public function show(Listing $listing)
    {
        $listing->load(['reviews.user', 'media']);
        return view('listings.show', compact('listing'));
    }
}
