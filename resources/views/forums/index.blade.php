@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Community Forums</h1>
        
        {{-- Show "Create Thread" button only to logged-in users --}}
        @auth
            <a href="{{-- route('forums.threads.create') --}}" class="bg-primary text-white px-4 py-2 rounded-md font-medium hover:bg-opacity-90">
                Start a New Discussion
            </a>
        @endauth
    </div>
    
    <div class="bg-white rounded-lg shadow">
        <div class="space-y-4 p-6">
            {{-- Loop through each thread passed from the controller --}}
            @forelse ($threads as $thread)
                <div class="p-4 border-b last:border-b-0 hover:bg-gray-50 rounded-md">
                    <div class="flex justify-between items-center">
                        <div>
                            <h2 class="text-xl font-semibold text-gray-800">
                                <a href="{{ route('forums.show', $thread) }}" class="hover:text-primary">
                                    {{ $thread->title }}
                                </a>
                            </h2>
                            <p class="text-sm text-gray-500 mt-1">
                                Started by <span class="font-medium">{{ $thread->user->name }}</span> - {{ $thread->created_at->diffForHumans() }}
                            </p>
                        </div>
                        <div class="text-right">
                            <span class="font-bold text-lg text-gray-700">{{ $thread->posts_count }}</span>
                            <p class="text-sm text-gray-500">Replies</p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="p-6 text-center text-gray-500">
                    <p>No discussions have been started yet.</p>
                    @auth
                        <p class="mt-2">Why not be the first?</p>
                    @endauth
                </div>
            @endforelse
        </div>
    </div>
    
    {{-- Pagination Links --}}
    <div class="mt-8">
        {{ $threads->links() }}
    </div>
</div>
@endsection