<nav class="bg-white shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="flex-shrink-0 text-2xl font-bold text-primary">
                    TripAdvisor
                </a>
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                        <!-- <a href="{{ route('home') }}" class="text-gray-700 hover:text-primary px-3 py-2 rounded-md text-sm font-medium">Home</a> -->
                        <a href="{{ route('forums.index') }}" class="text-gray-700 hover:text-primary px-3 py-2 rounded-md text-sm font-medium">Forums</a>
                        @auth
                        <a href="{{ route('trips.index') }}" class="text-gray-700 hover:text-primary px-3 py-2 rounded-md text-sm font-medium">Trips</a>
                        @endauth
                    </div>
                </div>
            </div>
            <div class="hidden md:block">
                <div class="ml-4 flex items-center md:ml-6">
                    @guest
                    <a href="{{route('login')}}" class="text-gray-700 hover:text-primary px-3 py-2 rounded-md text-sm font-medium">Login</a>
                    <a href="{{route('register')}}" class="ml-4 bg-primary text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-opacity-90">Register</a>
                    @else
                    <span class="text-gray-700 text-sm mr-4">Welcome, {{ Auth::user()->name }}</span>
                    <a href="{{route('logout')}}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md text-sm font-medium hover:bg-gray-300">
                        Logout
                    </a>
                    <form id="logout-form" action="{{route('logout')}}" method="POST" class="hidden">
                        @csrf
                    </form>
                    @endguest
                </div>
            </div>
        </div>
    </div>
</nav>