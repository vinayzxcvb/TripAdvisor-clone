@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-5xl">
        <div class="mb-6 flex flex-wrap items-start justify-between gap-4">
            <div>
                <h1 class="text-4xl font-extrabold text-slate-900 dark:text-white">{{ $listing->name }}</h1>
                <p class="text-md text-slate-500 dark:text-slate-400">{{ $listing->address }}</p>
            </div>
            {{-- Add to Trip Functionality --}}
            @auth
            <div class="flex items-center gap-4">
                 {{-- This form requires a dropdown of the user's trips --}}
                 <form action="#" method="POST"> {{-- Update route when trip selection is added --}}
                    @csrf
                    <input type="hidden" name="listing_id" value="{{ $listing->id }}">
                    <button type="submit" class="flex items-center gap-2 rounded-lg bg-primary/10 px-4 py-2 text-sm font-bold text-primary hover:bg-primary/20 dark:bg-primary/20 dark:hover:bg-primary/30">
                        <span class="material-symbols-outlined"> favorite_border </span>
                        Save to Trip
                    </button>
                 </form>
            </div>
            @endauth
        </div>

        {{-- Image Gallery --}}
        <div class="mb-12 grid grid-cols-4 grid-rows-2 gap-2 overflow-hidden rounded-xl">
            @if($listing->media->isNotEmpty())
                <div class="col-span-2 row-span-2 h-full min-h-[200px] w-full bg-cover bg-center" style="background-image: url('{{ Storage::url($listing->media->first()->path) }}');"></div>
                @foreach($listing->media->slice(1, 4) as $media_item)
                    <div class="h-full min-h-[100px] w-full bg-cover bg-center" style="background-image: url('{{ Storage::url($media_item->path) }}');"></div>
                @endforeach
            @else
                 <div class="col-span-4 row-span-2 h-full min-h-[400px] w-full bg-cover bg-center" style="background-image: url('https://placehold.co/800x400/1193d4/FFFFFF?text=No+Images+Available');"></div>
            @endif
        </div>

        <div class="grid grid-cols-1 gap-12 md:grid-cols-3">
            <div class="md:col-span-2">
                <div class="mb-8">
                    <h2 class="mb-4 text-2xl font-bold text-slate-900 dark:text-white">About</h2>
                    <p class="text-slate-600 dark:text-slate-300">{{ $listing->description }}</p>
                </div>

                 {{-- Reviews Section --}}
                <div>
                    <h2 class="mb-4 text-2xl font-bold text-slate-900 dark:text-white">Reviews ({{ $listing->reviews->count() }})</h2>
                    <div class="space-y-8">
                       @forelse($listing->reviews as $review)
                        <div class="border-b border-slate-200 pb-6 dark:border-slate-800">
                            <div class="mb-3 flex items-center gap-3">
                                <img alt="{{$review->user->name}} avatar" class="h-10 w-10 rounded-full object-cover" src="https://i.pravatar.cc/150?u={{$review->user->id}}"/>
                                <div>
                                    <p class="font-semibold text-slate-900 dark:text-white">{{$review->user->name}}</p>
                                    <p class="text-sm text-slate-500 dark:text-slate-400">{{ $review->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            <div class="mb-3 flex text-yellow-400">
                                @for ($i = 0; $i < $review->rating; $i++)
                                <span class="material-symbols-outlined text-base">star</span>
                                @endfor
                            </div>
                            <p class="mb-3 text-slate-600 dark:text-slate-300">{{ $review->body }}</p>
                        </div>
                        @empty
                        <p class="text-slate-500">No reviews yet. Be the first to leave one!</p>
                       @endforelse
                    </div>
                </div>
            </div>
            
            {{-- Right Column for Forms --}}
            <div class="md:col-span-1">
                <div class="sticky top-28 space-y-6">
                    {{-- Add a review --}}
                     @auth
                        <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-lg dark:border-slate-800 dark:bg-slate-900/60">
                           <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-4">Write a review</h3>
                           <form action="{{ route('reviews.store', $listing) }}" method="POST">
                               @csrf
                               <div class="mb-4">
                                   <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Rating</label>
                                   <select name="rating" required class="mt-1 block w-full rounded-md border-gray-300 dark:border-slate-700 bg-transparent shadow-sm focus:border-primary focus:ring-primary sm:text-sm">
                                       <option value="5">5 Stars - Excellent</option>
                                       <option value="4">4 Stars - Very Good</option>
                                       <option value="3">3 Stars - Average</option>
                                       <option value="2">2 Stars - Poor</option>
                                       <option value="1">1 Star - Terrible</option>
                                   </select>
                               </div>
                               <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Review</label>
                                    <textarea name="body" rows="4" required placeholder="Share your experience..." class="mt-1 block w-full rounded-md border-gray-300 dark:border-slate-700 bg-transparent shadow-sm focus:border-primary focus:ring-primary sm:text-sm">{{ old('body') }}</textarea>
                               </div>
                               <button type="submit" class="w-full rounded-lg bg-primary py-3 text-center font-bold text-white transition hover:bg-primary/90">Submit Review</button>
                           </form>
                        </div>
                    @else
                        <p class="text-center p-4 bg-slate-100 dark:bg-slate-800 rounded-lg">
                           <a href="{{ route('login') }}" class="font-bold text-primary">Log in</a> to leave a review.
                        </p>
                    @endauth

                    {{-- Add a photo --}}
                    @auth
                        <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-lg dark:border-slate-800 dark:bg-slate-900/60">
                           <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-4">Add a photo</h3>
                            <form action="{{ route('media.store', $listing) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="file" name="media_file" required class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20"/>
                                @error('media_file')<p class="text-red-500 text-xs mt-2">{{ $message }}</p>@enderror
                                <button type="submit" class="mt-4 w-full rounded-lg bg-primary py-3 text-center font-bold text-white transition hover:bg-primary/90">Upload Photo</button>
                            </form>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
@endsection