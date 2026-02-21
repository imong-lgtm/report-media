@extends('layouts.app')

@section('title', $article->title)

@section('content')
<main class="container mx-auto px-6 py-12">
    <div class="max-w-4xl mx-auto">
        <!-- Breadcrumb & Category -->
        <div class="flex items-center gap-4 mb-8">
            <span class="px-4 py-1.5 bg-blue-50 text-blue-600 rounded-full text-xs font-bold uppercase tracking-widest">{{ $article->category->name }}</span>
            <span class="text-slate-300 text-sm">/</span>
            <span class="text-slate-400 text-sm font-medium">{{ $article->created_at->format('d M Y') }}</span>
        </div>

        <!-- Title -->
        <h1 class="text-4xl md:text-6xl font-serif font-black leading-tight text-slate-900 mb-10">
            {{ $article->title }}
        </h1>

        <!-- Author Info -->
        <div class="flex items-center justify-between py-8 border-y border-slate-100 mb-12">
            <div class="flex items-center gap-4">
                <div class="h-12 w-12 rounded-full bg-slate-900 flex items-center justify-center text-white font-black text-sm">RM</div>
                <div>
                    <h5 class="font-bold text-slate-900 leading-none mb-1">Redaksi report.media</h5>
                    <p class="text-slate-400 text-xs font-medium uppercase tracking-wider">Reporter Lapangan &bullet; Jakarta</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <button class="h-10 w-10 rounded-full border border-slate-200 flex items-center justify-center hover:bg-slate-50 transition text-slate-500">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/></svg>
                </button>
                <button class="h-10 w-10 rounded-full border border-slate-200 flex items-center justify-center hover:bg-slate-50 transition text-slate-500">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/></svg>
                </button>
            </div>
        </div>

        <!-- Article Image -->
        @if($article->image)
        <figure class="mb-12 rounded-[2.5rem] overflow-hidden shadow-2xl shadow-blue-100">
            <img src="{{ asset('storage/' . $article->image) }}" class="w-full h-auto object-cover" alt="{{ $article->title }}">
            @if($article->caption)
                <figcaption class="px-6 py-4 bg-slate-50 text-slate-400 text-xs font-medium italic border-t border-slate-100">
                    {{ $article->caption }}
                </figcaption>
            @endif
        </figure>
        @endif

        <!-- Content -->
        <article class="prose prose-slate prose-lg max-w-none prose-headings:font-serif prose-headings:font-black prose-a:text-blue-600 font-medium leading-relaxed text-slate-700">
            {!! nl2br(e($article->content)) !!}
        </article>

        <!-- Tags / Footer Article -->
        <div class="mt-20 pt-10 border-t border-slate-100">
            <h4 class="font-bold text-slate-900 mb-6 uppercase tracking-widest text-xs">Bagikan Berita Ini</h4>
            <div class="flex gap-4">
                <button class="flex-1 py-4 bg-blue-600 text-white rounded-2xl font-bold hover:bg-blue-700 shadow-lg shadow-blue-100 transition">Facebook</button>
                <button class="flex-1 py-4 bg-slate-900 text-white rounded-2xl font-bold hover:bg-slate-800 transition">Twitter (X)</button>
                <button class="flex-1 py-4 bg-emerald-600 text-white rounded-2xl font-bold hover:bg-emerald-700 shadow-lg shadow-emerald-100 transition">WhatsApp</button>
            </div>
        </div>

        <!-- Related Articles -->
        @if($relatedArticles->count() > 0)
        <section class="mt-24">
            <h3 class="text-3xl font-serif font-black mb-10 flex items-center gap-4">
                Berita Terkait
                <span class="flex-1 h-px bg-slate-100"></span>
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($relatedArticles as $rel)
                <div class="group">
                    <div class="aspect-video rounded-2xl overflow-hidden mb-4 bg-slate-100">
                        <img src="{{ $rel->image ? asset('storage/' . $rel->image) : 'https://images.unsplash.com/photo-1504715603422-59e1b7987e3f?q=80&w=2070&auto=format&fit=crop' }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                    </div>
                    <a href="{{ route('articles.show', $rel->slug) }}">
                        <h4 class="font-bold text-slate-900 leading-tight group-hover:text-blue-600 transition">{{ $rel->title }}</h4>
                    </a>
                </div>
                @endforeach
            </div>
        </section>
        @endif
    </div>
</main>
@endsection
