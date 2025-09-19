@extends('layouts.app')

@section('content')
<main class="flex-1 p-6">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <a href="{{ route('trips.index') }}" class="text-sm text-primary hover:underline">&larr; Back to all trips</a>
            <h2 class="text-2xl font-bold tracking-tight mt-1">{{ $trip->name }}</h2>
        </div>
        <div class="flex items-center gap-2">
            <button class="flex items-center justify-center gap-2 rounded-lg bg-primary text-white text-sm font-bold py-2 px-4 hover:bg-opacity-90 transition-all">
                <span class="material-symbols-outlined text-base">share</span>
                <span>Share</span>
            </button>
        </div>
    </div>
    
    <div class="mt-6 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
        @forelse ($trip->items as $item)
            <div class="flex flex-col gap-4 p-4 rounded-lg bg-white dark:bg-slate-900/60 border border-border-light dark:border-border-dark">
                <a href="{{ route('listings.show', $item->listing) }}">
                    <div class="h-40 rounded-lg bg-cover bg-center" style="background-image: url('{{ $item->listing->media->isNotEmpty() ? Storage::url($item->listing->media->first()->path) : 'https://placehold.co/600x400/1193d4/FFFFFF?text=Wanderlust' }}');"></div>
                </a>
                <div class="flex justify-between items-start">
                    <div>
                        <a href="{{ route('listings.show', $item->listing) }}" class="font-bold hover:text-primary">{{ $item->listing->name }}</a>
                        <p class="text-sm text-subtle-light dark:text-subtle-dark mt-1">{{ Str::limit($item->listing->address, 30) }}</p>
                    </div>
                     <form action="{{ route('trips.items.destroy', ['trip' => $trip, 'item' => $item]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-700 text-sm">Remove</button>
                    </form>
                </div>
            </div>
        @empty
            <div class="md:col-span-2 xl:col-span-3 flex items-center justify-center border-2 border-dashed border-border-light dark:border-border-dark rounded-lg p-10 text-subtle-light dark:text-subtle-dark">
                <div class="text-center">
                    <span class="material-symbols-outlined text-4xl">add_location_alt</span>
                    <p class="mt-2 text-sm font-medium">This trip is empty!</p>
                    <p class="text-xs">Go to a listing page to add places to your trip.</p>
                     <a href="{{ route('home') }}" class="mt-4 inline-block bg-primary text-white px-4 py-2 rounded-md font-medium hover:bg-opacity-90">
                        Find Things to Add
                    </a>
                </div>
            </div>
        @endforelse
    </div>
</main>
@endsection