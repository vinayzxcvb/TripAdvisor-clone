@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    
    <div class="bg-white p-8 rounded-lg shadow-md mb-8">
        <h1 class="text-3xl font-extrabold text-gray-900">{{ $thread->title }}</h1>
        <p class="text-sm text-gray-500 mt-2 border-b pb-4">
            Posted by <span class="font-medium">{{ $thread->user->name }}</span> - {{ $thread->created_at->diffForHumans() }}
        </p>
        <div class="mt-4 text-gray-700 text-base leading-relaxed">
            {!! nl2br(e($thread->body)) !!}
        </div>
    </div>

    <h2 class="text-2xl font-bold text-gray-800 mb-6">Replies</h2>
    <div class="space-y-6">
        @forelse ($thread->posts as $post)
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex items-center mb-3">
                    <p class="text-sm font-semibold text-gray-800">{{ $post->user->name }}</p>
                    <p class="text-xs text-gray-500 ml-4">{{ $post->created_at->diffForHumans() }}</p>
                </div>
                <p class="text-gray-600">
                    {!! nl2br(e($post->body)) !!}
                </p>
            </div>
        @empty
            <div class="bg-white p-6 rounded-lg shadow-md text-center text-gray-500">
                <p>No replies yet. Be the first to share your thoughts!</p>
            </div>
        @endforelse
    </div>
    
    <div class="mt-12">
        @auth
            <form action="{{ route('forums.posts.store', $thread) }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
                @csrf
                <h3 class="text-xl font-semibold mb-4 text-gray-800">Leave a Reply</h3>
                <textarea name="body" rows="5" class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary sm:text-sm" placeholder="Share your thoughts..." required></textarea>
                <div class="mt-4">
                    <button type="submit" class="bg-primary text-white px-6 py-2 rounded-md font-medium hover:bg-opacity-90">
                        Post Reply
                    </button>
                </div>
            </form>
        @else
            <p class="text-center bg-gray-200 p-4 rounded-md">
                You must be <a href="{{ route('login') }}" class="text-primary font-semibold">logged in</a> to post a reply.
            </p>
        @endauth
    </div>
</div>
@endsection