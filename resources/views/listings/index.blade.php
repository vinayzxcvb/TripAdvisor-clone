@extends('layouts.app')

@section('content')
<div class="flex-1">
    <div class="relative min-h-[500px] flex flex-col items-center justify-center text-white p-8" style='background-image: linear-gradient(rgba(0, 0, 0, 0.3) 0%, rgba(0, 0, 0, 0.6) 100%), url("https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?q=80&w=2070"); background-size: cover; background-position: center;'>
        {{-- ... Hero content ... --}}
        <div class="flex flex-col gap-4 text-center">
            <h1 class="text-4xl md:text-6xl font-black tracking-tighter">Your Journey Begins Here</h1>
            <p class="max-w-2xl text-base md:text-lg text-white/90">Discover the world's most incredible destinations and create unforgettable memories with ExploreEdge.</p>
        </div>
        
        <div class="mt-8 w-full max-w-2xl">
            @guest
                <a href="{{ route('register') }}" class="mt-8 inline-block rounded-lg bg-primary px-6 h-12 text-base font-bold text-white hover:bg-primary/90 transition-colors flex items-center justify-center">
                    Explore More
                </a>
            @else
                <form action="{{ route('listings.search') }}" method="GET" class="relative">
                    <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-500">🔍</span>
                    <input class="w-full rounded-full border-transparent bg-white dark:bg-slate-800 py-4 pl-12 pr-28 text-lg text-gray-800 shadow-md focus:border-primary focus:ring-primary" name="query" placeholder="Where to? (e.g., 'Paris')" type="text"/>
                    <button type="submit" class="absolute right-2 top-1/2 -translate-y-1/2 rounded-full bg-primary px-6 h-12 text-base font-bold text-white hover:bg-primary/90 transition-colors">Search</button>
                </form>
            @endauth
        </div>
    </div>
    
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        
        {{-- START: NEW CATEGORY TABS --}}
        <div class="py-8">
            <div class="flex justify-center border-b border-slate-200 dark:border-slate-700">
                @php
                    // Set default type to 'hotel' if it's missing or empty
                    $currentType = request()->input('type', 'hotel');
                @endphp

                <a href="{{ route('home', ['type' => 'hotel']) }}" 
                   class="flex items-center gap-2 border-b-2 px-6 py-3 text-sm font-medium transition-colors
                          {{ $currentType == 'hotel' ? 'border-primary text-primary' : 'border-transparent text-slate-500 hover:border-slate-300' }}">
                    <span class="material-symbols-outlined">🛌🏻</span>
                    Hotels
                </a>
                <a href="{{ route('home', ['type' => 'restaurant']) }}" 
                   class="flex items-center gap-2 border-b-2 px-6 py-3 text-sm font-medium transition-colors
                          {{ $currentType == 'restaurant' ? 'border-primary text-primary' : 'border-transparent text-slate-500 hover:border-slate-300' }}">
                    <span class="material-symbols-outlined">🍽️</span>
                    Restaurants
                </a>
                <a href="{{ route('home', ['type' => 'attraction']) }}"
                   class="flex items-center gap-2 border-b-2 px-6 py-3 text-sm font-medium transition-colors
                          {{ $currentType == 'attraction' ? 'border-primary text-primary' : 'border-transparent text-slate-500 hover:border-slate-300' }}">
                    <span class="material-symbols-outlined"></span>
                    attractions
                </a>
            </div>
        </div>
        {{-- END: NEW CATEGORY TABS --}}

        <section class="pb-16">
            <div class="flex items-center justify-between mb-6 px-4">
                <h2 class="text-3xl font-bold tracking-tight text-slate-900 dark:text-white">Popular Destinations</h2>
            </div>
            <div class="relative">
                <div class="flex gap-6 overflow-x-auto pb-4 snap-x snap-mandatory [-ms-scrollbar-style:none] [scrollbar-width:none] [&::-webkit-scrollbar]:hidden">
                    @forelse ($listings as $listing)
                        <div class="flex-none w-1/4 snap-start px-2">
                            <a href="{{ route('listings.show', $listing) }}" class="group">
                                <div class="w-full aspect-video bg-cover bg-center rounded-lg overflow-hidden">
                                    <div class="w-full h-full bg-cover bg-center group-hover:scale-105 transition-transform duration-300" 
                                         style="background-image: url('https://placehold.co/600x400/1193d4/FFFFFF?text={{ urlencode($listing->name) }}')">
                                    </div>
                                </div>
                                <div>
                                    <h3 class="mt-2 text-lg font-bold text-slate-900 dark:text-white">{{ $listing->name }}</h3>
                                    <p class="text-sm text-slate-600 dark:text-slate-400 truncate">{{ $listing->description }}</p>
                                </div>
                            </a>
                        </div>
                    @empty
                        <div class="w-full text-center py-10">
                            <p class="text-slate-500">No popular destinations found for this category.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>
    </div>
</div>
@endsection