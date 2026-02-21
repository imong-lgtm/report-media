@extends('layouts.app')

@section('title', 'Hubungi Kami')

@section('content')
<div class="bg-white py-16 sm:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-lg mx-auto md:max-w-none md:grid md:grid-cols-2 md:gap-16 items-start">
            <div class="flex flex-col justify-between h-full">
                <div>
                    <h2 class="text-4xl font-serif font-black text-gray-900 tracking-tight sm:text-5xl">
                        Kirim Informasi & Tips
                    </h2>
                    <p class="mt-6 text-xl text-gray-500 leading-relaxed font-medium">
                        Punya informasi penting atau tips berita? Tim redaksi kami siap mendengarkan laporan Anda secara rahasia dan profesional.
                    </p>
                </div>
                
                <div class="mt-12 space-y-8">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 p-3 bg-blue-50 rounded-xl text-blue-600">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h4 class="text-lg font-bold text-gray-900">News Desk</h4>
                            <p class="mt-1 text-gray-500">(021) 555-1234</p>
                            <p class="text-sm text-gray-400">Tersedia Senin-Jumat, 09:00 - 18:00 WIB</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="flex-shrink-0 p-3 bg-blue-50 rounded-xl text-blue-600">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h4 class="text-lg font-bold text-gray-900">Email Redaksi</h4>
                            <p class="mt-1 text-gray-500">redaksi@report.media</p>
                            <p class="text-sm text-gray-400">Respon cepat dalam 24 jam</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="flex-shrink-0 p-3 bg-blue-50 rounded-xl text-blue-600">
                            <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h4 class="text-lg font-bold text-gray-900">Kantor Kami</h4>
                            <p class="mt-1 text-gray-500">Jl. Jurnalisme No. 8, Senayan</p>
                            <p class="text-sm text-gray-400">Jakarta Pusat, Indonesia</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-12 sm:mt-16 md:mt-0">
                <form action="{{ route('contact.store') }}" method="POST" class="bg-white p-10 shadow-2xl rounded-[2.5rem] border border-gray-100 space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-sm font-bold text-gray-700 mb-2">Nama Lengkap</label>
                            <input type="text" name="name" id="name" class="block w-full px-5 py-4 bg-gray-50 border-transparent focus:bg-white focus:ring-4 focus:ring-blue-100 focus:border-blue-500 rounded-2xl transition-all outline-none font-medium" placeholder="Nama Anda" required>
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-bold text-gray-700 mb-2">Email</label>
                            <input type="email" name="email" id="email" class="block w-full px-5 py-4 bg-gray-50 border-transparent focus:bg-white focus:ring-4 focus:ring-blue-100 focus:border-blue-500 rounded-2xl transition-all outline-none font-medium" placeholder="email@anda.com" required>
                        </div>
                    </div>
                    <div>
                        <label for="subject" class="block text-sm font-bold text-gray-700 mb-2">Subjek</label>
                        <input type="text" name="subject" id="subject" class="block w-full px-5 py-4 bg-gray-50 border-transparent focus:bg-white focus:ring-4 focus:ring-blue-100 focus:border-blue-500 rounded-2xl transition-all outline-none font-medium" placeholder="Tentang berita/aduan">
                    </div>
                    <div>
                        <label for="message" class="block text-sm font-bold text-gray-700 mb-2">Pesan / Tips Berita</label>
                        <textarea id="message" name="message" rows="4" class="block w-full px-5 py-4 bg-gray-50 border-transparent focus:bg-white focus:ring-4 focus:ring-blue-100 focus:border-blue-500 rounded-2xl transition-all outline-none font-medium leading-relaxed" placeholder="Tuliskan pesan atau tips berita Anda di sini..." required></textarea>
                    </div>
                    <div>
                        <button type="submit" class="w-full py-5 px-6 border border-transparent shadow-xl shadow-blue-100 text-lg font-bold rounded-2xl text-white bg-blue-600 hover:bg-blue-700 hover:-translate-y-1 focus:outline-none focus:ring-4 focus:ring-blue-100 transition-all duration-300 transform active:scale-[0.98]">
                            Kirim ke Redaksi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
