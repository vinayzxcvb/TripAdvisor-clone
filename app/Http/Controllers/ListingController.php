<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ListingController extends Controller
{
    /**
     * Display a curated list of listings for the homepage.
     * This now ONLY handles the homepage and uses a simple cache key.
     */
    public function index(Request $request)
    {
        // Get the type from the URL, default to 'hotel' if not present
        $type = $request->input('type', 'hotel');

        // Use a dynamic cache key that includes the type
        $cacheKey = 'listings.homepage.' . $type;

        $listings = Cache::remember($cacheKey, now()->addMinutes(60), function () use ($type) {
            // Fetch the latest 12 listings of the specified type
            return Listing::where('type', $type)->latest()->take(12)->get();
        });

        return view('listings.index', compact('listings'));
    }

    /**
     * Display a paginated list of listings based on a search query.
     * This now handles ALL search requests.
     */
    public function search(Request $request)
    {
        $query = $request->input('query');

        // Search the database for listings matching the query
        // The call to ->with('media') has been removed to prevent the error
        $listings = Listing::where('name', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->paginate(15);

        // Return the dedicated search results view
        return view('listings.results', [
            'listings' => $listings,
            'query' => $query
        ]);
    }

    /**
     * Display the specified listing.
     */
    // public function show(Listing $listing)
    // {
    //     // The call to load 'media' has been removed to prevent the error
    //     $listing->load(['reviews.user']);

    //     return view('listings.show', compact('listing'));
    // }

    public function show(Listing $listing)
    {
        // Find the previous listing (with a lower ID)
        $previousListing = Listing::where('id', '<', $listing->id)->orderBy('id', 'desc')->first();

        // Find the next listing (with a higher ID)
        $nextListing = Listing::where('id', '>', $listing->id)->orderBy('id', 'asc')->first();

        // Load the reviews for the current listing
        $listing->load(['reviews.user']);

        $totalReviews = $listing->reviews->count();
        $ratingPercentages = [];

        if ($totalReviews > 0) {
            // Group reviews by their rating (1, 2, 3, 4, 5)
            $reviewsByRating = $listing->reviews->groupBy('rating');

            for ($i = 5; $i >= 1; $i--) {
                $countForRating = $reviewsByRating->has($i) ? $reviewsByRating->get($i)->count() : 0;
                $ratingPercentages[$i] = round(($countForRating / $totalReviews) * 100);
            }
        }

        return view('listings.show', compact('listing', 'previousListing', 'nextListing'));
    }
}
