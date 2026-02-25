@extends('layouts.admin')

@section('title', 'Edit Administrator')

@section('content')
    <div class="mb-6">
        <a href="{{ route('admin.users.index') }}" class="text-blue-600 font-bold hover:underline">← Back to
            Administrators</a>
    </div>

    <div class="max-w-2xl bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
        <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Full Name</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                    class="w-full px-4 py-3 rounded-2xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition outline-none @error('name') border-red-500 @enderror"
                    placeholder="e.g. John Doe" required>
                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Access Level (Role)</label>
                <select name="role"
                    class="w-full px-4 py-3 rounded-2xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition outline-none"
                    required>
                    <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin (Content Manager)
                    </option>
                    <option value="superadmin" {{ old('role', $user->role) == 'superadmin' ? 'selected' : '' }}>Superadmin
                        (Full Access)</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Email Address</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}"
                    class="w-full px-4 py-3 rounded-2xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition outline-none @error('email') border-red-500 @enderror"
                    placeholder="admin@example.com" required>
                @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="p-6 bg-blue-50 rounded-2xl border border-blue-100 mb-4">
                <p class="text-sm font-semibold text-blue-800">🔒 Change Password (Optional)</p>
                <p class="text-xs text-blue-600 mt-1">Leave these fields blank if you don't want to change the password.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">New Password</label>
                    <input type="password" name="password"
                        class="w-full px-4 py-3 rounded-2xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition outline-none @error('password') border-red-500 @enderror"
                        placeholder="••••••••">
                    @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Confirm New Password</label>
                    <input type="password" name="password_confirmation"
                        class="w-full px-4 py-3 rounded-2xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition outline-none"
                        placeholder="••••••••">
                </div>
            </div>

            <div class="pt-4">
                <button type="submit"
                    class="w-full py-4 bg-blue-600 text-white rounded-2xl font-bold hover:bg-blue-700 transition shadow-lg shadow-blue-600/20 active:scale-[0.98]">
                    Update Administrator Account
                </button>
            </div>
        </form>
    </div>
@endsection