@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    {{-- Listing Header --}}
    <div class="bg-white p-8 rounded-lg shadow-md mb-8">
        <h1 class="text-4xl font-extrabold text-gray-900">{{ $listing->name }}</h1>
        <p class="text-lg text-gray-600 mt-2">{{ $listing->address }}</p>
        <div class="mt-4 text-gray-700">
            {{ $listing->description }}
        </div>
    </div>

    {{-- Reviews Section --}}
    <div class="mt-12">
        <h2 class="text-3xl font-bold text-gray-900 mb-6">Reviews</h2>
        
        {{-- Form to Add a New Review (Only for logged-in users) --}}
        @auth
            <div class="bg-white p-6 rounded-lg shadow-md mb-8">
                <h3 class="text-xl font-semibold mb-4">Leave a Review</h3>
                <form action="{{ route('reviews.store', $listing) }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="rating" class="block text-sm font-medium text-gray-700">Rating (1-5)</label>
                        <input type="number" name="rating" id="rating" min="1" max="5" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary sm:text-sm">
                    </div>
                    <div class="mb-4">
                        <label for="body" class="block text-sm font-medium text-gray-700">Your Review</label>
                        <textarea name="body" id="body" rows="4" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary sm:text-sm"></textarea>
                    </div>
                    <button type="submit" class="bg-primary text-white px-4 py-2 rounded-md font-medium hover:bg-opacity-90">Submit Review</button>
                </form>
            </div>
        @else
            <p class="text-center bg-gray-200 p-4 rounded-md mb-8">
                You must be <a href="{{-- route('login') --}}" class="text-primary font-semibold">logged in</a> to leave a review.
            </p>
        @endauth

        {{-- Display Existing Reviews --}}
        <div class="space-y-6">
            @forelse ($listing->reviews as $review)
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="flex items-center mb-2">
                        <span class="text-lg font-semibold text-gray-800 mr-4">{{ $review->user->name }}</span>
                        <span class="text-yellow-500 font-bold">★ {{ $review->rating }}/5</span>
                    </div>
                    <p class="text-gray-600">{{ $review->body }}</p>
                    <p class="text-xs text-gray-400 mt-4">{{ $review->created_at->diffForHumans() }}</p>
                </div>
            @empty
                <p class="text-center text-gray-500">Be the first to leave a review!</p>
            @endforelse
        </div>
    </div>
</div>
@endsection