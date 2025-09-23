<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\Listing;

class TripController extends Controller
{
    /**
     * Protect all trip routes with authentication middleware.
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Display a list of the authenticated user's trips. 🗺️
     */
    public function index(): View
    {
        // Fetch trips that belong only to the currently logged-in user.
        $trips = auth()->user()->trips()->latest()->get();
        return view('trips.index', compact('trips'));
    }

    /**
     * Store a new trip in the database. ✈️
     */
    // app/Http/Controllers/TripController.php
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
        ]);

        // Add the current date to the data before creating
        $tripData = array_merge($validated, ['start_date' => now()]);

        $trip = auth()->user()->trips()->create($tripData);

        return redirect()->route('trips.show', $trip)
            ->with('success', 'Your trip has been created!');
    }

    /**
     * Display a specific trip and its saved items. 🧳
     */
    public function show(Trip $trip): View
    {
        // Authorization Check
        if ($trip->user_id !== auth()->id()) {
            abort(403, 'This is not your trip!');
        }

        // Eager load items for efficiency
        $trip->load('items.listing');
        
        // Get the IDs of listings already in the trip
        $existingListingIds = $trip->items->pluck('listing_id');

        // Fetch all other listings that are NOT already in the trip
        $availableListings = Listing::whereNotIn('id', $existingListingIds)
            ->latest()
            ->paginate(10);

        return view('trips.show', compact('trip', 'availableListings'));
    }
}
