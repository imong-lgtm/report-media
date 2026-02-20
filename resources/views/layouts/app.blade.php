<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TelecomProfile | Next Gen Connectivity</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Outfit', sans-serif; }
        .glass { background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); border-bottom: 1px solid rgba(255, 255, 255, 0.3); }
    </style>
</head>
<body class="antialiased text-gray-900 bg-white">
    <header class="glass sticky top-0 z-50">
        <nav class="max-w-7xl mx-auto px-6 py-5 flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-3xl font-extrabold text-blue-600 flex items-center gap-2 tracking-tight">
                <div class="bg-blue-600 p-2 rounded-xl text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                Telecom<span class="text-gray-900">Profile</span>
            </a>
            <div class="hidden md:flex items-center space-x-10 text-sm font-semibold uppercase tracking-wider">
                <a href="{{ route('home') }}" class="hover:text-blue-600 transition duration-300 {{ request()->routeIs('home') ? 'text-blue-600' : 'text-gray-600' }}">Home</a>
                <a href="{{ route('about') }}" class="hover:text-blue-600 transition duration-300 {{ request()->routeIs('about') ? 'text-blue-600' : 'text-gray-600' }}">About</a>
                <a href="{{ route('services') }}" class="hover:text-blue-600 transition duration-300 {{ request()->routeIs('services') ? 'text-blue-600' : 'text-gray-600' }}">Services</a>
                <a href="{{ route('projects') }}" class="hover:text-blue-600 transition duration-300 {{ request()->routeIs('projects') ? 'text-blue-600' : 'text-gray-600' }}">Projects</a>
                <a href="{{ route('contact') }}" class="ml-4 px-6 py-3 bg-blue-600 text-white rounded-2xl hover:bg-blue-700 hover:shadow-lg hover:shadow-blue-600/30 transition duration-300">Get in Touch</a>
            </div>
            <!-- Mobile Menu -->
            <button class="md:hidden p-2 text-gray-600 hover:bg-gray-100 rounded-xl transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </nav>
    </header>

    <main class="min-h-screen">
        @if(session('success'))
            <div class="fixed top-24 right-6 z-50 transform translate-y-0" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)">
                <div class="bg-blue-600 text-white px-6 py-4 rounded-3xl shadow-2xl flex items-center gap-4">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <p class="font-bold">{{ session('success') }}</p>
                </div>
            </div>
        @endif
        @yield('content')
    </main>

    <footer class="bg-gray-900 text-white py-20">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-12">
            <div class="col-span-1 md:col-span-2">
                <a href="{{ route('home') }}" class="text-3xl font-extrabold text-blue-500 mb-6 block tracking-tight">
                    Telecom<span class="text-white">Profile</span>
                </a>
                <p class="text-gray-400 text-lg max-w-sm leading-relaxed">
                    Pioneering the next generation of connectivity with innovative telecommunication solutions for a connected world.
                </p>
            </div>
            <div>
                <h3 class="text-lg font-bold mb-6 text-white uppercase tracking-widest text-sm">Quick Links</h3>
                <ul class="space-y-4 text-gray-400 font-medium">
                    <li><a href="{{ route('about') }}" class="hover:text-blue-400 transition">Our Story</a></li>
                    <li><a href="{{ route('services') }}" class="hover:text-blue-400 transition">Services</a></li>
                    <li><a href="{{ route('projects') }}" class="hover:text-blue-400 transition">Case Studies</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-blue-400 transition">Contact Us</a></li>
                    <li><a href="{{ route('admin.dashboard') }}" class="text-xs text-gray-600 hover:text-blue-400 mt-4 block">Admin Panel</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-lg font-bold mb-6 text-white uppercase tracking-widest text-sm">Main Office</h3>
                <p class="text-gray-400 font-medium mb-4">123 Tech Avenue, Silicon Valley<br>California, USA</p>
                <p class="text-gray-400 font-medium hover:text-blue-400 cursor-pointer transition">support@telecomprofile.com</p>
                <p class="text-gray-400 font-medium">+1 (555) 123-4567</p>
            </div>
        </div>
        <div class="max-w-7xl mx-auto px-6 mt-16 pt-8 border-t border-gray-800 flex flex-col md:flex-row justify-between items-center text-gray-500 font-medium">
            <p>&copy; {{ date('Y') }} TelecomProfile. All rights reserved.</p>
            <div class="flex space-x-6 mt-4 md:mt-0">
                <a href="#" class="hover:text-white transition">Privacy Policy</a>
                <a href="#" class="hover:text-white transition">Terms of Service</a>
            </div>
        </div>
    </footer>
</body>
</html>
