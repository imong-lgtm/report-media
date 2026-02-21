<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setup Superadmin - Telecom Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 min-h-screen flex items-center justify-center p-6">
    <div class="max-w-md w-full bg-white rounded-[2rem] shadow-2xl shadow-blue-100 p-10 border border-slate-100">
        <div class="text-center mb-10">
            <div class="h-20 w-20 bg-blue-600 rounded-3xl flex items-center justify-center mx-auto mb-6 shadow-xl shadow-blue-200 rotate-3">
                <svg class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Setup Superadmin</h1>
            <p class="text-slate-500 mt-2 font-medium">Konfigurasi akun pengelola utama</p>
        </div>

        @if(session('error'))
        <div class="bg-red-50 border border-red-100 text-red-600 px-4 py-3 rounded-2xl mb-8 text-sm font-medium">
            {{ session('error') }}
        </div>
        @endif

        @if(session('success'))
        <div class="bg-emerald-50 border border-emerald-100 text-emerald-600 px-4 py-3 rounded-2xl mb-8 text-sm font-medium">
            {!! session('success') !!}
        </div>
        @endif

        <form action="{{ url('/setup-admin') }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2 ml-1">Email Superadmin</label>
                <input type="email" name="email" class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all outline-none bg-slate-50/50" placeholder="admin@telecom.test" required>
            </div>

            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2 ml-1">Password</label>
                <input type="password" name="password" class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all outline-none bg-slate-50/50" placeholder="Minimal 8 karakter" required>
            </div>

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-5 rounded-2xl shadow-lg shadow-blue-200 transition-all transform hover:-translate-y-0.5 active:scale-[0.98]">
                Install & Create Account
            </button>
        </form>

        <p class="text-center mt-8 text-sm text-slate-400 font-medium italic">
            *Proses ini akan menjalankan migrasi database otomatis.
        </p>
    </div>
</body>
</html>
