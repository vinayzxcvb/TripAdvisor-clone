@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-8">Popular Destinations</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        {{-- Loop through listings passed from the controller --}}
        @forelse ($listings as $listing)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden transform hover:-translate-y-1 transition-transform duration-300">
                <a href="{{ route('listings.show', $listing) }}">
                    {{-- Placeholder image --}}
                    <img class="h-56 w-full object-cover" src="https://images.unsplash.com/photo-1502602898657-3e91760c0337?q=80" alt="{{ $listing->name }}">
                    <div class="p-6">
                        <h2 class="text-2xl font-bold text-gray-800">{{ $listing->name }}</h2>
                        <p class="text-sm text-gray-500 mt-1">{{ $listing->address }}</p>
                        <p class="mt-4 text-gray-600">{{ Str::limit($listing->description, 100) }}</p>
                    </div>
                </a>
            </div>
        @empty
            <p class="col-span-3 text-center text-gray-500">No listings found.</p>
        @endforelse
    </div>
</div>
@endsection