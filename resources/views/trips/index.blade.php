@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-900">My Trips</h1>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md mb-8">
        <h2 class="text-2xl font-semibold mb-4 text-gray-800">Create a New Trip</h2>
        <form action="{{ route('trips.store') }}" method="POST" class="flex items-center space-x-4">
            @csrf
            <div class="flex-grow">
                <label for="name" class="sr-only">Trip Name</label>
                <input type="text" name="name" id="name" required 
                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary sm:text-sm" 
                       placeholder="e.g., Summer Vacation in Paris">
            </div>
            <button type="submit" class="bg-primary text-white px-6 py-2 rounded-md font-medium hover:bg-opacity-90 whitespace-nowrap">
                Create Trip
            </button>
        </form>
    </div>

    <div class="bg-white rounded-lg shadow">
        <div class="space-y-4 p-6">
            @forelse ($trips as $trip)
                <div class="p-4 border-b last:border-b-0 hover:bg-gray-50 rounded-md">
                    <a href="{{ route('trips.show', $trip) }}" class="block">
                        <h3 class="text-xl font-semibold text-gray-800 hover:text-primary">{{ $trip->name }}</h3>
                        <p class="text-sm text-gray-500 mt-1">Created {{ $trip->created_at->format('M d, Y') }}</p>
                    </a>
                </div>
            @empty
                <div class="p-6 text-center text-gray-500">
                    <p>You haven't created any trips yet. Use the form above to start planning!</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection