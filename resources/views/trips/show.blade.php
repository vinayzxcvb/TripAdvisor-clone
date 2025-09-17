@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-900">{{ $trip->name }}</h1>
        <a href="{{ route('trips.index') }}" class="text-primary font-medium hover:underline">
            &larr; Back to all trips
        </a>
    </div>

    <div class="bg-white rounded-lg shadow">
        <div class="space-y-4 p-6">
            @forelse ($trip->items as $item)
                <div class="p-4 border-b last:border-b-0 flex justify-between items-center hover:bg-gray-50 rounded-md">
                    <div>
                        <a href="{{ route('listings.show', $item->listing) }}" class="text-xl font-semibold text-gray-800 hover:text-primary">
                            {{ $item->listing->name }}
                        </a>
                        <p class="text-sm text-gray-500 mt-1">{{ $item->listing->address }}</p>
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
                <div class="p-6 text-center text-gray-500">
                    <p>You haven't added any items to this trip yet.</p>
                    <a href="{{ route('home') }}" class="mt-4 inline-block bg-primary text-white px-4 py-2 rounded-md font-medium hover:bg-opacity-90">
                        Find Things to Add
                    </a>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection