<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Listing;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard with statistics.
     */
    public function index()
    {
        // Fetch statistics
        $userCount = User::count();
        $listingCount = Listing::count();
        $bookingCount = Booking::count();

        // Fetch the 5 most recent bookings, eager-loading user and listing info
        $recentBookings = Booking::with(['user', 'listing'])
            ->latest()
            ->take(5)
            ->get();
            
        return view('admin.dashboard', [
            'userCount' => $userCount,
            'listingCount' => $listingCount,
            'bookingCount' => $bookingCount,
            'recentBookings' => $recentBookings,
        ]);
    }
}