@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-8">Start a New Discussion</h1>

    <div class="bg-white dark:bg-slate-900/60 p-8 rounded-lg shadow-md">
        <form action="{{ route('forums.threads.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title</label>
                <input type="text" name="title" id="title" required value="{{ old('title') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-slate-700 bg-transparent shadow-sm focus:border-primary focus:ring-primary sm:text-sm">
                @error('title')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="mb-6">
                <label for="body" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Content</label>
                <textarea name="body" id="body" rows="8" required
                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-slate-700 bg-transparent shadow-sm focus:border-primary focus:ring-primary sm:text-sm">{{ old('body') }}</textarea>
                @error('body')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="flex items-center space-x-4">
                <button type="submit" class="bg-primary text-white px-6 py-2 rounded-md font-medium hover:bg-opacity-90">
                    Publish Thread
                </button>
                <a href="{{ route('forums.index') }}" class="text-gray-600 hover:underline">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection