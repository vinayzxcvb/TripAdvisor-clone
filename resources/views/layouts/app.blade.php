<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TripAdvisor Clone</title>
    {{-- Tailwind CSS via CDN for simplicity --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root { --primary-color: #00af87; }
        .bg-primary { background-color: var(--primary-color); }
        .text-primary { color: var(--primary-color); }
        .border-primary { border-color: var(--primary-color); }
    </style>
</head>
<body class="bg-gray-100 font-sans">

    @include('partials.navbar') 

    <main>
        @yield('content')
    </main>

    <footer class="bg-gray-800 text-white text-center p-6 mt-12">
        <p>&copy; {{ date('Y') }} TripAdvisor Clone. All Rights Reserved.</p>
    </footer>

</body>
</html>