@extends('layouts.app')

@section('content')
<div class="flex-1">
    <div class="relative min-h-[500px] flex flex-col items-center justify-center text-white p-8" style='background-image: linear-gradient(rgba(0, 0, 0, 0.3) 0%, rgba(0, 0, 0, 0.6) 100%), url("https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?q=80&w=2070"); background-size: cover; background-position: center;'>
        <div class="flex flex-col gap-4 text-center">
            <h1 class="text-4xl md:text-6xl font-black tracking-tighter">Your Journey Begins Here</h1>
            <p class="max-w-2xl text-base md:text-lg text-white/90">Discover the world's most incredible destinations and create unforgettable memories with Wanderlust.</p>
        </div>
        
        {{-- Search Form --}}
        <div class="mt-8 w-full max-w-2xl">
            <form action="{{ route('listings.search') }}" method="GET" class="relative">
                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-500">search</span>
                <input class="w-full rounded-full border-transparent bg-white dark:bg-slate-800 py-4 pl-12 pr-28 text-lg text-gray-800 shadow-md focus:border-primary focus:ring-primary" name="query" placeholder="Where to? (e.g., 'Paris')" type="text"/>
                <button type="submit" class="absolute right-2 top-1/2 -translate-y-1/2 rounded-full bg-primary px-6 h-12 text-base font-bold text-white hover:bg-primary/90 transition-colors">Search</button>
            </form>
        </div>
    </div>
    
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <section class="py-16">
            <h2 class="text-3xl font-bold tracking-tight text-slate-900 dark:text-white px-4">Popular Destinations</h2>
            <div class="mt-6 flex overflow-x-auto gap-6 pb-4 px-4 -mx-4 [-ms-scrollbar-style:none] [scrollbar-width:none] [&::-webkit-scrollbar]:hidden">
                @forelse ($listings as $listing)
                    <div class="flex-none w-72 flex flex-col gap-3 group">
                         <a href="{{ route('listings.show', $listing) }}">
                            <div class="w-full aspect-video bg-cover bg-center rounded-lg overflow-hidden">
                                <img alt="{{ $listing->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" src="{{ $listing->media->isNotEmpty() ? Storage::url($listing->media->first()->path) : 'https://placehold.co/600x400/1193d4/FFFFFF?text=Wanderlust' }}"/>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-slate-900 dark:text-white">{{ $listing->name }}</h3>
                                <p class="text-sm text-slate-600 dark:text-slate-400">{{ Str::limit($listing->description, 40) }}</p>
                            </div>
                        </a>
                    </div>
                @empty
                    <p class="text-slate-500">No popular destinations found right now.</p>
                @endforelse
            </div>
        </section>
    </div>
</div>
@endsection