@extends('layouts.app')

@section('title', $listing->name . ' - ExploreEdge')

@section('content')
<main class="flex-1">
    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-5xl">

            <div class="flex justify-between items-center mb-4">
                <div>
                    @if (isset($previousListing) && $previousListing)
                        <a href="{{ route('listings.show', $previousListing) }}" class="flex items-center gap-2 rounded-lg bg-slate-200 dark:bg-slate-700 px-4 py-2 text-sm font-bold text-slate-700 dark:text-slate-200 hover:bg-slate-300">
                            {{-- ICON FIXED --}}
                            <span class="material-symbols-outlined">⬅️</span>
                            Previous
                        </a>
                    @endif
                </div>
                <div>
                    @if (isset($nextListing) && $nextListing)
                        <a href="{{ route('listings.show', $nextListing) }}" class="flex items-center gap-2 rounded-lg bg-slate-200 dark:bg-slate-700 px-4 py-2 text-sm font-bold text-slate-700 dark:text-slate-200 hover:bg-slate-300">
                            Next
                            {{-- ICON FIXED --}}
                            <span class="material-symbols-outlined">➡️</span>
                        </a>
                    @endif
                </div>
            </div>

            <div class="mb-6 flex flex-wrap items-start justify-between gap-4">
                <div>
                    <h1 class="text-4xl font-extrabold text-slate-900 dark:text-white">{{ $listing->name }}</h1>
                    <div class="flex items-center gap-2 mt-2">
                        <div class="flex items-center text-yellow-400">
                            <!-- @for ($i = 0; $i < 5; $i++)
                                <span class="material-symbols-outlined text-base">{{ $i < round($listing->reviews->avg('rating')) ? 'star' : 'star_border' }}</span>
                            @endfor -->
                        </div>
                        <span class="text-sm text-slate-500 dark:text-slate-400">({{ $listing->reviews->count() }} reviews)</span>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    @auth
                    <form action="{{ route('wishlist.toggle', $listing) }}" method="POST">
                        @csrf
                        @if(auth()->user()->hasInWishlist($listing))
                            <button type="submit" class="flex items-center gap-2 rounded-lg bg-red-100 dark:bg-red-900/50 px-4 py-2 text-sm font-bold text-red-600 dark:text-red-300 transition hover:bg-red-200">
                                {{-- ICON FIXED --}}
                                <span class="material-symbols-outlined">-</span>
                                In Wishlist
                            </button>
                        @else
                            <button type="submit" class="flex items-center gap-2 rounded-lg bg-primary/10 px-4 py-2 text-sm font-bold text-primary hover:bg-primary/20 dark:bg-primary/20 dark:hover:bg-primary/30">
                                {{-- ICON FIXED --}}
                                <span class="material-symbols-outlined">+</span>
                                Add to Wishlist
                            </button>
                        @endif
                    </form>
                    @if($listing->type === 'hotel')
                        <a href="#booking-form" class="w-full rounded-lg bg-primary py-2 px-4 text-center font-bold text-white transition hover:bg-primary/90">Book Now</a>
                    @endif
                    @endauth
                </div>
            </div>

            <div class="mb-12 grid grid-cols-4 grid-rows-2 gap-2 overflow-hidden rounded-xl">
                 <div class="col-span-4 row-span-2 h-full min-h-[400px] w-full bg-cover bg-center" style="background-image: url('https://placehold.co/800x400/1193d4/FFFFFF?text={{ urlencode($listing->name) }}');"></div>
            </div>
            
            <div class="grid grid-cols-1 gap-12 md:grid-cols-3">
                <div class="md:col-span-2">
                    <div class="mb-8">
                        <h2 class="mb-4 text-2xl font-bold text-slate-900 dark:text-white">About</h2>
                        <p class="text-slate-600 dark:text-slate-300">{{ $listing->description }}</p>
                    </div>
                    
                    <div>
                        <h2 class="mb-4 text-2xl font-bold text-slate-900 dark:text-white">Reviews</h2>
                        
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
                                <!-- <div class="mb-3 flex text-yellow-400">
                                    @for ($i = 0; $i < $review->rating; $i++)
                                        <span class="material-symbols-outlined text-base">star</span>
                                    @endfor
                                </div> -->
                                <p class="mb-3 text-slate-600 dark:text-slate-300">{{ $review->body }}</p>
                            </div>
                            @empty
                            <p class="text-slate-500">No reviews yet. Be the first to leave one!</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                <div class="md:col-span-1">
                    <div class="sticky top-28 space-y-6">
                        @if($listing->type === 'hotel')
                        <div id="booking-form" class="rounded-xl border border-slate-200 bg-white p-6 shadow-lg dark:border-slate-800 dark:bg-slate-900/60">
                            <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-4">Book Your Stay</h3>
                            <form action="{{ route('bookings.store', $listing) }}" method="POST">
                                @csrf
                                <div class="mb-4 space-y-2">
                                    <div class="grid grid-cols-2 gap-2">
                                        <div>
                                            <label class="text-xs font-bold text-slate-500 dark:text-slate-400">Check-in</label>
                                            <input name="check_in_date" class="w-full rounded border-slate-300 bg-transparent text-sm dark:border-slate-700" type="date" required/>
                                        </div>
                                        <div>
                                            <label class="text-xs font-bold text-slate-500 dark:text-slate-400">Check-out</label>
                                            <input name="check_out_date" class="w-full rounded border-slate-300 bg-transparent text-sm dark:border-slate-700" type="date" required/>
                                        </div>
                                    </div>
                                    <div>
                                        <label class="text-xs font-bold text-slate-500 dark:text-slate-400">Guests</label>
                                        <select name="number_of_guests" class="w-full rounded border-slate-300 bg-transparent text-sm dark:border-slate-700">
                                            <option value="1">1 guest</option>
                                            <option value="2" selected>2 guests</option>
                                        </select>
                                    </div>
                                </div>
                                <button type="submit" class="w-full rounded-lg bg-primary py-3 text-center font-bold text-white transition hover:bg-primary/90">Confirm Booking</button>
                            </form>
                        </div>
                        @endif

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
                                    @error('body')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                               </div>
                               <button type="submit" class="w-full rounded-lg bg-primary py-3 text-center font-bold text-white transition hover:bg-primary/90">Submit Review</button>
                           </form>
                        </div>
                        @else
                        <p class="text-center p-4 bg-slate-100 dark:bg-slate-800 rounded-lg">
                           <a href="{{ route('login') }}" class="font-bold text-primary">Log in</a> to book or leave a review.
                        </p>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection