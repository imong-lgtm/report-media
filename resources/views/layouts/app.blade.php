<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Berita Utama') - report.media</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .font-serif { font-family: 'Playfair Display', serif; }
    </style>
</head>
<body class="bg-white text-slate-900">
    <!-- Header -->
    <header class="border-b border-slate-100 sticky top-0 bg-white/95 backdrop-blur-md z-50">
        <div class="container mx-auto px-6 py-4 flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="flex items-center gap-8">
                <a href="{{ route('home') }}" class="text-4xl font-serif font-black tracking-tighter text-blue-600">
                    report<span class="text-slate-900">.media</span>
                </a>
                <nav class="hidden lg:flex items-center gap-6">
                    <a href="{{ route('home') }}" class="text-sm font-bold text-blue-600 transition tracking-wide uppercase border-b-2 border-blue-600 pb-1">Berita Utama</a>
                    <a href="{{ route('about') }}" class="text-sm font-bold text-slate-600 hover:text-blue-600 transition tracking-wide uppercase">Tentang</a>
                    <a href="{{ route('contact') }}" class="text-sm font-bold text-slate-600 hover:text-blue-600 transition tracking-wide uppercase">Kontak</a>
                </nav>
            </div>
            
            <div class="flex items-center gap-4">
                <div class="relative group hidden sm:block">
                    <input type="text" placeholder="Cari berita..." class="pl-10 pr-4 py-2 bg-slate-100 rounded-full text-sm outline-none w-48 focus:w-64 focus:bg-white focus:ring-2 focus:ring-blue-100 transition-all font-medium">
                    <svg class="h-4 w-4 absolute left-4 top-3 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
                @auth
                    <a href="{{ route('admin.dashboard') }}" class="text-sm font-bold bg-slate-900 text-white px-5 py-2 rounded-full hover:bg-blue-600 transition">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-bold text-slate-600 hover:text-blue-600 transition">Masuk Admin</a>
                @endauth
            </div>
        </div>
    </header>

    @yield('content')

    <!-- Footer -->
    <footer class="bg-slate-900 text-white pt-20 pb-10 mt-20">
        <div class="container mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-12 border-b border-slate-800 pb-20">
            <div class="md:col-span-1">
                <a href="{{ route('home') }}" class="text-3xl font-serif font-black tracking-tighter text-blue-500 mb-6 block">
                    report<span class="text-white">.media</span>
                </a>
                <p class="text-slate-400 text-sm leading-relaxed font-medium">
                    Laporan mendalam, investigasi tajam, dan berita terpercaya dari seluruh penjuru negeri untuk Anda.
                </p>
            </div>
            <div>
                <h4 class="font-bold text-lg mb-6">NavigasiCepat</h4>
                <ul class="space-y-4 text-slate-400 text-sm font-medium">
                    <li><a href="{{ route('home') }}" class="hover:text-blue-400 transition">Beranda</a></li>
                    <li><a href="{{ route('about') }}" class="hover:text-blue-400 transition">Profil Redaksi</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-blue-400 transition">Hubungi Kami</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold text-lg mb-6">Redaksi</h4>
                <ul class="space-y-4 text-slate-400 text-sm font-medium">
                    <li><a href="{{ route('about') }}" class="hover:text-blue-400 transition">Tentang Kami</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-blue-400 transition">Hubungi Kami</a></li>
                    <li><a href="#" class="hover:text-blue-400 transition">Pedoman Media Siber</a></li>
                    <li><a href="#" class="hover:text-blue-400 transition">Kode Etik</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold text-lg mb-6">Ikuti Kami</h4>
                <div class="flex gap-4">
                    <a href="#" class="bg-slate-800 h-10 w-10 rounded-full flex items-center justify-center hover:bg-blue-600 transition">FB</a>
                    <a href="#" class="bg-slate-800 h-10 w-10 rounded-full flex items-center justify-center hover:bg-blue-400 transition">TW</a>
                    <a href="#" class="bg-slate-800 h-10 w-10 rounded-full flex items-center justify-center hover:bg-rose-500 transition">IG</a>
                </div>
            </div>
        </div>
        <div class="container mx-auto px-6 mt-10 text-center text-slate-500 text-xs font-bold uppercase tracking-widest">
            &copy; 2026 report.media - Hak Cipta Dilindungi
        </div>
    </footer>
</body>
</html>
