@extends('layouts.app')

@section('title', 'Pencarian: ' . $article->title)

@section('content')
    <div class="bg-white py-12">
        <div class="container mx-auto px-4">
            <!-- Search Header -->
            <div class="mb-12 border-b border-slate-100 pb-8 text-center">
                <h1 class="text-4xl md:text-6xl font-serif font-black text-slate-900 tracking-tighter">
                    Hasil Pencarian: <span class="text-blue-600">"{{ $query }}"</span>
                </h1>
                <p class="mt-4 text-slate-500 font-medium">Ditemukan {{ $articles->total() }} berita terkait kata kunci
                    Anda.</p>
            </div>

            <div class="max-w-4xl mx-auto space-y-12">
                @forelse($articles as $article)
                    <article
                        class="group flex flex-col md:flex-row gap-8 pb-12 border-b border-slate-100 last:border-0 hover-lift">
                        <div class="w-full md:w-64 h-44 rounded-2xl overflow-hidden flex-shrink-0 shadow-lg shadow-slate-100">
                            <img src="{{ $article->image ?? 'https://images.unsplash.com/photo-1546422904-90eab23c3d7e?q=80&w=2072&auto=format&fit=crop' }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                                alt="{{ $article->title }}">
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-3">
                                <span
                                    class="px-3 py-1 bg-blue-50 text-blue-600 text-[10px] font-black uppercase tracking-widest rounded-lg">
                                    {{ $article->category->name }}
                                </span>
                                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">
                                    {{ $article->created_at->diffForHumans() }}
                                </span>
                            </div>
                            <h2
                                class="text-2xl font-serif font-black text-slate-900 mb-4 group-hover:text-blue-600 transition-colors leading-tight">
                                <a href="{{ route('articles.show', $article->slug) }}">{{ $article->title }}</a>
                            </h2>
                            <p class="text-slate-500 text-sm leading-relaxed line-clamp-2 mb-6 font-medium">
                                {{ Str::limit(strip_tags($article->content), 160) }}
                            </p>
                            <div class="flex items-center justify-between mt-auto">
                                <span class="text-[10px] font-black uppercase tracking-widest text-slate-900">Oleh
                                    {{ $article->user->name }}</span>
                                <a href="{{ route('articles.show', $article->slug) }}"
                                    class="text-xs font-black text-blue-600 flex items-center gap-1 group/btn">
                                    Baca Selengkapnya
                                    <svg class="h-4 w-4 transform group-hover/btn:translate-x-1 transition-transform"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                            d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="py-20 text-center bg-slate-50 rounded-[2.5rem]">
                        <div class="h-20 w-20 bg-white shadow-xl rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="h-10 w-10 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-serif font-black text-slate-900 mb-4">Maaf, kami tidak menemukan berita yang
                            cocok.</h3>
                        <p class="text-slate-500">Coba gunakan kata kunci lain seperti "Teknologi" atau "Ekonomi".</p>
                    </div>
                @endforelse

                <!-- Pagination -->
                <div class="pt-8 text-center">
                    {{ $articles->appends(['q' => $query])->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection