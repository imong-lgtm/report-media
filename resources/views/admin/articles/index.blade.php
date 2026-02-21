@extends('layouts.admin')

@section('title', 'Manajemen Berita')

@section('content')
<div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
    <div class="px-8 py-8 border-b border-gray-50 flex justify-between items-center bg-gradient-to-r from-white to-gray-50/50">
        <div>
            <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Daftar Berita</h2>
            <p class="text-gray-500 text-sm mt-1 font-medium">Kelola konten berita di report.media</p>
        </div>
        <a href="{{ route('admin.articles.create') }}" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-2xl font-bold transition-all shadow-lg shadow-blue-100 hover:-translate-y-0.5">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Tulis Berita
        </a>
    </div>

    @if(session('success'))
    <div class="m-8 p-4 bg-emerald-50 border border-emerald-100 text-emerald-700 rounded-2xl flex items-center gap-3 animate-fade-in">
        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
        <span class="font-bold">{{ session('success') }}</span>
    </div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50/50">
                    <th class="px-8 py-5 text-sm font-bold text-gray-400 uppercase tracking-wider">Judul Berita</th>
                    <th class="px-8 py-5 text-sm font-bold text-gray-400 uppercase tracking-wider">Kategori</th>
                    <th class="px-8 py-5 text-sm font-bold text-gray-400 uppercase tracking-wider">Status</th>
                    <th class="px-8 py-5 text-sm font-bold text-gray-400 uppercase tracking-wider text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @foreach($articles as $article)
                <tr class="hover:bg-gray-50/50 transition-colors group">
                    <td class="px-8 py-6">
                        <div class="flex items-center gap-4">
                            @if($article->image)
                                <img src="{{ asset('storage/' . $article->image) }}" class="h-12 w-12 rounded-xl object-cover border border-gray-100">
                            @else
                                <div class="h-12 w-12 bg-gray-100 rounded-xl border border-dashed border-gray-200 flex items-center justify-center text-gray-400">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                </div>
                            @endif
                            <div>
                                <span class="font-bold text-gray-900 block line-clamp-1">{{ $article->title }}</span>
                                <span class="text-xs text-gray-400 font-medium italic">Oleh {{ $article->user->name }}</span>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-6 text-gray-500 font-medium">
                        <span class="px-3 py-1 bg-blue-50 text-blue-600 rounded-full text-xs font-bold">{{ $article->category->name }}</span>
                    </td>
                    <td class="px-8 py-6">
                        @if($article->status === 'published')
                            <span class="px-2 py-1 bg-emerald-50 text-emerald-600 rounded-lg text-xs font-bold uppercase">Published</span>
                        @else
                            <span class="px-2 py-1 bg-amber-50 text-amber-600 rounded-lg text-xs font-bold uppercase">Draft</span>
                        @endif
                    </td>
                    <td class="px-8 py-6 text-right">
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('admin.articles.edit', $article) }}" class="p-2 text-gray-400 hover:text-blue-600 hover:bg-blue-50 rounded-xl transition-all">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            </a>
                            <form action="{{ route('admin.articles.destroy', $article) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus berita ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-xl transition-all">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
