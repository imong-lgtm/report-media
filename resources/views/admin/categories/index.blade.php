@extends('layouts.admin')

@section('title', 'Kategori Berita')

@section('content')
<div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
    <div class="px-8 py-8 border-b border-gray-50 flex justify-between items-center bg-gradient-to-r from-white to-gray-50/50">
        <div>
            <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Kategori Berita</h2>
            <p class="text-gray-500 text-sm mt-1 font-medium">Kelola kategori untuk pengelompokan berita</p>
        </div>
        <a href="{{ route('admin.categories.create') }}" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-2xl font-bold transition-all shadow-lg shadow-blue-100 hover:-translate-y-0.5">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Tambah Kategori
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
                    <th class="px-8 py-5 text-sm font-bold text-gray-400 uppercase tracking-wider">Nama Kategori</th>
                    <th class="px-8 py-5 text-sm font-bold text-gray-400 uppercase tracking-wider">Slug</th>
                    <th class="px-8 py-5 text-sm font-bold text-gray-400 uppercase tracking-wider text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @foreach($categories as $category)
                <tr class="hover:bg-gray-50/50 transition-colors group">
                    <td class="px-8 py-6">
                        <span class="font-bold text-gray-900">{{ $category->name }}</span>
                    </td>
                    <td class="px-8 py-6 text-gray-500 font-medium">{{ $category->slug }}</td>
                    <td class="px-8 py-6 text-right">
                        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus kategori ini? Semua berita di dalamnya akan ikut terhapus.')">
                            @csrf
                            @method('DELETE')
                            <button class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-xl transition-all">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
