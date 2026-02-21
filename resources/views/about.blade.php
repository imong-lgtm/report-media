@extends('layouts.app')

@section('title', 'Tentang Kami')

@section('content')
<div class="bg-white">
    <!-- About Header -->
    <div class="py-16 sm:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:text-center">
                <h2 class="text-base text-blue-600 font-semibold tracking-wide uppercase">Tentang report.media</h2>
                <p class="mt-2 text-4xl leading-10 font-extrabold tracking-tight text-gray-900 sm:text-5xl font-serif">
                    Laporan Mendalam, Investigasi Tajam
                </p>
                <p class="mt-4 max-w-3xl text-xl text-gray-500 lg:mx-auto">
                    Kami hadir untuk menyajikan informasi yang tidak hanya cepat, tapi juga akurat dan berimbang untuk masyarakat Indonesia.
                </p>
            </div>
        </div>
    </div>

    <!-- Mission & Vision -->
    <div class="bg-slate-50 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            <div class="relative">
                <div class="absolute -top-4 -left-4 w-24 h-24 bg-blue-100 rounded-3xl -z-10"></div>
                <img class="rounded-[2.5rem] shadow-2xl relative" src="https://images.unsplash.com/photo-1504715603422-59e1b7987e3f?auto=format&fit=crop&w=800&q=80" alt="World News">
            </div>
            <div class="space-y-6">
                <h3 class="text-3xl font-serif font-black text-gray-900">Misi Kami</h3>
                <p class="text-lg text-gray-600 leading-relaxed">
                    Didirikan pada tahun 2026, **report.media** lahir dari kegelisahan akan banjirnya informasi yang dangkal. Misi kami adalah mengembalikan marwah jurnalisme dengan investigasi yang mendalam dan pelaporan yang mengedukasi publik.
                </p>
                <h3 class="text-3xl font-serif font-black text-gray-900 pt-4">Visi Kami</h3>
                <p class="text-lg text-gray-600 leading-relaxed">
                    Menjadi referensi utama berita terpercaya di tanah air yang menjunjung tinggi kode etik jurnalistik dan transparansi informasi.
                </p>
            </div>
        </div>
    </div>

    <!-- Editorial Section -->
    <div class="py-16 sm:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-serif font-black text-gray-100 bg-slate-900 inline-block px-8 py-3 rounded-2xl">Dewan Redaksi</h2>
                <p class="mt-4 text-lg text-gray-500">Mata dan telinga kami di garis depan informasi.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-[2rem] border border-slate-100 shadow-sm hover:shadow-xl transition-all">
                    <div class="h-20 w-20 bg-blue-600 rounded-2xl flex items-center justify-center text-white mb-6">
                        <svg class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    </div>
                    <h4 class="text-xl font-bold mb-2">Editor-in-Chief</h4>
                    <p class="text-slate-500 text-sm italic">Bertanggung jawab atas seluruh kebijakan redaksi dan kualitas konten report.media.</p>
                </div>
                <div class="bg-white p-8 rounded-[2rem] border border-slate-100 shadow-sm hover:shadow-xl transition-all">
                    <div class="h-20 w-20 bg-slate-900 rounded-2xl flex items-center justify-center text-white mb-6">
                        <svg class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                    <h4 class="text-xl font-bold mb-2">Tim Investigasi</h4>
                    <p class="text-slate-500 text-sm italic">Unit khusus yang mengungkap fakta di balik layar dan isu-isu krusial nasional.</p>
                </div>
                <div class="bg-white p-8 rounded-[2rem] border border-slate-100 shadow-sm hover:shadow-xl transition-all">
                    <div class="h-20 w-20 bg-blue-500 rounded-2xl flex items-center justify-center text-white mb-6">
                        <svg class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h4 class="text-xl font-bold mb-2">Ekonomi & Bisnis</h4>
                    <p class="text-slate-500 text-sm italic">Menyajikan analisis pasar dan pergerakan ekonomi terkini secara tajam.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
