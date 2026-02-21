@extends('layouts.admin')

@section('title', 'Tulis Berita')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-8 flex items-center gap-4">
        <a href="{{ route('admin.articles.index') }}" class="h-12 w-12 bg-white rounded-2xl flex items-center justify-center border border-gray-100 text-gray-400 hover:text-blue-600 hover:shadow-lg transition-all">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </a>
        <h2 class="text-2xl font-bold text-gray-900">Tulis Berita Baru</h2>
    </div>

    <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 p-10">
        <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="md:col-span-2">
                    <label class="block text-sm font-bold text-gray-700 mb-3 ml-1">Judul Berita</label>
                    <input type="text" name="title" class="w-full px-6 py-4 rounded-2xl border border-gray-100 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all outline-none bg-gray-50/50 font-bold text-lg" placeholder="Masukkan judul berita yang menarik..." required autofocus>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-3 ml-1">Kategori</label>
                    <select name="category_id" class="w-full px-6 py-4 rounded-2xl border border-gray-100 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all outline-none bg-gray-50/50 font-medium" required>
                        <option value="">Pilih Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-3 ml-1">Status Publikasi</label>
                    <select name="status" class="w-full px-6 py-4 rounded-2xl border border-gray-100 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all outline-none bg-gray-50/50 font-medium" required>
                        <option value="draft">Simpan sebagai Draft</option>
                        <option value="published">Publikasikan Langsung</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-3 ml-1">Gambar Unggulan</label>
                <div class="relative group">
                    <input type="file" name="image" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                    <div class="w-full px-6 py-10 rounded-[2rem] border-2 border-dashed border-gray-100 group-hover:border-blue-200 bg-gray-50/50 group-hover:bg-blue-50/30 transition-all flex flex-col items-center justify-center text-center">
                        <div class="h-16 w-16 bg-white rounded-2xl shadow-sm flex items-center justify-center mb-4 text-gray-400 group-hover:text-blue-500 transition-colors">
                            <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                        <p class="text-gray-500 font-bold">Klik atau seret gambar ke sini</p>
                        <p class="text-gray-400 text-xs mt-1 font-medium italic">JPG, PNG atau WebP (Max. 2MB)</p>
                    </div>
                </div>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-3 ml-1">Isi Berita</label>
                <textarea name="content" rows="15" class="w-full px-6 py-6 rounded-[2rem] border border-gray-100 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all outline-none bg-gray-50/50 font-medium leading-relaxed" placeholder="Tuliskan isi berita selengkapnya di sini..." required></textarea>
            </div>

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-6 rounded-[2rem] shadow-xl shadow-blue-100 transition-all transform hover:-translate-y-1 active:scale-[0.98] text-lg">
                Simpan & Rilis Berita
            </button>
        </form>
    </div>
</div>
@endsection
