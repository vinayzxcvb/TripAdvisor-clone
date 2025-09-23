@extends('layouts.app')

@section('content')
<main class="container mx-auto px-4 sm:px-6 lg:px-8 py-8 flex-grow">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <aside class="lg:col-span-3 space-y-6">
            <div class="bg-white dark:bg-slate-900/60 p-4 rounded-lg shadow-sm">
                <h2 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Top Questions</h2>
                {{-- This can be made dynamic later if needed --}}
                <ul class="space-y-4">
                    <li>
                        <a class="block hover:bg-primary/10 dark:hover:bg-primary/20 p-2 rounded-lg transition-colors" href="#">
                            <p class="font-medium text-gray-800 dark:text-gray-200">Best time to visit the Grand Canyon</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">12 replies · 2 days ago</p>
                        </a>
                    </li>
                </ul>
            </div>
        </aside>
        <div class="lg:col-span-9">
            <div class="bg-white dark:bg-slate-900/60 p-6 rounded-lg shadow-sm mb-6">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Community Forum</h1>
                        <p class="text-gray-600 dark:text-gray-300 mt-1">Connect with fellow travelers and share your experiences.</p>
                    </div>
                    @auth
                    <a href="{{ route('forums.threads.create') }}" class="flex items-center justify-center gap-2 bg-primary text-white font-bold py-2 px-4 rounded-lg shadow-md hover:bg-opacity-90 transition-all w-full sm:w-auto">
                        <span class="material-symbols-outlined">+</span>
                        <span>Create a Post</span>
                    </a>
                    @endauth
                </div>
            </div>
            <div class="space-y-4">
                @forelse ($threads as $thread)
                    <div class="bg-white dark:bg-slate-900/60 p-5 rounded-lg shadow-sm flex gap-4">
                        <img alt="{{ $thread->user->name }}'s avatar" class="size-12 rounded-full hidden sm:block" src="https://i.pravatar.cc/150?u={{$thread->user->id}}"/>
                        <div class="flex-1">
                            <a class="font-bold text-lg text-gray-900 dark:text-white hover:text-primary dark:hover:text-primary transition-colors" href="{{ route('forums.show', $thread) }}">
                                {{ $thread->title }}
                            </a>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">Posted by <span class="font-medium">{{ $thread->user->name }}</span> · {{ $thread->created_at->diffForHumans() }} · {{ $thread->posts_count }} replies</p>
                        </div>
                    </div>
                @empty
                    <div class="bg-white dark:bg-slate-900/60 p-5 rounded-lg shadow-sm text-center">
                        <p class="text-gray-500">No discussions yet. Be the first to start one!</p>
                    </div>
                @endforelse
            </div>
             <div class="mt-8">
                {{ $threads->links() }}
            </div>
        </div>
    </div>
</main>
@endsection