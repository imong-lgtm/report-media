<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - Report Media</title>

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

        /* Mobile nav */
        .mobile-nav-overlay {
            transition: opacity 0.3s ease;
        }

        .mobile-nav-panel {
            transition: transform 0.3s ease;
        }

        .mobile-nav-panel.closed {
            transform: translateX(-100%);
        }

        /* Hide scrollbar for category nav */
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>

<body class="bg-[#f8f9fa] text-slate-900 selection:bg-blue-100 selection:text-blue-900">

    <!-- Mobile Nav Overlay -->
    <div id="mobileNavOverlay" class="mobile-nav-overlay fixed inset-0 bg-black/60 z-50 hidden"
        onclick="toggleMobileNav()"></div>

    <!-- Mobile Nav Panel -->
    <nav id="mobileNavPanel"
        class="mobile-nav-panel closed fixed inset-y-0 left-0 z-50 w-72 bg-slate-900 text-white flex flex-col md:hidden">
        <div class="p-6 border-b border-slate-800 flex justify-between items-center">
            <span class="text-xl font-serif font-black tracking-tighter">REPORT<span
                    class="text-blue-500">MEDIA</span></span>
            <button onclick="toggleMobileNav()" class="text-slate-400 hover:text-white">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="flex-1 overflow-y-auto p-4 space-y-1">
            <a href="{{ route('home') }}" class="block px-4 py-3 rounded-xl text-sm font-bold text-white bg-blue-600">🏠
                Home</a>
            @if(isset($categoriesWithArticles))
                @foreach($categoriesWithArticles as $mob_cat)
                    <a href="{{ route('category.show', $mob_cat->slug) }}"
                        class="block px-4 py-3 rounded-xl text-sm font-medium text-slate-300 hover:bg-slate-800 hover:text-white transition">📰
                        {{ $mob_cat->name }}</a>
                @endforeach
            @endif
            <div class="border-t border-slate-800 my-4"></div>
            <a href="{{ route('about') }}"
                class="block px-4 py-3 rounded-xl text-sm font-medium text-slate-400 hover:bg-slate-800 hover:text-white transition">Tentang
                Kami</a>
            <a href="{{ route('contact') }}"
                class="block px-4 py-3 rounded-xl text-sm font-medium text-slate-400 hover:bg-slate-800 hover:text-white transition">Kontak</a>
        </div>
        <div class="p-6 border-t border-slate-800">
            <form action="{{ route('search') }}" method="GET" class="relative">
                <input type="text" name="q" placeholder="Cari berita..."
                    class="w-full bg-slate-800 border-none rounded-xl pl-10 pr-4 py-3 text-sm font-bold text-white placeholder-slate-500 outline-none focus:ring-2 focus:ring-blue-500">
                <svg class="h-4 w-4 absolute left-3 top-3.5 text-slate-500" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </form>
        </div>
    </nav>

    <!-- TOP BAR (desktop only) -->
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
                </div>
            </div>
            <div class="flex gap-4">
                <a href="{{ route('about') }}" class="hover:text-white transition">Tentang Kami</a>
                <a href="{{ route('contact') }}" class="hover:text-white transition">Pedoman Media</a>
            </div>
        </div>
    </div>

    <!-- MAIN HEADER -->
    <header class="bg-white border-b border-slate-100 z-40 sticky top-0">
        <div class="container mx-auto px-4 py-3 md:py-6 flex items-center justify-between gap-4">
            <!-- Hamburger (mobile) -->
            <button onclick="toggleMobileNav()" class="md:hidden text-slate-700 flex-shrink-0">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center gap-2 flex-shrink-0">
                @if(isset($companyProfile) && $companyProfile->logo)
                    <img src="{{ $companyProfile->logo }}" class="h-8 md:h-10 w-auto object-contain"
                        alt="{{ $companyProfile->name }}">
                @else
                    <h1 class="text-xl md:text-3xl font-serif font-black tracking-tighter text-slate-900">
                        REPORT<span class="text-blue-600">MEDIA</span>
                    </h1>
                @endif
            </a>

            <!-- Tagline (desktop) -->
            <p class="text-[10px] font-extrabold uppercase tracking-[0.2em] text-slate-400 hidden lg:block">Laporan
                Investigasi & Berita Terkini</p>

            <!-- Search (desktop) -->
            <form action="{{ route('search') }}" method="GET" class="hidden md:block w-80 relative group">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Telusuri berita..."
                    class="w-full pl-10 pr-4 py-2.5 bg-slate-100 rounded-xl text-sm font-medium outline-none focus:bg-white focus:ring-4 focus:ring-blue-100 transition-all border border-transparent focus:border-blue-200">
                <button type="submit"
                    class="absolute left-3 top-2.5 text-slate-400 group-focus-within:text-blue-500 transition-colors">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>
            </form>

            <!-- Mobile Search Icon -->
            <a href="{{ route('search') }}" class="md:hidden text-slate-500 flex-shrink-0">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </a>
        </div>

        <!-- Category Nav (horizontal scrollable) -->
        <nav class="border-t border-slate-50 overflow-x-auto scrollbar-hide">
            <div class="container mx-auto px-4 flex items-center h-11 md:h-12 gap-0">
                <a href="{{ route('home') }}"
                    class="flex-shrink-0 px-3 md:px-4 py-2 text-[11px] md:text-[13px] font-black uppercase text-blue-600 border-b-2 border-blue-600">Home</a>
                @if(isset($categoriesWithArticles))
                    @foreach($categoriesWithArticles as $nav_cat)
                        <a href="{{ route('category.show', $nav_cat->slug) }}"
                            class="flex-shrink-0 px-3 md:px-4 py-2 text-[11px] md:text-[13px] font-bold uppercase text-slate-500 hover:text-blue-600 transition-colors">{{ $nav_cat->name }}</a>
                    @endforeach
                @endif
            </div>
        </nav>
    </header>

    <!-- BREAKING NEWS TICKER -->
    <div class="bg-blue-600 text-white overflow-hidden py-1.5 md:py-2 flex items-center shadow-md">
        <div
            class="bg-blue-800 px-3 md:px-6 py-1 text-[9px] md:text-xs font-black italic uppercase tracking-widest relative z-10 flex items-center gap-1.5 flex-shrink-0">
            <span class="animate-pulse h-1.5 w-1.5 md:h-2 md:w-2 rounded-full bg-white"></span>
            <span class="hidden sm:inline">Terhangat</span>
            <span class="sm:hidden">HOT</span>
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
                    <span>Memuat berita terbaru hari ini...</span>
                @endif
            </div>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    @yield('content')

    <!-- FOOTER -->
    <footer class="bg-[#0f172a] text-slate-400 py-10 md:py-16 mt-12 md:mt-24 border-t-4 md:border-t-8 border-blue-600">
        <div class="container mx-auto px-4">
            <div
                class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10 md:gap-16 pb-10 md:pb-16 border-b border-slate-800">
                <!-- Branding -->
                <div class="sm:col-span-2 lg:col-span-1">
                    <h2 class="text-2xl md:text-3xl font-serif font-black tracking-tighter text-white mb-4 md:mb-6">
                        REPORT<span class="text-blue-500">MEDIA</span>
                    </h2>
                    <p class="text-xs md:text-sm leading-relaxed mb-6 md:mb-8 font-medium">
                        Media investigasi independen yang menyajikan laporan mendalam, investigasi tajam, dan berita
                        terpercaya.
                    </p>
                    <div class="flex gap-3">
                        @if($companyProfile->facebook)
                            <a href="{{ $companyProfile->facebook }}" target="_blank"
                                class="h-9 w-9 md:h-10 md:w-10 flex items-center justify-center bg-slate-800 rounded-xl hover:bg-blue-600 transition text-white text-[10px] font-black">FB</a>
                        @endif
                        @if($companyProfile->twitter)
                            <a href="{{ $companyProfile->twitter }}" target="_blank"
                                class="h-9 w-9 md:h-10 md:w-10 flex items-center justify-center bg-slate-800 rounded-xl hover:bg-blue-400 transition text-white text-[10px] font-black">TW</a>
                        @endif
                        @if($companyProfile->instagram)
                            <a href="{{ $companyProfile->instagram }}" target="_blank"
                                class="h-9 w-9 md:h-10 md:w-10 flex items-center justify-center bg-slate-800 rounded-xl hover:bg-gradient-to-tr from-orange-400 to-rose-600 transition text-white text-[10px] font-black">IG</a>
                        @endif
                        @if($companyProfile->youtube)
                            <a href="{{ $companyProfile->youtube }}" target="_blank"
                                class="h-9 w-9 md:h-10 md:w-10 flex items-center justify-center bg-slate-800 rounded-xl hover:bg-red-600 transition text-white text-[10px] font-black">YT</a>
                        @endif
                    </div>
                </div>

                <!-- Categories -->
                <div>
                    <h4 class="text-white font-black uppercase text-xs tracking-widest mb-6 md:mb-8">Kategori Populer
                    </h4>
                    <ul class="space-y-3 md:space-y-4 text-[13px] font-bold">
                        @foreach($categoriesWithArticles->take(4) as $foot_cat)
                            <li><a href="{{ route('category.show', $foot_cat->slug) }}"
                                    class="hover:text-blue-400 transition flex items-center gap-2"><span
                                        class="h-1 w-1 bg-blue-500 rounded-full"></span>{{ $foot_cat->name }}</a></li>
                        @endforeach
                    </ul>
                </div>

                <!-- Info -->
                <div>
                    <h4 class="text-white font-black uppercase text-xs tracking-widest mb-6 md:mb-8">Tentang Redaksi
                    </h4>
                    <ul class="space-y-3 md:space-y-4 text-[13px] font-bold">
                        <li><a href="{{ route('about') }}" class="hover:text-blue-400 transition">Profil Perusahaan</a>
                        </li>
                        <li><a href="{{ route('contact') }}" class="hover:text-blue-400 transition">Kontak & Iklan</a>
                        </li>
                        <li><a href="{{ route('about') }}#dewan-redaksi" class="hover:text-blue-400 transition">Pedoman
                                Media Siber</a></li>
                    </ul>
                    <div class="mt-6 md:mt-8 pt-6 md:pt-8 border-t border-slate-800">
                        <h4 class="text-white font-black uppercase text-[10px] tracking-widest mb-3 opacity-50">
                            Headquarters</h4>
                        <p class="text-[11px] font-bold text-slate-500 leading-relaxed italic">
                            {!! nl2br(e($companyProfile->address ?? 'Gedung Report Media, Lt. 5\nJl. Kebon Sirih No. 17-19\nJakarta Pusat, 10340')) !!}
                        </p>
                    </div>
                </div>

                <!-- Newsletter -->
                <div>
                    <h4 class="text-white font-black uppercase text-xs tracking-widest mb-6 md:mb-8">Newsletter</h4>
                    <p class="text-xs font-medium mb-4 md:mb-6">Berita pilihan redaksi langsung di inbox Anda.</p>
                    <form action="{{ route('newsletter.subscribe') }}" method="POST" class="flex flex-col gap-3">
                        @csrf
                        <input type="email" name="email" placeholder="Email Anda" required
                            class="bg-slate-800 border-none rounded-xl px-4 md:px-5 py-3 text-xs font-bold focus:ring-2 focus:ring-blue-500 outline-none text-white">
                        <button type="submit"
                            class="bg-blue-600 text-white py-3 rounded-xl text-xs font-black uppercase tracking-widest hover:bg-blue-700 transition active:scale-95">Langganan</button>
                    </form>
                </div>
            </div>

            <div
                class="pt-8 md:pt-10 flex flex-col md:flex-row justify-between items-center gap-4 text-[10px] font-black uppercase tracking-[0.15em] md:tracking-[0.2em] text-slate-500">
                <p>&copy; {{ date('Y') }} REPORT MEDIA</p>
                <div class="flex gap-6 md:gap-8">
                    <a href="#" class="hover:text-white transition">Privacy</a>
                    <a href="#" class="hover:text-white transition">Terms</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        function toggleMobileNav() {
            const panel = document.getElementById('mobileNavPanel');
            const overlay = document.getElementById('mobileNavOverlay');
            panel.classList.toggle('closed');
            overlay.classList.toggle('hidden');
        }
    </script>

</body>

</html>