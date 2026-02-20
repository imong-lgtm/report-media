<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel | TelecomProfile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 text-gray-900">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-900 text-white flex-shrink-0 flex flex-col">
            <div class="p-6 border-b border-gray-800">
                <a href="{{ route('admin.dashboard') }}" class="text-xl font-bold text-blue-400">
                    TP-Admin
                </a>
            </div>
            <nav class="flex-1 p-4 space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-gray-800 transition {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white' : 'text-gray-400' }}">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    Dashboard
                </a>
                <a href="{{ route('admin.services.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-gray-800 transition {{ request()->routeIs('admin.services.*') ? 'bg-blue-600 text-white' : 'text-gray-400' }}">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    Services
                </a>
                <a href="{{ route('admin.projects.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-gray-800 transition {{ request()->routeIs('admin.projects.*') ? 'bg-blue-600 text-white' : 'text-gray-400' }}">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                    Projects
                </a>
                <a href="{{ route('admin.teams.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-gray-800 transition {{ request()->routeIs('admin.teams.*') ? 'bg-blue-600 text-white' : 'text-gray-400' }}">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    Team Members
                </a>
                <a href="{{ route('admin.messages.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-gray-800 transition {{ request()->routeIs('admin.messages.*') ? 'bg-blue-600 text-white' : 'text-gray-400' }}">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/></svg>
                    Messages
                </a>
            </nav>
            <div class="p-6 border-t border-gray-800">
                <a href="{{ route('home') }}" class="text-sm font-medium text-gray-500 hover:text-white transition">
                    &larr; Back to Site
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <header class="bg-white border-b border-gray-200 px-8 py-4 flex justify-between items-center">
                <h2 class="text-lg font-semibold text-gray-800">@yield('title', 'Dashboard')</h2>
                <div class="flex items-center gap-4">
                    <span class="text-sm font-medium text-gray-600">Admin User</span>
                    <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold">A</div>
                </div>
            </header>
            <main class="p-8">
                @if(session('success'))
                    <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-r-xl">
                        <p class="text-sm text-green-700 font-medium">{{ session('success') }}</p>
                    </div>
                @endif
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
