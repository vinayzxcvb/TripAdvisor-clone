<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    /**
     * Store a new media file for a listing.
     * UPDATED to save data that matches your 'medias' table.
     */
    public function store(Request $request, Listing $listing)
    {
        $request->validate([
            'media_file' => 'required|file|mimes:jpeg,png,jpg|max:20480', // 20MB Max
        ]);

        $path = $request->file('media_file')->store('media_uploads', 'public');
        
        // This is the corrected 'create' call
        $listing->media()->create([
            'user_id' => auth()->id(),
            'path' => $path,
            'listing_id' => $listing->id, // We already have this from the route
            'listing_type' => $listing->type, // Get the type from the listing model
        ]);

        return back()->with('success', 'Your photo has been uploaded successfully.');
    }
}