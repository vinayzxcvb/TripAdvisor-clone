@extends('layouts.app')

@section('content')
<main class="flex-1 p-6">
    <div class="bg-white dark:bg-slate-900/60 p-6 rounded-lg shadow-sm">
        <h1 class="text-2xl font-bold tracking-tight">My Trips</h1>
        <p class="text-sm text-subtle-light dark:text-subtle-dark mt-1">Create a new trip or view your existing ones.</p>
        
        <form action="{{ route('trips.store') }}" method="POST" class="mt-4 flex flex-col md:flex-row items-center gap-4">
            @csrf
            <input name="name" class="form-input w-full rounded-lg border-border-light dark:border-border-dark bg-background-light dark:bg-background-dark py-3 px-4 text-sm focus:ring-primary focus:border-primary placeholder:text-subtle-light placeholder:dark:text-subtle-dark" placeholder="Name your new trip" type="text" required/>
            <button class="w-full md:w-auto flex items-center justify-center gap-2 rounded-lg bg-primary text-white text-sm font-bold py-3 px-4 hover:bg-opacity-90 transition-all">
                <span class="material-symbols-outlined">add</span>
                <span>Create New Trip</span>
            </button>
        </form>
    </div>
    
    <div class="mt-6">
        @if ($trips->isNotEmpty())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($trips as $trip)
                    <a href="{{ route('trips.show', $trip) }}" class="block p-4 rounded-lg bg-white dark:bg-slate-900/60 border border-border-light dark:border-border-dark hover:shadow-lg hover:border-primary/50 transition-all">
                        <h3 class="font-bold">{{ $trip->name }}</h3>
                        <p class="text-sm text-subtle-light dark:text-subtle-dark mt-1">Created: {{ $trip->created_at->format('M d, Y') }}</p>
                    </a>
                @endforeach
            </div>
        @else
            <div class="text-center py-10 bg-white dark:bg-slate-900/60 rounded-lg">
                <p class="text-subtle-light dark:text-subtle-dark">You haven't created any trips yet. Use the form above to start planning!</p>
            </div>
        @endif
    </div>
</main>
@endsection