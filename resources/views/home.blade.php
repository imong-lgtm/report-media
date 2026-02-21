@extends('layouts.app')

@section('title', 'Laporan Berita Terkini & Terpercaya')

@section('content')
<main class="container mx-auto px-6 py-12">
    <!-- Featured Hero Section -->
    @if($featuredArticles->count() > 0)
    <section class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-20">
        <div class="lg:col-span-2 group cursor-pointer relative overflow-hidden rounded-[2.5rem]">
            @php $main = $featuredArticles->first(); @endphp
            <div class="aspect-[16/9] w-full overflow-hidden">
                <img src="{{ $main->image ? asset('storage/' . $main->image) : 'https://images.unsplash.com/photo-1504715603422-59e1b7987e3f?q=80&w=2070&auto=format&fit=crop' }}" 
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
            </div>
            <div class="absolute inset-0 bg-gradient-to-t from-black via-black/20 to-transparent"></div>
            <div class="absolute bottom-0 left-0 p-10 text-white w-full">
                <span class="px-4 py-1.5 bg-blue-600 rounded-full text-xs font-bold uppercase tracking-widest mb-4 inline-block">{{ $main->category->name }}</span>
                <a href="{{ route('articles.show', $main->slug) }}">
                    <h2 class="text-4xl md:text-5xl font-serif font-black leading-tight group-hover:underline">{{ $main->title }}</h2>
                </a>
                <p class="mt-4 text-slate-300 font-medium line-clamp-2 max-w-2xl">{{ Str::limit(strip_tags($main->content), 150) }}</p>
                <div class="mt-6 flex items-center gap-3 text-sm font-bold">
                    <div class="h-8 w-8 rounded-full bg-blue-500 flex items-center justify-center text-xs">RM</div>
                    <span>report.media &bull; {{ $main->created_at->diffForHumans() }}</span>
                </div>
            </div>
        </div>

        <div class="flex flex-col gap-8">
            <h3 class="font-bold text-xl flex items-center gap-2">
                <span class="h-1 w-8 bg-blue-600 rounded-full"></span>
                Berita Utama
            </h3>
            <div class="space-y-8">
                @foreach($featuredArticles->skip(1) as $art)
                <div class="group flex gap-5">
                    <div class="flex-1">
                        <span class="text-xs font-bold text-blue-600 uppercase tracking-widest mb-1 block">{{ $art->category->name }}</span>
                        <a href="{{ route('articles.show', $art->slug) }}">
                            <h4 class="font-serif font-bold text-lg leading-tight group-hover:text-blue-600 transition">{{ $art->title }}</h4>
                        </a>
                        <span class="text-[10px] text-slate-400 font-bold mt-2 block">{{ $art->created_at->format('d M Y') }}</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Latest Stories Grid -->
    <div class="flex flex-col lg:flex-row gap-12">
        <div class="lg:w-2/3">
            <h3 class="text-3xl font-serif font-black mb-10 flex items-center gap-4">
                Laporan Terbaru
                <span class="flex-1 h-px bg-slate-100"></span>
            </h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                @foreach($latestArticles as $article)
                <div class="group">
                    <div class="aspect-video w-full rounded-3xl overflow-hidden mb-6 bg-slate-100">
                        <img src="{{ $article->image ? asset('storage/' . $article->image) : 'https://images.unsplash.com/photo-1546422904-90eab23c3d7e?q=80&w=2072&auto=format&fit=crop' }}" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <span class="text-xs font-bold text-blue-600 uppercase tracking-widest mb-3 block">{{ $article->category->name }}</span>
                    <a href="{{ route('articles.show', $article->slug) }}">
                        <h4 class="text-xl font-serif font-bold leading-tight group-hover:text-blue-600 transition">{{ $article->title }}</h4>
                    </a>
                    <p class="mt-4 text-slate-500 text-sm font-medium leading-relaxed line-clamp-3">
                        {{ Str::limit(strip_tags($article->content), 120) }}
                    </p>
                    <div class="mt-6 flex items-center justify-between">
                        <span class="text-xs text-slate-400 font-bold italic">{{ $article->created_at->diffForHumans() }}</span>
                        <a href="{{ route('articles.show', $article->slug) }}" class="text-xs font-black text-blue-600 group-hover:translate-x-1 transition flex items-center gap-1">
                            BACA SELENGKAPNYA
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Sidebar -->
        <aside class="lg:w-1/3 space-y-12">
            <div class="bg-slate-50 rounded-[2.5rem] p-10 border border-slate-100">
                <h4 class="text-xl font-serif font-black mb-8">Redaksi report.media</h4>
                <p class="text-slate-500 text-sm font-medium">Laporan mendalam, investigasi tajam, dan berita terpercaya dari seluruh penjuru negeri untuk Anda.</p>
            </div>

            <div class="p-10 bg-blue-600 rounded-[2.5rem] text-white overflow-hidden relative group">
                <div class="absolute -top-10 -right-10 h-40 w-40 bg-white/10 rounded-full blur-3xl group-hover:scale-150 transition-transform duration-1000"></div>
                <h4 class="text-2xl font-serif font-black mb-4 relative z-10">Buletin report.media</h4>
                <p class="text-blue-100 text-sm font-medium mb-8 relative z-10">Dapatkan berita investigasi terbaik langsung di email Anda setiap hari.</p>
                <div class="flex flex-col gap-3 relative z-10">
                    <input type="email" placeholder="Alamat email Anda" class="w-full px-5 py-4 rounded-2xl bg-white/10 border border-white/20 text-white placeholder:text-blue-200 outline-none focus:bg-white/20 transition-all font-medium">
                    <button class="w-full py-4 bg-white text-blue-600 font-bold rounded-2xl shadow-lg transition-transform hover:-translate-y-0.5">Berlangganan</button>
                </div>
            </div>
        </aside>
    </div>
</main>
@endsection
