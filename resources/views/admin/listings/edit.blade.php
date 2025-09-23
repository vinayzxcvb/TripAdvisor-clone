@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-8">Edit Listing: {{ $listing->name }}</h1>

    <div class="bg-white dark:bg-slate-900/60 p-8 rounded-lg shadow-md">
        <form action="{{ route('admin.listings.update', $listing) }}" method="POST">
            @csrf
            @method('PUT') {{-- Important for updates --}}
            
            <div class="space-y-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                    <input type="text" name="name" id="name" required value="{{ old('name', $listing->name) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-slate-700 bg-transparent shadow-sm focus:border-primary focus:ring-primary">
                </div>
                 <div>
                    <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Address</label>
                    <input type="text" name="address" id="address" required value="{{ old('address', $listing->address) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-slate-700 bg-transparent shadow-sm focus:border-primary focus:ring-primary">
                </div>
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Type</label>
                    <select name="type" id="type" required class="mt-1 block w-full rounded-md border-gray-300 dark:border-slate-700 bg-transparent shadow-sm focus:border-primary focus:ring-primary">
                        <option value="hotel" @selected(old('type', $listing->type) == 'hotel')>Hotel</option>
                        <option value="restaurant" @selected(old('type', $listing->type) == 'restaurant')>Restaurant</option>
                        <option value="attraction" @selected(old('type', $listing->type) == 'attraction')>Attraction</option>
                    </select>
                </div>
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                    <textarea name="description" id="description" rows="5" required class="mt-1 block w-full rounded-md border-gray-300 dark:border-slate-700 bg-transparent shadow-sm focus:border-primary focus:ring-primary">{{ old('description', $listing->description) }}</textarea>
                </div>
            </div>

            <div class="mt-8 flex items-center space-x-4">
                <button type="submit" class="bg-primary text-white px-6 py-2 rounded-md font-medium hover:bg-opacity-90">
                    Update Listing
                </button>
                <a href="{{ route('admin.listings.index') }}" class="text-gray-600 hover:underline">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection