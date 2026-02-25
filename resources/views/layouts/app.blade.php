<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - Report Media</title>

    <!-- Fonts: Inter for UI, Playfair for Headlines -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;0,900;1,700&family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            -webkit-font-smoothing: antialiased;
        }

        .font-serif {
            font-family: 'Playfair Display', serif;
        }

        .news-ticker-animation {
            animation: ticker 30s linear infinite;
        }

        @keyframes ticker {
            0% {
                transform: translateX(100%);
            }

            100% {
                transform: translateX(-100%);
            }
        }

        .header-shadow {
            box-shadow: 0 2px 15px -3px rgba(0, 0, 0, 0.07);
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .hover-lift {
            transition: transform 0.2s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .hover-lift:hover {
            transform: translateY(-3px);
        }
    </style>
</head>

<body class="bg-[#f8f9fa] text-slate-900 selection:bg-blue-100 selection:text-blue-900">

    <!-- TOP BAR: Detik-style minor info -->
    <div
        class="bg-slate-900 text-white py-2 text-[11px] font-bold uppercase tracking-wider overflow-hidden hidden md:block">
        <div class="container mx-auto px-4 flex justify-between items-center text-slate-400">
            <div class="flex gap-6 items-center">
                <span>{{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM Y') }}</span>
                <span class="text-slate-600">|</span>
                <div class="flex gap-4">
                    <span class="text-blue-400">TRENDING:</span>
                    <a href="#" class="hover:text-white transition">#Teknologi</a>
                    <a href="#" class="hover:text-white transition">#Ekonomi</a>
                    <a href="#" class="hover:text-white transition">#Pilpres2024</a>
                </div>
            </div>
            <div class="flex gap-4">
                <a href="{{ route('about') }}" class="hover:text-white transition">Tentang Kami</a>
                <a href="{{ route('about') }}#dewan-redaksi" class="hover:text-white transition">Redaksi</a>
                <a href="{{ route('contact') }}" class="hover:text-white transition">Pedoman Media</a>
            </div>
        </div>
    </div>

    <!-- MAIN HEADER: Logo & Branding -->
    <header class="bg-white border-b border-slate-100 z-50 transition-all duration-300">
        <div class="container mx-auto px-4 py-6 md:py-8 flex flex-col md:flex-row items-center justify-between gap-6">
            <!-- Branding -->
            <div class="group flex flex-col items-center md:items-start">
                <a href="{{ route('home') }}" class="flex items-center gap-2 group">
                    @if(isset($companyProfile) && $companyProfile->logo)
                        <img src="{{ $companyProfile->logo }}" class="h-10 w-auto object-contain"
                            alt="{{ $companyProfile->name }}">
                    @else
                        <h1
                            class="text-3xl font-serif font-black tracking-tighter text-slate-900 group-hover:text-blue-600 transition-colors">
                            REPORT<span class="text-blue-600">MEDIA</span>
                        </h1>
                    @endif
                </a>
                <p class="text-[10px] font-extrabold uppercase tracking-[0.3em] text-slate-400 mt-1">Laporan Investigasi
                    & Berita Terkini</p>
            </div>

            <!-- Search Area -->
            <form action="{{ route('search') }}" method="GET" class="w-full md:w-96 relative group">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Telusuri berita hari ini..."
                    class="w-full pl-12 pr-4 py-3 bg-slate-100 rounded-xl text-sm font-medium outline-none focus:bg-white focus:ring-4 focus:ring-blue-100 transition-all border border-transparent focus:border-blue-200">
                <button type="submit"
                    class="absolute left-4 top-3 text-slate-400 group-focus-within:text-blue-500 transition-colors">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>
            </form>

            <!-- User/Auth -->
            <div class="hidden lg:flex items-center gap-4">
                @auth
                    <a href="{{ route('admin.dashboard') }}"
                        class="flex items-center gap-3 bg-slate-900 text-white px-5 py-2.5 rounded-xl font-bold text-sm hover:scale-105 transition-transform active:scale-95 shadow-lg shadow-slate-200">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Admin Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}"
                        class="text-sm font-extrabold text-slate-600 hover:text-blue-600 transition tracking-tight">MASUK
                        ADMIN</a>
                    <div class="h-4 w-px bg-slate-200"></div>
                    <a href="#" class="text-sm font-extrabold text-blue-600 hover:underline tracking-tight">LANGGANAN</a>
                @endauth
            </div>
        </div>

        <!-- NAV BAR: Categories -->
        <nav class="border-t border-slate-50 overflow-x-auto whitespace-nowrap scrollbar-hide py-1">
            <div class="container mx-auto px-4 flex justify-between items-center h-14">
                <div class="flex items-center gap-1 md:gap-4 overflow-x-auto h-full pr-10">
                    <a href="{{ route('home') }}"
                        class="px-4 py-2 text-[13px] font-black uppercase text-blue-600 border-b-2 border-blue-600">Home</a>
                    @if(isset($categoriesWithArticles))
                        @foreach($categoriesWithArticles as $nav_cat)
                            <a href="{{ route('category.show', $nav_cat->slug) }}"
                                class="px-4 py-2 text-[13px] font-bold uppercase text-slate-500 hover:text-blue-600 transition-colors">{{ $nav_cat->name }}</a>
                        @endforeach
                    @endif
                    <a href="#"
                        class="px-4 py-2 text-[13px] font-bold uppercase text-slate-500 hover:text-blue-600 transition-colors">Politik</a>
                    <a href="#"
                        class="px-4 py-2 text-[13px] font-bold uppercase text-slate-500 hover:text-blue-600 transition-colors">Ekonomi</a>
                    <a href="#"
                        class="px-4 py-2 text-[13px] font-bold uppercase text-slate-500 hover:text-blue-600 transition-colors">Lifestyle</a>
                </div>
                <button
                    class="hidden md:flex items-center gap-2 text-slate-400 hover:text-slate-900 transition font-bold text-xs">
                    LAINNYA
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
            </div>
        </nav>
    </header>

    <!-- BREAKING NEWS TICKER -->
    <div class="bg-blue-600 text-white overflow-hidden py-1.5 md:py-2 flex items-center shadow-md">
        <div
            class="bg-blue-800 px-3 md:px-6 py-1 text-[10px] md:text-xs font-black italic uppercase tracking-widest relative z-10 flex items-center gap-2">
            <span class="animate-pulse h-2 w-2 rounded-full bg-white"></span>
            Terhangat
        </div>
        <div class="relative flex-1 overflow-hidden h-full flex items-center">
            <div class="whitespace-nowrap font-bold text-[11px] md:text-sm news-ticker-animation flex gap-12">
                @if(isset($featuredArticles))
                    @foreach($featuredArticles as $ticker_art)
                        <a href="{{ route('articles.show', $ticker_art->slug) }}"
                            class="hover:underline flex items-center gap-2">
                            <span class="text-blue-200">[{{ $ticker_art->category->name }}]</span>
                            {{ $ticker_art->title }}
                        </a>
                    @endforeach
                @else
                    <span>Memuat berita terbaru hari ini... Tetap pantau report.media untuk update investigasi
                        tajam...</span>
                @endif
            </div>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    @yield('content')

    <!-- FOOTER: Multi-layered professional footer -->
    <footer class="bg-[#0f172a] text-slate-400 py-16 mt-24 border-t-8 border-blue-600">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-16 pb-16 border-b border-slate-800">
                <!-- Branding -->
                <div class="lg:col-span-1">
                    <h2 class="text-3xl font-serif font-black tracking-tighter text-white mb-6">
                        REPORT<span class="text-blue-500">MEDIA</span>
                    </h2>
                    <p class="text-sm leading-relaxed mb-8 font-medium">
                        Media investigasi independen yang menyajikan laporan mendalam, investigasi tajam, dan berita
                        terpercaya untuk masyarakat Indonesia.
                    </p>
                    <div class="flex gap-4">
                        @if($companyProfile->facebook)
                            <a href="{{ $companyProfile->facebook }}" target="_blank"
                                class="h-10 w-10 flex items-center justify-center bg-slate-800 rounded-xl hover:bg-blue-600 transition text-white text-[10px] font-black uppercase">FB</a>
                        @endif
                        @if($companyProfile->twitter)
                            <a href="{{ $companyProfile->twitter }}" target="_blank"
                                class="h-10 w-10 flex items-center justify-center bg-slate-800 rounded-xl hover:bg-blue-400 transition text-white text-[10px] font-black uppercase">TW</a>
                        @endif
                        @if($companyProfile->instagram)
                            <a href="{{ $companyProfile->instagram }}" target="_blank"
                                class="h-10 w-10 flex items-center justify-center bg-slate-800 rounded-xl hover:bg-gradient-to-tr from-orange-400 to-rose-600 transition text-white text-[10px] font-black uppercase">IG</a>
                        @endif
                        @if($companyProfile->youtube)
                            <a href="{{ $companyProfile->youtube }}" target="_blank"
                                class="h-10 w-10 flex items-center justify-center bg-slate-800 rounded-xl hover:bg-red-600 transition text-white text-[10px] font-black uppercase">YT</a>
                        @endif
                    </div>
                </div>

                <!-- Fast Links -->
                <div>
                    <h4 class="text-white font-black uppercase text-xs tracking-widest mb-8">Kategori Populer</h4>
                    <ul class="space-y-4 text-[13px] font-bold">
                        @foreach($categoriesWithArticles->take(4) as $foot_cat)
                            <li><a href="{{ route('category.show', $foot_cat->slug) }}"
                                    class="hover:text-blue-400 transition flex items-center gap-2"><span
                                        class="h-1 w-1 bg-blue-500 rounded-full"></span>{{ $foot_cat->name }}</a></li>
                        @endforeach
                    </ul>
                </div>

                <!-- Info -->
                <div>
                    <h4 class="text-white font-black uppercase text-xs tracking-widest mb-8">Tentang Redaksi</h4>
                    <ul class="space-y-4 text-[13px] font-bold">
                        <li><a href="{{ route('about') }}" class="hover:text-blue-400 transition">Profil Perusahaan</a>
                        </li>
                        <li><a href="{{ route('contact') }}" class="hover:text-blue-400 transition">Kontak & Iklan</a>
                        </li>
                        <li><a href="{{ route('about') }}#dewan-redaksi" class="hover:text-blue-400 transition">Pedoman
                                Media Siber</a></li>
                        <li><a href="{{ route('about') }}#dewan-redaksi" class="hover:text-blue-400 transition">Kode
                                Etik Jurnalistik</a></li>
                    </ul>
                    <div class="mt-8 pt-8 border-t border-slate-800">
                        <h4 class="text-white font-black uppercase text-[10px] tracking-widest mb-4 opacity-50">
                            Headquarters</h4>
                        <p class="text-[11px] font-bold text-slate-500 leading-relaxed italic">
                            {!! nl2br(e($companyProfile->address ?? 'Gedung Report Media, Lt. 5\nJl. Kebon Sirih No. 17-19\nJakarta Pusat, 10340')) !!}
                        </p>
                    </div>
                </div>

                <!-- Newsletter -->
                <div>
                    <h4 class="text-white font-black uppercase text-xs tracking-widest mb-8">Newsletter Investigasi</h4>
                    <p class="text-xs font-medium mb-6">Dapatkan berita mendalam pilihan redaksi langsung di inbox Anda.
                    </p>
                    <form action="{{ route('newsletter.subscribe') }}" method="POST" class="flex flex-col gap-3">
                        @csrf
                        <input type="email" name="email" placeholder="Email Anda" required
                            class="bg-slate-800 border-none rounded-xl px-5 py-3.5 text-xs font-bold focus:ring-2 focus:ring-blue-500 outline-none text-white transition-all">
                        <button type="submit"
                            class="bg-blue-600 text-white py-3.5 rounded-xl text-xs font-black uppercase tracking-widest hover:bg-blue-700 transition active:scale-95">Langganan</button>
                    </form>
                </div>
            </div>

            <div
                class="pt-10 flex flex-col md:flex-row justify-between items-center gap-6 text-[10px] font-black uppercase tracking-[0.2em] text-slate-500">
                <p>&copy; {{ date('Y') }} REPORT MEDIA - JURNALISME INDEPENDEN</p>
                <div class="flex gap-8">
                    <a href="#" class="hover:text-white transition">Privacy Policy</a>
                    <a href="#" class="hover:text-white transition">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

</body>

</html>