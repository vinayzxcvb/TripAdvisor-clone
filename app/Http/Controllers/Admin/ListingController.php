<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ListingController extends Controller
{
    /**
     * Display a list of all listings for the admin.
     */
    public function index()
    {
        $listings = Listing::latest()->paginate(10);
        return view('admin.listings.index', compact('listings'));
    }
    
    public function create()
    {
        return view('admin.listings.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'type' => 'required|in:hotel,restaurant,attraction',
            'description' => 'required|string',
        ]);

        Listing::create($validated);
        Cache::forget('listings.homepage');
        return redirect()->route('admin.listings.index')->with('success', 'New listing created successfully!');
    }

    /**
     * Show the form for editing the specified listing.
     */
    public function edit(Listing $listing)
    {
        return view('admin.listings.edit', compact('listing'));
    }

    /**
     * Update the specified listing in storage.
     */
    public function update(Request $request, Listing $listing)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'type' => 'required|in:hotel,restaurant,attraction',
            'description' => 'required|string',
        ]);

        $listing->update($validated);
        Cache::forget('listings.homepage');
        return redirect()->route('admin.listings.index')->with('success', 'Listing updated successfully!');
    }

    /**
     * Remove the specified listing from storage.
     */
    public function destroy(Listing $listing)
    {
        $listing->delete();
        Cache::forget('listings.homepage');
        return back()->with('success', 'Listing has been deleted.');
    }
}