<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Your Profile - Wanderlust</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link crossorigin="" href="https://fonts.gstatic.com/" rel="preconnect"/>
    <link as="style" href="https://fonts.googleapis.com/css2?display=swap&family=Plus+Jakarta+Sans:wght@400;500;700;800" onload="this.rel='stylesheet'" rel="stylesheet"/>
    <script>
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            colors: {
              primary: "#1193d4",
              "background-light": "#f6f7f8",
              "background-dark": "#101c22",
            },
            fontFamily: {
              display: ["Plus Jakarta Sans"],
            },
          },
        },
      };
    </script>
</head>
<body class="bg-background-light dark:bg-background-dark font-display text-slate-800 dark:text-slate-200">
<div class="flex min-h-screen">
    <aside class="w-64 bg-white dark:bg-slate-900/40 p-6 flex-col justify-between border-r border-slate-200 dark:border-slate-800 hidden lg:flex">
        <div class="flex flex-col gap-8">
            <div class="flex items-center gap-3">
                <img alt="User Avatar" class="w-10 h-10 rounded-full" src="https://i.pravatar.cc/150?u={{ auth()->user()->id }}"/>
                <span class="font-bold text-slate-900 dark:text-white">{{ Auth::user()->name }}</span>
            </div>
            <nav class="flex flex-col gap-2">
                <a class="flex items-center gap-3 px-3 py-2 rounded text-slate-700 dark:text-slate-300 hover:bg-primary/10 hover:text-primary" href="{{ route('home') }}">
                    <svg fill="currentColor" height="24" viewBox="0 0 256 256" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M218.83,103.77l-80-75.48a1.14,1.14,0,0,1-.11-.11,16,16,0,0,0-21.53,0l-.11.11L37.17,103.77A16,16,0,0,0,32,115.55V208a16,16,0,0,0,16,16H96a16,16,0,0,0,16-16V160h32v48a16,16,0,0,0,16,16h48a16,16,0,0,0,16-16V115.55A16,16,0,0,0,218.83,103.77ZM208,208H160V160a16,16,0,0,0-16-16H112a16,16,0,0,0-16,16v48H48V115.55l.11-.1L128,40l79.9,75.43.11.1Z"></path></svg>
                    <span class="text-sm font-medium">Home</span>
                </a>
                <a class="flex items-center gap-3 px-3 py-2 rounded text-slate-700 dark:text-slate-300 hover:bg-primary/10 hover:text-primary" href="{{ route('forums.index') }}">
                     <svg fill="currentColor" height="24" viewBox="0 0 256 256" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M144,128a16,16,0,1,1-16-16A16,16,0,0,1,144,128Z"></path><path d="M128,40a88,88,0,1,0,88,88A88.1,88.1,0,0,0,128,40Zm0,160a72,72,0,1,1,72-72A72.08,72.08,0,0,1,128,200Z"></path><path d="M222,58a8,8,0,0,0-9.66-2.34L184,67.75V64a8,8,0,0,0-16,0v8.59l-18.34-12.23a8,8,0,1,0-9.32,13.92L160,86.59V96a8,8,0,0,0,16,0V87.41l28.34,18.9a8,8,0,0,0,9.32-14l-19.66-13.1Z"></path></svg>
                    <span class="text-sm font-medium">Forums</span>
                </a>
                <a class="flex items-center gap-3 px-3 py-2 rounded text-slate-700 dark:text-slate-300 hover:bg-primary/10 hover:text-primary" href="{{ route('trips.index') }}">
                    <svg fill="currentColor" height="24" viewBox="0 0 256 256" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M216,56H176V48a24,24,0,0,0-24-24H104A24,24,0,0,0,80,48v8H40A16,16,0,0,0,24,72V200a16,16,0,0,0,16,16H216a16,16,0,0,0,16-16V72A16,16,0,0,0,216,56ZM96,72h64V200H96Zm0-24a8,8,0,0,1,8-8h48a8,8,0,0,1,8,8v8H96Z"></path></svg>
                    <span class="text-sm font-medium">Trips</span>
                </a>
            </nav>
        </div>
        <div class="flex flex-col gap-2">
            <a class="flex items-center gap-3 px-3 py-2 rounded bg-primary/10 dark:bg-primary/20 text-primary font-bold" href="{{ route('profile.show') }}">
                <svg fill="currentColor" height="24" viewBox="0 0 256 256" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24ZM74.08,197.5a64,64,0,0,1,107.84,0,87.83,87.83,0,0,1-107.84,0ZM96,120a32,32,0,1,1,32,32A32,32,0,0,1,96,120Zm97.76,66.41a79.66,79.66,0,0,0-36.06-28.75,48,48,0,1,0-59.4,0,79.66,79.66,0,0,0-36.06,28.75,88,88,0,1,1,131.52,0Z"></path></svg>
                <span class="text-sm">Profile</span>
            </a>
        </div>
    </aside>
    <main class="flex-1 p-8">
        <div class="max-w-4xl mx-auto">
            <header class="mb-8">
                <h1 class="text-3xl font-bold text-slate-900 dark:text-white">Your Profile</h1>
                <p class="text-slate-500 dark:text-slate-400 mt-1">Manage your account settings and view your travel history.</p>
            </header>
            <div class="mb-8">
                <div class="border-b border-slate-200 dark:border-slate-800">
                    <nav aria-label="Tabs" class="flex gap-8">
                        <a class="py-4 px-1 border-b-2 border-primary text-primary font-semibold text-sm" href="#"> Reviews </a>
                        <a class="py-4 px-1 border-b-2 border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300 dark:text-slate-400" href="#"> Saved </a>
                        <a class="py-4 px-1 border-b-2 border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300 dark:text-slate-400" href="#"> Account </a>
                    </nav>
                </div>
            </div>
            <h2 class="text-2xl font-bold text-slate-900 dark:text-white mb-6">Your Reviews ({{ $user->reviews->count() }})</h2>
            <div class="space-y-8">
                @forelse ($user->reviews as $review)
                    <div class="bg-white dark:bg-slate-900/40 p-6 rounded-lg shadow-sm">
                        <div class="flex items-start gap-4">
                            <img alt="{{ $user->name }} avatar" class="w-12 h-12 rounded-full" src="https://i.pravatar.cc/150?u={{ $user->id }}"/>
                            <div class="flex-1">
                                <div class="flex justify-between items-center">
                                    <div>
                                        {{-- Link to the reviewed listing --}}
                                        <a href="{{ route('listings.show', $review->reviewable) }}" class="font-semibold text-slate-900 dark:text-white hover:text-primary">
                                            Review for: {{ $review->reviewable->name }}
                                        </a>
                                        <p class="text-sm text-slate-500 dark:text-slate-400">{{ $review->created_at->diffForHumans() }}</p>
                                    </div>
                                    <div class="flex items-center text-yellow-500">
                                        @for ($i = 0; $i < $review->rating; $i++)
                                            <svg fill="currentColor" height="20" viewBox="0 0 256 256" width="20" xmlns="http://www.w3.org/2000/svg"><path d="M234.5,114.38l-45.1,39.36,13.51,58.6a16,16,0,0,1-23.84,17.34l-51.11-31-51,31a16,16,0,0,1-23.84-17.34L66.61,153.8,21.5,114.38a16,16,0,0,1,9.11-28.06l59.46-5.15,23.21-55.36a15.95,15.95,0,0,1,29.44,0h0L166,81.17l59.44,5.15a16,16,0,0,1,9.11,28.06Z"></path></svg>
                                        @endfor
                                    </div>
                                </div>
                                <p class="mt-4 text-slate-600 dark:text-slate-300">{{ $review->body }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-white dark:bg-slate-900/40 p-6 rounded-lg shadow-sm text-center">
                        <p class="text-slate-500">You haven't written any reviews yet.</p>
                        <a href="{{ route('home') }}" class="mt-2 inline-block text-primary font-semibold">Find a place to review</a>
                    </div>
                @endforelse
            </div>
        </div>
    </main>
</div>
</body>
</html>