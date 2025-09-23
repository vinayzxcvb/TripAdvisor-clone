<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index()
    {
        // Get the authenticated user's wishlisted items and paginate them
        $wishlistItems = auth()->user()->wishlist()->paginate(10);

        return view('wishlist.index', compact('wishlistItems'));
    }

    public function toggle(Request $request, Listing $listing)
    {
        // Toggle the relationship
        // The syncWithoutDetaching method will add the user_id and listing_id if they don't exist,
        // or do nothing if they already exist. Here we use toggle which is simpler.
        $request->user()->wishlist()->toggle($listing->id);

        return back()->with('success', 'Wishlist updated!');
    }
}