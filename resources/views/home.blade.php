@extends('layouts.app')

@section('title', 'Laporan Berita Terkini & Terpercaya')

@section('content')
    <main class="container mx-auto px-4 py-8">

        <!-- HEADLINES SECTION (Hero Section) -->
        @if($featuredArticles->count() > 0)
            <section class="grid grid-cols-1 lg:grid-cols-4 gap-6 mb-12">
                <!-- Main Headline -->
                <div
                    class="lg:col-span-2 group cursor-pointer relative overflow-hidden rounded-2xl bg-black border border-slate-100 shadow-xl shadow-blue-50">
                    @php $main = $featuredArticles->first(); @endphp
                    <div class="aspect-[4/3] md:aspect-[16/10] w-full overflow-hidden">
                        <img src="{{ $main->image ? asset('storage/' . $main->image) : 'https://images.unsplash.com/photo-1504715603422-59e1b7987e3f?q=80&w=2070&auto=format&fit=crop' }}"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 opacity-80 group-hover:opacity-90">
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-900/40 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 p-6 md:p-8 text-white w-full">
                        <span
                            class="px-3 py-1 bg-red-600 rounded text-[10px] font-black uppercase tracking-widest mb-4 inline-block">UTAMA</span>
                        <a href="{{ route('articles.show', $main->slug) }}">
                            <h2
                                class="text-2xl md:text-4xl font-serif font-black leading-tight group-hover:text-blue-300 transition-colors">
                                {{ $main->title }}</h2>
                        </a>
                        <div
                            class="mt-4 flex items-center gap-3 text-[11px] font-extrabold text-slate-300 uppercase tracking-tight">
                            <span class="text-blue-400">{{ $main->category->name }}</span>
                            <span>&bull;</span>
                            <span>{{ $main->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>

                <!-- Secondary Headlines -->
                <div class="lg:col-span-2 flex flex-col gap-6">
                    @foreach($featuredArticles->skip(1)->take(3) as $art)
                        <div
                            class="group flex gap-5 bg-white p-4 rounded-2xl border border-slate-100 hover:border-blue-200 hover:shadow-lg hover:shadow-blue-50/50 transition-all">
                            <div class="w-32 h-24 md:w-40 md:h-28 rounded-xl overflow-hidden flex-shrink-0">
                                <img src="{{ $art->image ? asset('storage/' . $art->image) : 'https://images.unsplash.com/photo-1585829365234-781fcd04c8.q=80&w=2070&auto=format&fit=crop' }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            </div>
                            <div class="flex flex-col justify-center">
                                <span
                                    class="text-[10px] font-black text-blue-600 uppercase tracking-widest mb-1 block">{{ $art->category->name }}</span>
                                <a href="{{ route('articles.show', $art->slug) }}">
                                    <h4
                                        class="font-serif font-bold text-base md:text-lg leading-snug group-hover:text-blue-700 transition">
                                        {{ $art->title }}</h4>
                                </a>
                                <span
                                    class="text-[10px] text-slate-400 font-bold mt-2 uppercase">{{ $art->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        <!-- MAIN BODY: Content + Sidebar -->
        <div class="flex flex-col lg:flex-row gap-10">

            <!-- ARTICLE LISTING -->
            <div class="flex-1">

                <!-- Category Sections Grid -->
                @foreach($categoriesWithArticles->take(2) as $category)
                    <section class="mb-16">
                        <div class="flex items-center justify-between mb-8 border-b-4 border-blue-600">
                            <h3 class="bg-blue-600 text-white px-6 py-2 text-sm font-black uppercase tracking-widest">
                                {{ $category->name }}
                            </h3>
                            <a href="#" class="text-xs font-black text-blue-600 hover:underline">LIHAT SEMUA</a>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            @foreach($category->articles->take(4) as $article)
                                <div class="group flex flex-col md:flex-row gap-4">
                                    <div class="w-full md:w-32 h-44 md:h-24 rounded-xl overflow-hidden flex-shrink-0 bg-slate-100">
                                        <img src="{{ $article->image ? asset('storage/' . $article->image) : 'https://images.unsplash.com/photo-1546422904-90eab23c3d7e?q=80&w=2072&auto=format&fit=crop' }}"
                                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                    </div>
                                    <div class="flex flex-col">
                                        <a href="{{ route('articles.show', $article->slug) }}">
                                            <h4
                                                class="text-base font-bold font-serif leading-tight group-hover:text-blue-600 transition">
                                                {{ $article->title }}</h4>
                                        </a>
                                        <p
                                            class="mt-2 text-slate-500 text-[11px] font-medium leading-relaxed line-clamp-2 hidden md:block">
                                            {{ Str::limit(strip_tags($article->content), 80) }}
                                        </p>
                                        <span
                                            class="mt-2 text-[10px] text-slate-400 font-bold uppercase">{{ $article->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </section>
                @endforeach

                <!-- Latest News (River) -->
                <section>
                    <h3 class="text-2xl font-serif font-black mb-10 flex items-center gap-4">
                        Berita Terkini
                        <div class="flex-1 h-1 bg-slate-100 rounded-full"></div>
                    </h3>

                    <div class="space-y-10">
                        @foreach($latestArticles as $article)
                            <div
                                class="group flex flex-col md:flex-row gap-8 pb-10 border-b border-slate-100 last:border-0 hover-lift">
                                <div
                                    class="w-full md:w-64 h-44 rounded-2xl overflow-hidden flex-shrink-0 shadow-lg shadow-slate-100">
                                    <img src="{{ $article->image ? asset('storage/' . $article->image) : 'https://images.unsplash.com/photo-1546422904-90eab23c3d7e?q=80&w=2072&auto=format&fit=crop' }}"
                                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                </div>
                                <div class="flex-1">
                                    <span
                                        class="text-[10px] font-black text-red-600 uppercase tracking-widest mb-2 block">{{ $article->category->name }}</span>
                                    <a href="{{ route('articles.show', $article->slug) }}">
                                        <h4
                                            class="text-2xl font-serif font-bold leading-tight group-hover:text-blue-600 transition mb-3">
                                            {{ $article->title }}</h4>
                                    </a>
                                    <p class="text-slate-500 text-sm font-medium leading-relaxed mb-4 line-clamp-3">
                                        {{ Str::limit(strip_tags($article->content), 150) }}
                                    </p>
                                    <div class="flex items-center justify-between">
                                        <span
                                            class="text-[11px] text-slate-400 font-bold uppercase tracking-tight flex items-center gap-2">
                                            <span class="h-1 w-1 bg-slate-300 rounded-full"></span>
                                            {{ $article->created_at->diffForHumans() }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
            </div>

            <!-- SIDEBAR -->
            <aside class="lg:w-80 space-y-12">

                <!-- Most Popular Widget -->
                <div class="bg-white rounded-2xl border border-slate-100 p-6 shadow-sm overflow-hidden">
                    <h4 class="text-lg font-serif font-black mb-6 border-b-2 border-slate-900 pb-2 flex items-center gap-2">
                        Terpopuler
                    </h4>
                    <div class="space-y-6">
                        @foreach($featuredArticles->take(5) as $index => $pop)
                            <div class="flex gap-4 group">
                                <span
                                    class="text-3xl font-serif font-black text-slate-200 group-hover:text-blue-200 transition-colors leading-none">0{{ $index + 1 }}</span>
                                <div>
                                    <a href="{{ route('articles.show', $pop->slug) }}">
                                        <h5
                                            class="text-sm font-bold leading-snug group-hover:text-blue-600 transition line-clamp-2">
                                            {{ $pop->title }}</h5>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Redaksi Note -->
                <div class="bg-slate-900 rounded-3xl p-8 text-white relative overflow-hidden group shadow-xl">
                    <div
                        class="absolute -top-10 -right-10 h-32 w-32 bg-blue-600/20 rounded-full blur-3xl group-hover:scale-150 transition-transform duration-1000">
                    </div>
                    <h4 class="text-xl font-serif font-black mb-4 relative z-10 text-blue-400">#LaporkanKebenaran</h4>
                    <p class="text-slate-300 text-xs font-medium leading-relaxed mb-6 relative z-10">Laporan mendalam,
                        investigasi tajam, dan berita terpercaya untuk Anda.</p>
                    <button
                        class="w-full py-3 bg-white text-slate-900 font-black text-[10px] uppercase tracking-widest rounded-xl hover:bg-blue-400 transition-colors relative z-10">Tentang
                        Redaksi</button>
                </div>

                <!-- Categories Pill -->
                <div>
                    <h4 class="text-sm font-black uppercase tracking-widest mb-6 text-slate-400">Kategori Utama</h4>
                    <div class="flex flex-wrap gap-2">
                        @foreach($categoriesWithArticles as $cat_pill)
                            <a href="#"
                                class="px-4 py-2 bg-slate-100 hover:bg-blue-600 hover:text-white transition rounded-lg text-xs font-bold uppercase tracking-tight text-slate-600">
                                {{ $cat_pill->name }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </aside>

        </div>
    </main>
@endsection