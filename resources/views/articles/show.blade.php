@extends('layouts.app')

@section('title', $article->title)

@section('content')
    <main class="container mx-auto px-4 py-8">
        <div class="flex flex-col lg:flex-row gap-12">

            <!-- MAIN ARTICLE CONTENT -->
            <article class="flex-1 max-w-4xl bg-white rounded-3xl p-6 md:p-12 border border-slate-100 shadow-sm">

                <!-- Breadcrumbs -->
                <nav class="flex items-center gap-3 mb-8 text-[11px] font-black uppercase tracking-widest text-slate-400">
                    <a href="{{ route('home') }}" class="hover:text-blue-600 transition">Home</a>
                    <span>/</span>
                    <span class="text-blue-600">{{ $article->category->name }}</span>
                </nav>

                <!-- Headline -->
                <h1 class="text-3xl md:text-5xl font-serif font-black leading-tight text-slate-900 mb-8">
                    {{ $article->title }}
                </h1>

                <!-- Meta & Share -->
                <div
                    class="flex flex-col md:flex-row md:items-center justify-between py-6 border-y border-slate-50 mb-10 gap-6">
                    <div class="flex items-center gap-4">
                        <div
                            class="h-10 w-10 rounded-xl bg-blue-600 flex items-center justify-center text-white font-black text-xs">
                            RM</div>
                        <div>
                            <h5 class="font-bold text-slate-900 text-sm leading-none mb-1">Redaksi Report Media</h5>
                            <p class="text-slate-400 text-[10px] font-black uppercase tracking-widest">
                                {{ $article->created_at->isoFormat('D MMMM Y | HH:mm') }} WIB</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-2">
                        <button
                            class="flex items-center gap-2 px-4 py-2 bg-blue-50 text-blue-600 rounded-xl text-[10px] font-black uppercase tracking-tight hover:bg-blue-600 hover:text-white transition group">
                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M18.77 7.46H14.5v-1.9c0-.9.6-1.1 1-1.1h3V.5h-4.33C10.24.5 9.5 3.44 9.5 5.32v2.14h-3v4h3v12h5v-12h3.85l.42-4z" />
                            </svg>
                            Share
                        </button>
                        <button
                            class="flex items-center gap-2 px-4 py-2 bg-slate-50 text-slate-600 rounded-xl text-[10px] font-black uppercase tracking-tight hover:bg-slate-900 hover:text-white transition">
                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.84 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z" />
                            </svg>
                            Tweet
                        </button>
                    </div>
                </div>

                <!-- Main Image -->
                @if($article->image)
                    <figure class="mb-10 rounded-2xl overflow-hidden shadow-2xl shadow-blue-50">
                        <img src="{{ asset('storage/' . $article->image) }}" class="w-full h-auto" alt="{{ $article->title }}">
                        @if($article->caption)
                            <figcaption
                                class="p-4 bg-slate-50 text-slate-500 text-[11px] font-bold italic border-t border-slate-100">
                                &copy; Report Media / {{ $article->caption }}
                            </figcaption>
                        @endif
                    </figure>
                @endif

                <!-- Body Text -->
                <div
                    class="prose prose-slate prose-lg max-w-none prose-p:text-slate-700 prose-p:font-medium prose-p:leading-relaxed prose-headings:font-serif prose-headings:font-black prose-strong:text-slate-900">
                    {!! nl2br(e($article->content)) !!}
                </div>

                <!-- Footer Meta -->
                <div class="mt-16 pt-8 border-t border-slate-100 flex flex-wrap gap-4">
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">TAGS:</span>
                    <a href="#"
                        class="px-3 py-1 bg-slate-100 text-slate-600 rounded-lg text-[10px] font-bold hover:bg-blue-600 hover:text-white transition">{{ $article->category->name }}</a>
                    <a href="#"
                        class="px-3 py-1 bg-slate-100 text-slate-600 rounded-lg text-[10px] font-bold hover:bg-blue-600 hover:text-white transition">Investigasi</a>
                    <a href="#"
                        class="px-3 py-1 bg-slate-100 text-slate-600 rounded-lg text-[10px] font-bold hover:bg-blue-600 hover:text-white transition">Report
                        Media</a>
                </div>

            </article>

            <!-- SIDEBAR -->
            <aside class="lg:w-80 space-y-10">

                <!-- Trending in Category -->
                <div class="bg-white rounded-2xl border border-slate-100 p-6 shadow-sm overflow-hidden">
                    <h4 class="text-sm font-black uppercase tracking-widest mb-6 border-l-4 border-blue-600 pl-3">
                        Terkait di <span class="text-blue-600">{{ $article->category->name }}</span>
                    </h4>
                    <div class="space-y-6">
                        @forelse($relatedArticles as $rel)
                            <div class="group">
                                <a href="{{ route('articles.show', $rel->slug) }}" class="flex gap-4">
                                    <div class="h-16 w-16 rounded-lg overflow-hidden flex-shrink-0 bg-slate-100">
                                        <img src="{{ $rel->image ? asset('storage/' . $rel->image) : 'https://images.unsplash.com/photo-1546422904-90eab23c3d7e?q=80&w=2072&auto=format&fit=crop' }}"
                                            class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                                    </div>
                                    <h5
                                        class="text-xs font-bold leading-snug group-hover:text-blue-600 transition line-clamp-2">
                                        {{ $rel->title }}</h5>
                                </a>
                            </div>
                        @empty
                            <p class="text-[10px] font-bold text-slate-400">Tidak ada berita terkait lainnya.</p>
                        @endforelse
                    </div>
                </div>

                <!-- Fake Ads / Call to Action -->
                <div
                    class="bg-gradient-to-br from-blue-700 to-indigo-900 rounded-2xl p-8 text-white relative overflow-hidden group">
                    <div
                        class="absolute -top-10 -right-10 h-32 w-32 bg-white/10 rounded-full blur-3xl group-hover:scale-150 transition-transform duration-1000">
                    </div>
                    <h4 class="text-lg font-serif font-black mb-4 relative z-10">Dukung Jurnalisme Merdeka</h4>
                    <p class="text-blue-100 text-[11px] font-medium leading-relaxed mb-6 relative z-10">Kontribusi Anda
                        membantu kami menyajikan laporan investigasi yang tajam dan tak berpihak.</p>
                    <button
                        class="w-full py-3 bg-white text-blue-900 font-black text-[10px] uppercase tracking-widest rounded-xl hover:bg-blue-400 hover:text-white transition relative z-10 active:scale-95 shadow-xl">Donasi
                        Sekarang</button>
                </div>

                <!-- Popular News -->
                <div class="bg-slate-50 rounded-2xl p-6 border border-slate-100">
                    <h4 class="text-sm font-black uppercase tracking-widest mb-6 text-slate-900">Populer Hari Ini</h4>
                    <div class="space-y-6 text-xs">
                        <div class="flex gap-4 items-start">
                            <span class="font-serif font-black text-slate-300 text-xl">01</span>
                            <a href="#" class="font-bold hover:text-blue-600 transition">Update Terbaru Kasus Investigasi
                                Nasional Hari Ini</a>
                        </div>
                        <div class="flex gap-4 items-start">
                            <span class="font-serif font-black text-slate-300 text-xl">02</span>
                            <a href="#" class="font-bold hover:text-blue-600 transition">Ekonomi Global Melemah, Bagaimana
                                Dampaknya Bagi Indonesia?</a>
                        </div>
                        <div class="flex gap-4 items-start">
                            <span class="font-serif font-black text-slate-300 text-xl">03</span>
                            <a href="#" class="font-bold hover:text-blue-600 transition">Inovasi Teknologi 2026 yang Akan
                                Mengubah Cara Hidup Kita</a>
                        </div>
                    </div>
                </div>

            </aside>
        </div>
    </main>
@endsection