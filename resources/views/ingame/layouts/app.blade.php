<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dreamforge Emporium</title>
    <link rel="stylesheet" href="{{ asset('css/ingame.css') }}">
    <script src="{{ asset('js/ingame.js') }}" defer></script>
</head>

<body class="bg-gray-900 text-white min-h-screen flex flex-col">

    <!-- Top Bar / Game Header -->
    <header class="bg-gray-800 text-white p-4 shadow-md flex justify-between items-center">
        <h1 class="text-xl font-bold">Dreamforge Emporium</h1>
        <div>
            <a href="{{ route('overview.index') }}" class="hover:underline mr-4">Overview</a>
            <a href="{{ route('profile') }}" class="hover:underline">My Corridor</a>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-1 p-6">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-center text-sm text-gray-400 py-2">
        &copy; {{ date('Y') }} Dreamforge Emporium. All rights reserved.
    </footer>
@stack('scripts')
</body>
</html>
