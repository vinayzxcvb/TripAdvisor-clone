<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use App\Models\TripItem;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class TripItemController extends Controller
{
    // The __construct() method has been removed from here.

    /**
     * Add a new listing to a user's trip. ➕
     */
    public function store(Request $request, Trip $trip): RedirectResponse
    {
        // **Authorization Check:**
        if ($trip->user_id !== auth()->id()) {
            abort(403, 'You do not have permission to modify this trip.');
        }

        $validated = $request->validate([
            'listing_id' => 'required|exists:listings,id',
        ]);

        $isAlreadyAdded = $trip->items()->where('listing_id', $validated['listing_id'])->exists();

        if ($isAlreadyAdded) {
            return back()->with('info', 'This item is already in your trip.');
        }

        $trip->items()->create([
            'listing_id' => $validated['listing_id'],
        ]);

        return redirect()->route('trips.show', $trip)->with('success', 'Item added to your trip!');
    }

    /**
     * Remove a listing from a user's trip. 🗑️
     */
    public function destroy(Trip $trip, TripItem $item): RedirectResponse
    {
        // **Authorization Check:**
        if ($trip->user_id !== auth()->id() || $item->trip_id !== $trip->id) {
            abort(403, 'You do not have permission to remove this item.');
        }

        $item->delete();

        return redirect()->route('trips.show', $trip)->with('success', 'Item removed from your trip.');
    }
}