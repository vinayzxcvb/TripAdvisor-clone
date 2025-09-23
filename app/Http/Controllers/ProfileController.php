<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function show(): View
    {
        $user = auth()->user();

        // CHANGE THIS LINE:
        // Eager load 'reviews.listing' instead of 'reviews.reviewable'
        $user->load(['reviews.listing']);

        return view('profile.show', compact('user'));
    }
}