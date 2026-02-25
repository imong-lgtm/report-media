@extends('layouts.admin')

@section('title', 'Kelola Profil Perusahaan')

@section('header', 'Profil Perusahaan')

@section('content')
    <div class="space-y-6">
        @if(session('success'))
            <div
                class="bg-emerald-100 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-xl text-sm font-bold animate-pulse">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data"
            class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            @csrf

            <!-- Identitas Utama -->
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-slate-100 space-y-6">
                    <h3 class="text-lg font-black text-slate-900 flex items-center gap-2">
                        <span class="p-2 bg-blue-50 text-blue-600 rounded-lg">🏢</span>
                        Identitas Utama
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-xs font-black uppercase tracking-widest text-slate-500">Nama
                                Media/Perusahaan</label>
                            <input type="text" name="name" value="{{ old('name', $profile->name) }}" required
                                class="w-full bg-slate-50 border-none rounded-xl px-4 py-3 text-sm font-bold focus:ring-2 focus:ring-blue-500 outline-none">
                        </div>
                        <div class="space-y-2">
                            <label class="text-xs font-black uppercase tracking-widest text-slate-500">Email Kontak</label>
                            <input type="email" name="email" value="{{ old('email', $profile->email) }}"
                                class="w-full bg-slate-50 border-none rounded-xl px-4 py-3 text-sm font-bold focus:ring-2 focus:ring-blue-500 outline-none">
                        </div>
                        <div class="space-y-2">
                            <label class="text-xs font-black uppercase tracking-widest text-slate-500">Nomor Telepon</label>
                            <input type="text" name="phone" value="{{ old('phone', $profile->phone) }}"
                                class="w-full bg-slate-50 border-none rounded-xl px-4 py-3 text-sm font-bold focus:ring-2 focus:ring-blue-500 outline-none">
                        </div>
                        <div class="space-y-2">
                            <label class="text-xs font-black uppercase tracking-widest text-slate-500">Logo (Upload untuk
                                ganti)</label>
                            <input type="file" name="logo_upload"
                                class="w-full bg-slate-50 border-none rounded-xl px-4 py-2 text-xs font-bold focus:ring-2 focus:ring-blue-500 outline-none file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-[10px] file:font-black file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="text-xs font-black uppercase tracking-widest text-slate-500">Alamat Lengkap</label>
                        <textarea name="address" rows="3"
                            class="w-full bg-slate-50 border-none rounded-xl px-4 py-3 text-sm font-bold focus:ring-2 focus:ring-blue-500 outline-none">{{ old('address', $profile->address) }}</textarea>
                    </div>
                </div>

                <!-- Konten Utama -->
                <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-slate-100 space-y-6">
                    <h3 class="text-lg font-black text-slate-900 flex items-center gap-2">
                        <span class="p-2 bg-emerald-50 text-emerald-600 rounded-lg">📜</span>
                        Profil & Dokumentasi
                    </h3>

                    <div class="space-y-6">
                        <div class="space-y-2">
                            <label class="text-xs font-black uppercase tracking-widest text-slate-500">Profil Perusahaan
                                (Tentang Kami)</label>
                            <textarea name="profile" rows="6"
                                class="w-full bg-slate-50 border-none rounded-xl px-4 py-3 text-sm font-bold focus:ring-2 focus:ring-blue-500 outline-none"
                                placeholder="Misi, Visi, dan deskripsi singkat perusahaan...">{{ old('profile', $profile->profile) }}</textarea>
                        </div>
                        <div class="space-y-2">
                            <label class="text-xs font-black uppercase tracking-widest text-slate-500">Kode Etik
                                Jurnalistik</label>
                            <textarea name="ethics" rows="6"
                                class="w-full bg-slate-50 border-none rounded-xl px-4 py-3 text-sm font-bold focus:ring-2 focus:ring-blue-500 outline-none"
                                placeholder="Tuliskan kode etik jurnalistik yang diterapkan...">{{ old('ethics', $profile->ethics) }}</textarea>
                        </div>
                        <div class="space-y-2">
                            <label class="text-xs font-black uppercase tracking-widest text-slate-500">Pedoman Media
                                Siber</label>
                            <textarea name="guidelines" rows="6"
                                class="w-full bg-slate-50 border-none rounded-xl px-4 py-3 text-sm font-bold focus:ring-2 focus:ring-blue-500 outline-none"
                                placeholder="Pedoman pemberitaan media siber...">{{ old('guidelines', $profile->guidelines) }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar Options -->
            <div class="space-y-6">
                <!-- Sosial Media -->
                <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-slate-100 space-y-6">
                    <h3 class="text-lg font-black text-slate-900 flex items-center gap-2">
                        <span class="p-2 bg-pink-50 text-pink-600 rounded-lg">📱</span>
                        Sosial Media
                    </h3>

                    <div class="space-y-4">
                        <div class="space-y-1">
                            <label class="text-[10px] font-black uppercase tracking-tighter text-slate-400">Facebook
                                URL</label>
                            <input type="url" name="facebook" value="{{ old('facebook', $profile->facebook) }}"
                                class="w-full bg-slate-50 border-none rounded-xl px-4 py-2 text-xs font-bold focus:ring-2 focus:ring-blue-500 outline-none">
                        </div>
                        <div class="space-y-1">
                            <label class="text-[10px] font-black uppercase tracking-tighter text-slate-400">Twitter/X
                                URL</label>
                            <input type="url" name="twitter" value="{{ old('twitter', $profile->twitter) }}"
                                class="w-full bg-slate-50 border-none rounded-xl px-4 py-2 text-xs font-bold focus:ring-2 focus:ring-blue-500 outline-none">
                        </div>
                        <div class="space-y-1">
                            <label class="text-[10px] font-black uppercase tracking-tighter text-slate-400">Instagram
                                URL</label>
                            <input type="url" name="instagram" value="{{ old('instagram', $profile->instagram) }}"
                                class="w-full bg-slate-50 border-none rounded-xl px-4 py-2 text-xs font-bold focus:ring-2 focus:ring-blue-500 outline-none">
                        </div>
                        <div class="space-y-1">
                            <label class="text-[10px] font-black uppercase tracking-tighter text-slate-400">YouTube
                                URL</label>
                            <input type="url" name="youtube" value="{{ old('youtube', $profile->youtube) }}"
                                class="w-full bg-slate-50 border-none rounded-xl px-4 py-2 text-xs font-bold focus:ring-2 focus:ring-blue-500 outline-none">
                        </div>
                    </div>
                </div>

                <!-- Preview Logo -->
                <div class="bg-slate-900 p-8 rounded-[2rem] shadow-xl text-center space-y-4">
                    <h4 class="text-white text-xs font-black uppercase tracking-widest">Logo Saat Ini</h4>
                    @if($profile->logo)
                        <img src="{{ $profile->logo }}" class="mx-auto h-20 w-auto object-contain rounded-lg shadow-lg"
                            alt="Current Logo">
                    @else
                        <div
                            class="h-20 w-20 bg-slate-800 rounded-2xl mx-auto flex items-center justify-center text-slate-600 font-bold text-[10px]">
                            NO LOGO</div>
                    @endif
                    <p class="text-slate-400 text-[10px] font-medium italic">Logo ini akan muncul di Header & Footer
                        website.</p>
                </div>

                <!-- Action -->
                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-black uppercase tracking-widest py-5 rounded-[2rem] shadow-xl shadow-blue-200 transition-all hover:scale-[1.02] active:scale-95">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
@endsection