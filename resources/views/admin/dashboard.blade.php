@extends('layouts.app')

@section('title', 'Admin Dashboard - ExploreEdge')

@section('content')
<div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-8">Admin Dashboard</h1>

    {{-- Stat Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        {{-- Total Users Card --}}
        <div class="bg-white dark:bg-slate-900/60 p-6 rounded-lg shadow-md flex items-center gap-4">
            <div class="bg-primary/10 p-3 rounded-full">
                <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Users</p>
                <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $userCount }}</p>
            </div>
        </div>
        {{-- Total Listings Card --}}
        <div class="bg-white dark:bg-slate-900/60 p-6 rounded-lg shadow-md flex items-center gap-4">
            <div class="bg-primary/10 p-3 rounded-full">
                <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Listings</p>
                <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $listingCount }}</p>
            </div>
        </div>
        {{-- Total Bookings Card --}}
        <div class="bg-white dark:bg-slate-900/60 p-6 rounded-lg shadow-md flex items-center gap-4">
             <div class="bg-primary/10 p-3 rounded-full">
                <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Bookings</p>
                <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $bookingCount }}</p>
            </div>
        </div>
    </div>

    {{-- Management Links --}}
    <div class="bg-white dark:bg-slate-900/60 p-6 rounded-lg shadow-md mb-8">
        <h2 class="text-xl font-semibold mb-4">Management</h2>
        <div class="flex flex-wrap gap-4">
            <a href="{{ route('admin.listings.create') }}" class="bg-primary text-white font-bold py-2 px-4 rounded-lg hover:bg-opacity-90">
                + Add New Listing
            </a>
            <a href="{{ route('admin.listings.index') }}" class="bg-slate-200 dark:bg-slate-700 text-slate-800 dark:text-slate-200 font-bold py-2 px-4 rounded-lg hover:bg-opacity-90">
                Manage Listings
            </a>
        </div>
    </div>

    {{-- Recent Bookings Table --}}
    <div class="bg-white dark:bg-slate-900/60 shadow-md rounded-lg overflow-x-auto">
        <h2 class="text-xl font-semibold p-6">Recent Bookings</h2>
        <table class="min-w-full divide-y divide-gray-200 dark:divide-slate-700">
            <thead class="bg-gray-50 dark:bg-slate-800">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Listing</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">User</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Dates</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-slate-700">
                @forelse ($recentBookings as $booking)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">{{ $booking->listing->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">{{ $booking->user->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">{{ \Carbon\Carbon::parse($booking->check_in_date)->format('M d') }} - {{ \Carbon\Carbon::parse($booking->check_out_date)->format('M d, Y') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 capitalize">
                                {{ $booking->status }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">No recent bookings.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection