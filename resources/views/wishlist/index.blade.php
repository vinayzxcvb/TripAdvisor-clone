@extends('layouts.app')

@section('title', 'My Wishlist - ExploreEdge')

@section('content')
<div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-8">My Wishlist</h1>

    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg mb-6" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <div class="space-y-6">
        @forelse ($wishlistItems as $listing)
            <div class="overflow-hidden rounded-lg bg-white shadow-sm transition-shadow duration-300 hover:shadow-lg dark:bg-slate-900/60">
                <div class="flex flex-col sm:flex-row">
                    <div class="sm:w-1/3">
                        <div class="h-48 w-full bg-cover bg-center sm:h-full" 
                             style="background-image: url('https://placehold.co/600x400/1193d4/FFFFFF?text={{ urlencode($listing->name) }}');">
                        </div>
                    </div>
                    <div class="flex flex-1 flex-col justify-between p-6">
                        <div>
                            <h3 class="text-lg font-bold text-slate-800 dark:text-white">{{ $listing->name }}</h3>
                            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">{{ $listing->address }}</p>
                            <p class="mt-4 text-sm text-slate-600 dark:text-slate-300">{{ Str::limit($listing->description, 150) }}</p>
                        </div>
                        <div class="mt-6 flex items-center justify-end gap-4">
                            {{-- Remove from Wishlist Form --}}
                            <form action="{{ route('wishlist.toggle', $listing) }}" method="POST">
                                @csrf
                                <button type="submit" class="text-sm font-medium text-red-500 hover:underline">Remove</button>
                            </form>
                            {{-- View Details Link --}}
                            <a href="{{ route('listings.show', $listing) }}" class="rounded-lg bg-primary px-5 py-2.5 text-sm font-semibold text-white shadow-sm">
                                View Details
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-16 bg-white dark:bg-slate-900/60 rounded-lg">
                <p class="text-slate-500">Your wishlist is empty.</p>
                <a href="{{ route('home') }}" class="mt-4 inline-block text-primary font-semibold hover:underline">
                    Find places to add
                </a>
            </div>
        @endforelse
    </div>

    {{-- Pagination Links --}}
    <div class="mt-8">
        {{ $wishlistItems->links() }}
    </div>
</div>
@endsection