<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Listing;
use Illuminate\Http\Request;

class BookingController extends Controller
{

    public function index()
    {
        $bookings = auth()->user()
            ->bookings()
            ->with('listing') // Eager load the listing details for each booking
            ->latest()
            ->paginate(10);

        return view('bookings.index', compact('bookings'));
    }

    public function store(Request $request, Listing $listing)
    {
        $validated = $request->validate([
            'check_in_date' => 'required|date|after_or_equal:today',
            'check_out_date' => 'required|date|after:check_in_date',
            'number_of_guests' => 'required|integer|min:1',
        ]);

        // Note: This is a simplified price calculation.
        // A real app would have dynamic pricing.
        $pricePerNight = 350; // Example price
        $days = (new \DateTime($validated['check_in_date']))->diff(new \DateTime($validated['check_out_date']))->days;
        $totalPrice = $days * $pricePerNight;

        Booking::create([
            'user_id' => auth()->id(),
            'listing_id' => $listing->id,
            'check_in_date' => $validated['check_in_date'],
            'check_out_date' => $validated['check_out_date'],
            'number_of_guests' => $validated['number_of_guests'],
            'total_price' => $totalPrice,
            'status' => 'confirmed', // Default to confirmed for simplicity
        ]);

        return back()->with('success', 'Booking confirmed! An email has been sent to you.');
    }
}