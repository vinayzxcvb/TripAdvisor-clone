@extends('layouts.app')

@section('title', 'My Bookings - ExploreEdge')

@section('content')
<div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-8">My Bookings</h1>

    <div class="space-y-6">
        @forelse ($bookings as $booking)
            <div class="block overflow-hidden rounded-lg bg-white shadow-sm dark:bg-slate-900/60">
                <div class="flex flex-col sm:flex-row">
                    {{-- Left side: Hotel Info --}}
                    <div class="sm:w-2/3 p-6 border-b sm:border-b-0 sm:border-r border-gray-200 dark:border-slate-700">
                        <p class="text-sm text-primary font-bold uppercase">{{ $booking->status }}</p>
                        <h3 class="text-xl font-bold text-slate-800 dark:text-white mt-1">
                            <a href="{{ route('listings.show', $booking->listing) }}" class="hover:underline">{{ $booking->listing->name }}</a>
                        </h3>
                        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">{{ $booking->listing->address }}</p>
                    </div>
                    {{-- Right side: Booking Details --}}
                    <div class="sm:w-1/3 p-6">
                        <div class="grid grid-cols-2 gap-4 text-sm">
                            <div>
                                <p class="font-semibold text-slate-600 dark:text-slate-300">Check-in</p>
                                <p class="text-slate-800 dark:text-white">{{ \Carbon\Carbon::parse($booking->check_in_date)->format('M d, Y') }}</p>
                            </div>
                             <div>
                                <p class="font-semibold text-slate-600 dark:text-slate-300">Check-out</p>
                                <p class="text-slate-800 dark:text-white">{{ \Carbon\Carbon::parse($booking->check_out_date)->format('M d, Y') }}</p>
                            </div>
                             <div>
                                <p class="font-semibold text-slate-600 dark:text-slate-300">Guests</p>
                                <p class="text-slate-800 dark:text-white">{{ $booking->number_of_guests }}</p>
                            </div>
                             <div>
                                <p class="font-semibold text-slate-600 dark:text-slate-300">Total Price</p>
                                <p class="text-slate-800 dark:text-white">${{ number_format($booking->total_price, 2) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-16 bg-white dark:bg-slate-900/60 rounded-lg">
                <p class="text-slate-500">You have no bookings yet.</p>
                <a href="{{ route('home') }}" class="mt-4 inline-block text-primary font-semibold hover:underline">
                    Find a place to stay
                </a>
            </div>
        @endforelse
    </div>

    {{-- Pagination Links --}}
    <div class="mt-8">
        {{ $bookings->links() }}
    </div>
</div>
@endsection