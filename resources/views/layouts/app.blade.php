<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Wanderlust - Your Travel Companion</title>

    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;700;800&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet"/>

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>

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
                        display: ["Plus Jakarta Sans", "sans-serif"],
                    },
                    borderRadius: {
                        DEFAULT: "0.25rem",
                        lg: "0.5rem",
                        xl: "0.75rem",
                        full: "9999px",
                    },
                },
            },
        };
    </script>
</head>
<body class="bg-background-light dark:bg-background-dark font-display text-slate-800 dark:text-slate-200">

    <div id="app" class="flex min-h-screen flex-col">
        {{-- The Navbar will be injected into pages that need it --}}
        @include('partials.navbar')

        <main class="flex-grow">
            @yield('content')
        </main>

        <footer class="border-t border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900/40">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-12">
                <div class="flex flex-col items-center gap-8">
                    <div class="flex flex-wrap items-center justify-center gap-x-8 gap-y-4">
                        <a class="text-base text-slate-600 dark:text-slate-400 hover:text-primary dark:hover:text-primary transition-colors" href="#">About</a>
                        <a class="text-base text-slate-600 dark:text-slate-400 hover:text-primary dark:hover:text-primary transition-colors" href="#">Contact</a>
                        <a class="text-base text-slate-600 dark:text-slate-400 hover:text-primary dark:hover:text-primary transition-colors" href="#">Privacy Policy</a>
                        <a class="text-base text-slate-600 dark:text-slate-400 hover:text-primary dark:hover:text-primary transition-colors" href="#">Terms of Service</a>
                    </div>
                    <p class="text-base text-slate-600 dark:text-slate-400">© {{ date('Y') }} Wanderlust. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </div>

</body>
</html>