<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the authenticated user's profile.
     *
     * @return \Illuminate\View\View
     */
    public function show(): View
    {
        // Get the currently authenticated user
        $user = auth()->user();

        // Eager load the user's reviews and the listings associated with each review
        // This is efficient and prevents multiple database queries in the view
        $user->load(['reviews.reviewable']);

        // Return the profile view and pass the user data to it
        return view('profile.show', compact('user'));
    }
}