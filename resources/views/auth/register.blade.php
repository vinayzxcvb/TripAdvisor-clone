<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>ExploreEdge - Create Account</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;700;800&display=swap" rel="stylesheet"/>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#1193d4",
                        "background-light": "#f6f7f8",
                        "background-dark": "#101c22",
                    },
                    fontFamily: {
                        "display": ["Plus Jakarta Sans"]
                    },
                },
            },
        }
    </script>
</head>
<body class="bg-background-light dark:bg-background-dark font-display text-gray-800 dark:text-gray-200">
<div class="flex flex-col min-h-screen">
    <main class="flex-grow flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-md space-y-8">
            <div>
                <div class="flex items-center justify-center gap-2">
                    <svg class="h-8 w-8 text-primary" fill="none" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                        <path d="M44 11.2727C44 14.0109 39.8386 16.3957 33.69 17.6364C39.8386 18.877 44 21.2618 44 24C44 26.7382 39.8386 29.123 33.69 30.3636C39.8386 31.6043 44 33.9891 44 36.7273C44 40.7439 35.0457 44 24 44C12.9543 44 4 40.7439 4 36.7273C4 33.9891 8.16144 31.6043 14.31 30.3636C8.16144 29.123 4 26.7382 4 24C4 21.2618 8.16144 18.877 14.31 17.6364C8.16144 16.3957 4 14.0109 4 11.2727C4 7.25611 12.9543 4 24 4C35.0457 4 44 7.25611 44 11.2727Z" fill="currentColor"></path>
                    </svg>
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white">ExploreEdge</h1>
                </div>
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900 dark:text-white">
                    Create your account
                </h2>
                <p class="mt-2 text-center text-sm text-gray-600 dark:text-gray-400">
                    Join our community of travelers and explorers.
                </p>
            </div>
            <form action="{{ route('register') }}" class="mt-8 space-y-6" method="POST">
                @csrf
                <div class="rounded-lg shadow-sm -space-y-px">
                    <div>
                        <label class="sr-only" for="name">Full Name</label>
                        <input autocomplete="name" class="appearance-none rounded-none relative block w-full px-4 py-3 border @error('name') border-red-500 @else border-gray-300 dark:border-gray-700 @enderror placeholder-gray-500 text-gray-900 dark:text-white bg-background-light dark:bg-background-dark focus:outline-none focus:ring-primary focus:border-primary focus:z-10 sm:text-sm rounded-t-lg" id="name" name="name" placeholder="Full Name" required type="text" value="{{ old('name') }}"/>
                        @error('name')<p class="text-red-500 text-xs p-2">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="sr-only" for="email-address">Email address</label>
                        <input autocomplete="email" class="appearance-none rounded-none relative block w-full px-4 py-3 border @error('email') border-red-500 @else border-gray-300 dark:border-gray-700 @enderror placeholder-gray-500 text-gray-900 dark:text-white bg-background-light dark:bg-background-dark focus:outline-none focus:ring-primary focus:border-primary focus:z-10 sm:text-sm" id="email-address" name="email" placeholder="Email address" required type="email" value="{{ old('email') }}"/>
                         @error('email')<p class="text-red-500 text-xs p-2">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="sr-only" for="password">Password</label>
                        <input autocomplete="new-password" class="appearance-none rounded-none relative block w-full px-4 py-3 border @error('password') border-red-500 @else border-gray-300 dark:border-gray-700 @enderror placeholder-gray-500 text-gray-900 dark:text-white bg-background-light dark:bg-background-dark focus:outline-none focus:ring-primary focus:border-primary focus:z-10 sm:text-sm" id="password" name="password" placeholder="Create password" required type="password"/>
                         @error('password')<p class="text-red-500 text-xs p-2">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="sr-only" for="password_confirmation">Confirm Password</label>
                        <input autocomplete="new-password" class="appearance-none rounded-none relative block w-full px-4 py-3 border border-gray-300 dark:border-gray-700 placeholder-gray-500 text-gray-900 dark:text-white bg-background-light dark:bg-background-dark focus:outline-none focus:ring-primary focus:border-primary focus:z-10 sm:text-sm rounded-b-lg" id="password_confirmation" name="password_confirmation" placeholder="Confirm password" required type="password"/>
                    </div>
                </div>
                <div>
                    <button class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-bold rounded-lg text-white bg-primary hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-offset-2" type="submit">
                        Sign up
                    </button>
                </div>
            </form>
            <p class="mt-4 text-center text-sm text-gray-600 dark:text-gray-400">
                Already have an account?
                <a class="font-medium text-primary hover:text-primary/80" href="{{ route('login') }}">
                    Log in
                </a>
            </p>
        </div>
    </main>
</div>
</body>
</html>