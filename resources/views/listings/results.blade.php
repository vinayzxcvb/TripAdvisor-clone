@extends('layouts.app')

@section('content')
<main class="mx-auto w-full max-w-6xl flex-1 px-4 py-8 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 gap-8 lg:grid-cols-4">
        <aside class="lg:col-span-1">
            <div class="rounded-lg bg-white p-6 shadow-sm dark:bg-slate-900/60">
                <h3 class="text-lg font-bold text-slate-800 dark:text-white">Filter & Sort</h3>
                {{-- Filter controls can be added here as needed --}}
                <div class="mt-6 space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-slate-600 dark:text-slate-300" for="search-location">Location</label>
                        <div class="relative mt-2">
                            <span class="material-symbols-outlined pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"> search </span>
                            <input class="w-full rounded-lg border-slate-300 bg-background-light py-2.5 pl-10 pr-4 text-slate-800 focus:border-primary focus:ring-primary dark:border-slate-700 dark:bg-slate-800 dark:text-white" id="search-location" type="text" value="{{ $query }}" readonly/>
                        </div>
                    </div>
                </div>
            </div>
        </aside>

        <div class="lg:col-span-3">
            <div class="pt-8">
                <h2 class="text-2xl font-bold text-slate-800 dark:text-white">Results for "{{ $query }}"</h2>
                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Showing {{ $listings->total() }} results</p>
            </div>
            <div class="mt-6 space-y-6">
                @forelse ($listings as $listing)
                    <div class="overflow-hidden rounded-lg bg-white shadow-sm transition-shadow duration-300 hover:shadow-lg dark:bg-slate-900/60">
                        <a href="{{ route('listings.show', $listing) }}" class="block">
                            <div class="flex flex-col sm:flex-row">
                                <div class="sm:w-1/3">
                                    <div class="h-48 w-full bg-cover bg-center sm:h-full" style="background-image: url('{{ $listing->media->isNotEmpty() ? Storage::url($listing->media->first()->path) : 'https://placehold.co/600x400/1193d4/FFFFFF?text=Wanderlust' }}');"></div>
                                </div>
                                <div class="flex flex-1 flex-col justify-between p-6">
                                    <div>
                                        <h3 class="text-lg font-bold text-slate-800 dark:text-white">{{ $listing->name }}</h3>
                                        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">{{ $listing->address }}</p>
                                        <p class="mt-4 text-sm text-slate-600 dark:text-slate-300">{{ Str::limit($listing->description, 150) }}</p>
                                    </div>
                                    <div class="mt-6 flex items-center justify-end">
                                        <span class="rounded-lg bg-primary px-5 py-2.5 text-sm font-semibold text-white shadow-sm">View Details</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="text-center py-10">
                        <p class="text-slate-500">No results found for your search.</p>
                    </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            <nav class="mt-8 flex justify-center">
                {{ $listings->appends(['query' => $query])->links() }}
            </nav>
        </div>
    </div>
</main>
@endsection