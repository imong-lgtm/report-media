@extends('layouts.admin')

@section('title', 'Tambah Kategori')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-8 flex items-center gap-4">
        <a href="{{ route('admin.categories.index') }}" class="h-12 w-12 bg-white rounded-2xl flex items-center justify-center border border-gray-100 text-gray-400 hover:text-blue-600 hover:shadow-lg transition-all">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </a>
        <h2 class="text-2xl font-bold text-gray-900">Tambah Kategori Baru</h2>
    </div>

    <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 p-10">
        <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-8">
            @csrf
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-3 ml-1">Nama Kategori</label>
                <input type="text" name="name" class="w-full px-6 py-4 rounded-2xl border border-gray-100 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all outline-none bg-gray-50/50 font-medium" placeholder="Contoh: Nasional, Internasional, Teknologi..." required autofocus>
                @error('name')
                    <p class="text-red-500 text-xs mt-2 font-bold ml-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-5 rounded-2xl shadow-lg shadow-blue-100 transition-all transform hover:-translate-y-0.5 active:scale-[0.98]">
                Simpan Kategori
            </button>
        </form>
    </div>
</div>
@endsection
