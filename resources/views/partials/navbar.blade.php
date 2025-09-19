<header class="sticky top-0 z-50 w-full bg-background-light/80 dark:bg-background-dark/80 backdrop-blur-sm border-b border-slate-200 dark:border-slate-800">
    <div class="container mx-auto flex items-center justify-between px-4 py-3">
        <div class="flex items-center gap-8">
            <a class="flex items-center gap-2 text-xl font-bold text-slate-900 dark:text-white" href="{{ route('home') }}">
                <svg class="w-8 h-8 text-primary" fill="none" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                    <path d="M44 11.2727C44 14.0109 39.8386 16.3957 33.69 17.6364C39.8386 18.877 44 21.2618 44 24C44 26.7382 39.8386 29.123 33.69 30.3636C39.8386 31.6043 44 33.9891 44 36.7273C44 40.7439 35.0457 44 24 44C12.9543 44 4 40.7439 4 36.7273C4 33.9891 8.16144 31.6043 14.31 30.3636C8.16144 29.123 4 26.7382 4 24C4 21.2618 8.16144 18.877 14.31 17.6364C8.16144 16.3957 4 14.0109 4 11.2727C4 7.25611 12.9543 4 24 4C35.0457 4 44 7.25611 44 11.2727Z" fill="currentColor"></path>
                </svg>
                Wanderlust
            </a>
            <nav class="hidden md:flex items-center gap-6">
                <a class="text-sm font-medium text-slate-600 dark:text-slate-300 hover:text-primary" href="{{ route('home') }}">Explore</a>
                <a class="text-sm font-medium text-slate-600 dark:text-slate-300 hover:text-primary" href="{{ route('forums.index') }}">Forums</a>
                @auth
                <a class="text-sm font-medium text-slate-600 dark:text-slate-300 hover:text-primary" href="{{ route('trips.index') }}">Trips</a>
                @endauth
            </nav>
        </div>
        <div class="flex items-center gap-4">
            @guest
                <a href="{{ route('login') }}" class="flex items-center justify-center rounded-lg bg-primary/20 dark:bg-primary/30 px-4 h-10 text-sm font-bold text-primary hover:bg-primary/30 dark:hover:bg-primary/40 transition-colors">Sign In</a>
                <a href="{{ route('register') }}" class="hidden sm:flex items-center justify-center rounded-lg bg-primary px-4 h-10 text-sm font-bold text-white hover:bg-primary/90 transition-colors">Sign up</a>
            @else
                <button class="relative rounded-full p-2 text-slate-600 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-800">
                    <span class="material-symbols-outlined"> notifications </span>
                    <span class="absolute right-1 top-1 h-2 w-2 rounded-full bg-primary"></span>
                </button>
                <div class="relative" x-data="{ open: false }" @click.away="open = false">
                    <button @click="open = !open">
                        <div class="size-10 rounded-full bg-cover bg-center" style="background-image: url('https://i.pravatar.cc/150?u={{ auth()->user()->id }}');"></div>
                    </button>
                    {{-- Dropdown Menu --}}
                    <div x-show="open" style="display: none;" class="absolute right-0 mt-2 w-48 bg-white dark:bg-slate-800 rounded-md shadow-lg py-1 z-50">
                        <div class="px-4 py-2 text-sm text-gray-700 dark:text-gray-200 border-b dark:border-slate-700">
                            Signed in as <br>
                            <strong class="font-bold">{{ Auth::user()->name }}</strong>
                        </div>

                        {{-- THIS IS THE CORRECTED LINE --}}
                        <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-slate-700">Your Profile</a>
                        
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                           class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-slate-700">
                           Sign out
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                            @csrf
                        </form>
                    </div>
                </div>
                 <script src="//unpkg.com/alpinejs" defer></script>
            @endguest
        </div>
    </div>
</header>