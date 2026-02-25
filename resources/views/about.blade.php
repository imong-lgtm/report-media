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
                        Kami hadir untuk menyajikan informasi yang tidak hanya cepat, tapi juga akurat dan berimbang untuk
                        masyarakat Indonesia.
                    </p>
                </div>
            </div>
        </div>

        <!-- Mission & Vision -->
        <div class="bg-slate-50 py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div class="relative">
                    <div class="absolute -top-4 -left-4 w-24 h-24 bg-blue-100 rounded-3xl -z-10"></div>
                    <img class="rounded-[2.5rem] shadow-2xl relative"
                        src="https://images.unsplash.com/photo-1504715603422-59e1b7987e3f?auto=format&fit=crop&w=800&q=80"
                        alt="World News">
                </div>
                <div class="space-y-6">
                    <h3 class="text-3xl font-serif font-black text-gray-900">Misi Kami</h3>
                    <p class="text-lg text-gray-600 leading-relaxed">
                        Didirikan pada tahun 2026, **report.media** lahir dari kegelisahan akan banjirnya informasi yang
                        dangkal. Misi kami adalah mengembalikan marwah jurnalisme dengan investigasi yang mendalam dan
                        pelaporan yang mengedukasi publik.
                    </p>
                    <h3 class="text-3xl font-serif font-black text-gray-900 pt-4">Visi Kami</h3>
                    <p class="text-lg text-gray-600 leading-relaxed">
                        Menjadi referensi utama berita terpercaya di tanah air yang menjunjung tinggi kode etik jurnalistik
                        dan transparansi informasi.
                    </p>
                </div>
            </div>
        </div>

        <!-- Editorial Section -->
        <div class="py-16 sm:py-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2
                        class="text-3xl font-serif font-black text-gray-100 bg-slate-900 inline-block px-8 py-3 rounded-2xl">
                        Dewan Redaksi</h2>
                    <p class="mt-4 text-lg text-gray-500">Mata dan telinga kami di garis depan informasi.</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                    @forelse($teams as $member)
                        <div
                            class="group bg-white p-6 rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-xl transition-all text-center">
                            <div class="relative mb-6 inline-block">
                                <div
                                    class="absolute inset-0 bg-blue-100 rounded-3xl rotate-6 group-hover:rotate-12 transition-transform">
                                </div>
                                <img src="{{ $member->image ?? 'https://ui-avatars.com/api/?name=' . urlencode($member->name) . '&background=random' }}"
                                    class="h-32 w-32 rounded-3xl object-cover relative group-hover:-translate-y-2 transition-transform shadow-lg"
                                    alt="{{ $member->name }}">
                            </div>
                            <h4 class="text-xl font-bold text-slate-900 mb-1">{{ $member->name }}</h4>
                            <p class="text-blue-600 font-bold text-sm uppercase tracking-wider mb-3">{{ $member->role }}</p>
                            <p class="text-slate-500 text-sm italic line-clamp-2">{{ $member->bio }}</p>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-10 bg-slate-50 rounded-3xl">
                            <p class="text-slate-400 font-medium">Tim redaksi sedang disiapkan.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection