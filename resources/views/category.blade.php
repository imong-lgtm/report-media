@extends('layouts.app')

@section('title', 'Kategori: ' . $category->name)

@section('content')
    <div class="bg-white py-12">
        <div class="container mx-auto px-4">
            <!-- Breadcrumbs & Title -->
            <div class="mb-12 border-b border-slate-100 pb-8">
                <nav class="flex text-xs font-bold uppercase tracking-widest text-slate-400 mb-4 gap-2">
                    <a href="{{ route('home') }}" class="hover:text-blue-600">Home</a>
                    <span>/</span>
                    <span class="text-blue-600">{{ $category->name }}</span>
                </nav>
                <h1 class="text-5xl font-serif font-black text-slate-900 tracking-tighter">
                    Kategori: <span class="text-blue-600">{{ $category->name }}</span>
                </h1>
                <p class="mt-4 text-slate-500 font-medium">Menampilkan berita terbaru dalam topik {{ $category->name }}</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-16">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-12">
                    @forelse($articles as $article)
                        <article
                            class="group flex flex-col md:flex-row gap-8 pb-12 border-b border-slate-100 last:border-0 hover-lift">
                            <div
                                class="w-full md:w-64 h-44 rounded-2xl overflow-hidden flex-shrink-0 shadow-lg shadow-slate-100">
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
                            <h3 class="text-2xl font-serif font-black text-slate-400">Belum ada berita di kategori ini.</h3>
                        </div>
                    @endforelse

                    <!-- Pagination -->
                    <div class="pt-8">
                        {{ $articles->links() }}
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-12">
                    <!-- Search Box -->
                    <div class="bg-slate-950 p-8 rounded-[2.5rem] text-white">
                        <h4 class="text-lg font-serif font-black mb-6">Cari Berita</h4>
                        <form action="#" class="relative">
                            <input type="text" placeholder="Masukkan kata kunci..."
                                class="w-full bg-slate-800 border-none rounded-2xl py-4 flex pl-12 pr-4 text-sm font-bold focus:ring-2 focus:ring-blue-500 outline-none text-white transition-all">
                            <svg class="h-5 w-5 absolute left-4 top-4 text-slate-500" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </form>
                    </div>

                    <!-- Categories List -->
                    <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-100/50">
                        <h4 class="text-lg font-serif font-black mb-8 border-b border-slate-50 pb-4">Kategori Lainnya</h4>
                        <div class="flex flex-col gap-4">
                            @foreach($categoriesWithArticles as $c)
                                <a href="{{ route('category.show', $c->slug) }}"
                                    class="flex justify-between items-center group p-4 rounded-2xl hover:bg-blue-50 transition-all {{ $category->id == $c->id ? 'bg-blue-50 shadow-sm' : '' }}">
                                    <span
                                        class="font-bold text-sm {{ $category->id == $c->id ? 'text-blue-600' : 'text-slate-600' }} group-hover:text-blue-600 transition-colors">{{ $c->name }}</span>
                                    <span
                                        class="px-2.5 py-1 bg-slate-100 rounded-lg text-[10px] font-black {{ $category->id == $c->id ? 'bg-blue-600 text-white' : 'text-slate-400' }} group-hover:bg-blue-600 group-hover:text-white transition-all">
                                        {{ $c->articles_count }}
                                    </span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection