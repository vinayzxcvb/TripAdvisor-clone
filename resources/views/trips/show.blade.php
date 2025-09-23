@extends('layouts.app')

@section('title', 'Trip: ' . $trip->name)

@section('content')
<div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">{{ $trip->name }}</h1>
        <a href="{{ route('trips.index') }}" class="text-primary font-medium hover:underline">
            ← Back to all trips
        </a>
    </div>

    {{-- Section 1: Items Currently in the Trip --}}
    <div class="bg-white dark:bg-slate-900/60 rounded-lg shadow mb-12">
        <div class="p-6 border-b border-gray-200 dark:border-slate-700">
             <h2 class="text-2xl font-semibold text-gray-800 dark:text-white">Your Itinerary</h2>
        </div>
        <div class="space-y-4 p-6">
            @forelse ($trip->items as $item)
                <div class="p-4 flex justify-between items-center hover:bg-gray-50 dark:hover:bg-slate-800 rounded-md">
                    <div>
                        <a href="{{ route('listings.show', $item->listing) }}" class="text-xl font-semibold text-gray-800 dark:text-white hover:text-primary">
                            {{ $item->listing->name }}
                        </a>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ $item->listing->address }}</p>
                    </div>
                    
                    <form action="{{ route('trips.items.destroy', ['trip' => $trip, 'item' => $item]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-700 font-semibold text-sm">
                            Remove
                        </button>
                    </form>
                </div>
            @empty
                <div class="text-center py-6 text-gray-500">
                    <p>Your trip is empty. Add places from the list below!</p>
                </div>
            @endforelse
        </div>
    </div>

    {{-- Section 2: Available Listings to Add to the Trip --}}
    <div>
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Find Places to Add</h2>
        <div class="space-y-4">
             @foreach ($availableListings as $listing)
                <div class="p-4 bg-white dark:bg-slate-900/60 rounded-lg shadow-sm flex justify-between items-center">
                    <div class="flex items-center gap-4">
                        <div class="w-24 h-16 rounded-lg bg-cover bg-center flex-shrink-0"
                             style="background-image: url('https://placehold.co/600x400/1193d4/FFFFFF?text={{ urlencode($listing->name) }}');">
                        </div>
                        <div>
                            <a href="{{ route('listings.show', $listing) }}" class="font-semibold text-gray-800 dark:text-white hover:text-primary">
                                {{ $listing->name }}
                            </a>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $listing->address }}</p>
                        </div>
                    </div>
                    {{-- Add to Trip Form --}}
                    <form action="{{ route('trips.items.store', $trip) }}" method="POST">
                        @csrf
                        <input type="hidden" name="listing_id" value="{{ $listing->id }}">
                        <button type="submit" class="bg-primary/10 text-primary font-bold py-2 px-4 rounded-lg hover:bg-primary/20 whitespace-nowrap">
                            + Add to Trip
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
        {{-- Pagination for available listings --}}
        <div class="mt-8">
            {{ $availableListings->links() }}
        </div>
    </div>
</div>
@endsection