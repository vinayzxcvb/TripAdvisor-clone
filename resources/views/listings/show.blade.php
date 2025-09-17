@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    {{-- Listing Header --}}
    <div class="bg-white p-8 rounded-lg shadow-md mb-8">
        <h1 class="text-4xl font-extrabold text-gray-900">{{ $listing->name }}</h1>
        <p class="text-lg text-gray-600 mt-2">{{ $listing->address }}</p>
        <div class="mt-4 text-gray-700">
            {{ $listing->description }}
        </div>
    </div>

    {{-- Add this entire "Add a Photo" section --}}
    @auth
    <div class="bg-white p-6 rounded-lg shadow-md mb-8">
        <h2 class="text-2xl font-semibold mb-4 text-gray-800">Add a Photo</h2>
        <form action="{{ route('media.store', $listing) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="flex items-center space-x-4">
                <div class="flex-grow">
                    <label for="media_file" class="sr-only">Choose a file</label>
                    <input type="file" name="media_file" id="media_file" required 
                           class="block w-full text-sm text-gray-500
                                  file:mr-4 file:py-2 file:px-4
                                  file:rounded-full file:border-0
                                  file:text-sm file:font-semibold
                                  file:bg-primary/10 file:text-primary
                                  hover:file:bg-primary/20">
                </div>
                <button type="submit" class="bg-primary text-white px-6 py-2 rounded-md font-medium hover:bg-opacity-90 whitespace-nowrap">
                    Upload Photo
                </button>
            </div>
            @error('media_file')
                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
            @enderror
        </form>
    </div>
    @endauth

    {{-- Photo Gallery Section (if you have it) --}}
    {{-- ... --}}


    {{-- Reviews Section --}}
    <div class="mt-12">
    {{-- ... --}}