<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TripController extends Controller
{
    /**
     * Protect all trip routes with authentication middleware.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

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
    public function store(Request $request): RedirectResponse
    {
        // Validate the incoming request.
        $validated = $request->validate([
            'name' => 'required|string|max:100',
        ]);

        // Create the trip and associate it with the authenticated user.
        $trip = auth()->user()->trips()->create($validated);

        // Redirect the user to their newly created trip's page.
        return redirect()->route('trips.show', $trip)->with('success', 'Your trip has been created!');
    }

    /**
     * Display a specific trip and its saved items. 🧳
     */
    public function show(Trip $trip): View
    {
        // **Authorization Check:** Ensure the user owns this trip.
        if ($trip->user_id !== auth()->id()) {
            abort(403, 'This is not your trip!');
        }

        // Eager load the items and the listings associated with them for efficiency.
        $trip->load('items.listing');

        return view('trips.show', compact('trip'));
    }
}