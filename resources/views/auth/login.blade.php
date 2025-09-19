<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Login - Wanderlust</title>
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;700;800&display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
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
<body class="bg-background-light dark:bg-background-dark font-display">
<div class="flex min-h-screen flex-col items-center justify-center">
    <div class="w-full max-w-md space-y-8 p-8">
        <div>
            <div class="flex items-center justify-center gap-2">
                <svg class="h-8 w-8 text-primary" fill="none" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                    <path d="M44 11.2727C44 14.0109 39.8386 16.3957 33.69 17.6364C39.8386 18.877 44 21.2618 44 24C44 26.7382 39.8386 29.123 33.69 30.3636C39.8386 31.6043 44 33.9891 44 36.7273C44 40.7439 35.0457 44 24 44C12.9543 44 4 40.7439 4 36.7273C4 33.9891 8.16144 31.6043 14.31 30.3636C8.16144 29.123 4 26.7382 4 24C4 21.2618 8.16144 18.877 14.31 17.6364C8.16144 16.3957 4 14.0109 4 11.2727C4 7.25611 12.9543 4 24 4C35.0457 4 44 7.25611 44 11.2727Z" fill="currentColor"></path>
                </svg>
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white">Wanderlust</h2>
            </div>
            <h2 class="mt-6 text-center text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Log in to your account</h2>
             @if (session('success'))
                <p class="mt-2 text-center text-sm text-green-600">
                    {{ session('success') }}
                </p>
            @endif
        </div>
        <form action="{{ route('login') }}" class="mt-8 space-y-6" method="POST">
            @csrf
            <div class="space-y-4 rounded-md shadow-sm">
                <div>
                    <label class="sr-only" for="email">Email</label>
                    <input autocomplete="email" class="form-input relative block w-full appearance-none rounded-lg border @error('email') border-red-500 @else border-gray-300 dark:border-gray-700 @enderror bg-white dark:bg-gray-800 px-3 py-4 text-gray-900 dark:text-white focus:z-10 focus:border-primary focus:outline-none focus:ring-primary sm:text-sm" id="email" name="email" placeholder="Email" required="" type="email" value="{{ old('email') }}"/>
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="sr-only" for="password">Password</label>
                    <input autocomplete="current-password" class="form-input relative block w-full appearance-none rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 px-3 py-4 text-gray-900 dark:text-white focus:z-10 focus:border-primary focus:outline-none focus:ring-primary sm:text-sm" id="password" name="password" placeholder="Password" required="" type="password"/>
                </div>
            </div>
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input id="remember_me" name="remember" type="checkbox" class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded">
                    <label for="remember_me" class="ml-2 block text-sm text-gray-900 dark:text-gray-300">Remember me</label>
                </div>
                <div class="text-sm">
                    <a class="font-medium text-primary hover:text-primary/80" href="#"> Forgot your password? </a>
                </div>
            </div>
            <div>
                <button class="group relative flex w-full justify-center rounded-lg border border-transparent bg-primary px-4 py-3 text-sm font-bold text-white hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2" type="submit">
                    Log in
                </button>
            </div>
            <div class="text-center text-sm text-gray-600 dark:text-gray-400">
                <p>
                    Don't have an account?
                    <a class="font-medium text-primary hover:text-primary/80" href="{{ route('register') }}"> Sign up </a>
                </p>
            </div>
        </form>
    </div>
</div>
</body>
</html>