@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-12 px-4 sm-px-6 lg-px-8">
    {{-- Display a dynamic heading with the user's search query --}}
    <h1 class="text-3xl font-bold text-gray-900 mb-8">
        Search Results for: <span class="text-primary">"{{ $query }}"</span>
    </h1>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        {{-- Loop through the listings passed from the controller --}}
        @forelse ($listings as $listing)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden transform hover:-translate-y-1 transition-transform duration-300">
                <a href="{{ route('listings.show', $listing) }}">
                    <img class="h-56 w-full object-cover" 
                         src="{{ $listing->media->isNotEmpty() ? Storage::url($listing->media->first()->path) : 'https://images.unsplash.com/photo-1562832135-14a35d25edef?q=80' }}" 
                         alt="{{ $listing->name }}">
                    <div class="p-6">
                        <h3 class="text-2xl font-bold text-gray-800">{{ $listing->name }}</h3>
                        <p class="text-sm text-gray-500 mt-1">{{ $listing->address }}</p>
                        <p class="mt-4 text-gray-600">{{ Str::limit($listing->description, 100) }}</p>
                    </div>
                </a>
            </div>
        @empty
            {{-- This message shows if no listings were found --}}
            <div class="col-span-3 text-center py-12">
                <p class="text-lg text-gray-500">Sorry, no listings found matching your search.</p>
                <a href="{{ route('home') }}" class="mt-4 inline-block text-primary font-semibold hover:underline">
                    &larr; Back to Homepage
                </a>
            </div>
        @endforelse
    </div>

    {{-- Pagination Links for the search results --}}
    <div class="mt-8">
        {{ $listings->appends(['query' => $query])->links() }}
    </div>
</div>
@endsection