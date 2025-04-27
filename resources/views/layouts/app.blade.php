<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MAC Lookup</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-900 min-h-screen">

<!-- Navbar (optional) -->
<nav class="bg-white shadow mb-6">
    <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between">
        <span class="font-bold text-xl">Glide MAC Lookup Tool</span>
        <a href="{{ route('macs.index') }}" class="text-blue-600 hover:underline">Home</a>
    </div>
</nav>

<!-- Main content -->
<main>
    @yield('content')
</main>

<!-- Footer (optional) -->
<footer class="text-center text-sm text-gray-500 mt-8 mb-4">
    &copy; {{ now()->year }} Glide Organisation MAC Lookup Tool
</footer>

</body>
</html>
