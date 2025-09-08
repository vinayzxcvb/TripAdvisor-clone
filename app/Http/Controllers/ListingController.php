<?php

namespace App\Http\Controllers;

use App\Models\Listing;
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

    /**
     * Display the specified listing, eager-loading its reviews and media.
     */
    public function show(Listing $listing)
    {
        $listing->load(['reviews.user', 'media']);
        return view('listings.show', compact('listing'));
    }
}