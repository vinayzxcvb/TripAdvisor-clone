<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class ReviewController extends Controller
{

    /**
     * Store a new review for a given listing.
     */
    public function store(Request $request, Listing $listing)
{
    $validated = $request->validate([
        'rating' => 'required|integer|min:1|max:5',
        'body' => 'required|string|min:1',
    ]);

    $listing->reviews()->create([
        'user_id' => auth()->id(),
        'rating' => $validated['rating'],
        'body' => $validated['body'],
        'listing_type' => $listing->type,
    ]);

    return back()->with('success', 'Thank you! Your review has been submitted.');
}
}