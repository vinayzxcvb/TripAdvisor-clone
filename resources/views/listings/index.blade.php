@extends('layouts.app')

@section('content')
{{-- Hero Section with Search --}}
<section class="relative h-96 flex items-center justify-center text-center text-white bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?q=80&w=2070');">
    <div class="absolute top-0 left-0 w-full h-full bg-black opacity-40"></div>
    <div class="relative z-10 max-w-4xl w-full mx-auto px-4">
        <h1 class="text-4xl md:text-5xl font-extrabold mb-6">Where to?</h1>
        <p class="mt-2 text-lg">for Hotels, Attractions, Restaurants, and more</p>
        {{-- Updated Search Box --}}
        <div class="bg-white rounded-full p-2 shadow-lg">
            {{-- The form now points to our new search route --}}
            <form action="{{ route('listings.search') }}" method="GET" class="flex items-center">
                <div class="flex-grow flex items-center pl-4">
                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    <input type="text" name="query" placeholder="Place to go, things to do, hotels..." class="w-full ml-2 text-gray-700 focus:outline-none bg-transparent">
                </div>
                <button type="submit" class="bg-primary text-white px-8 py-3 rounded-full font-semibold hover:bg-opacity-90">Search</button>
            </form>
        </div>
    </div>
</section>
{{-- Main Content Area --}}
<div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <h2 class="text-3xl font-bold text-gray-900 mb-8">Popular Destinations</h2>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        {{-- Loop through listings passed from the controller --}}
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
            <p class="col-span-3 text-center text-gray-500">No listings found. Please run the database seeder.</p>
        @endforelse
    </div>
</div>
@endsection