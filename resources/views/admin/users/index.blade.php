@extends('layouts.admin')

@section('title', 'Manage Administrators')

@section('content')
    <div class="mb-8 flex justify-between items-center">
        <div>
            <h3 class="text-2xl font-extrabold text-gray-900 tracking-tight">System Administrators</h3>
            <p class="text-gray-500 font-medium">Manage users who have access to this dashboard.</p>
        </div>
        <a href="{{ route('admin.users.create') }}"
            class="px-6 py-3 bg-blue-600 text-white rounded-2xl font-bold hover:bg-blue-700 transition shadow-lg shadow-blue-600/20 flex items-center gap-2">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
            Add New Admin
        </a>
    </div>

    @if(session('error'))
        <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-r-xl">
            <p class="text-sm text-red-700 font-medium">{{ session('error') }}</p>
        </div>
    @endif

    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden text-sm md:text-base">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead
                    class="bg-gray-50 text-gray-500 text-xs uppercase font-bold tracking-widest border-b border-gray-100">
                    <tr>
                        <th class="px-8 py-5">Administrator</th>
                        <th class="px-8 py-5">Role</th>
                        <th class="px-8 py-5">Email Address</th>
                        <th class="px-8 py-5 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 italic-none">
                    @foreach($users as $user)
                        <tr class="hover:bg-gray-50/50 transition">
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold uppercase">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <div class="font-bold text-gray-900">{{ $user->name }}</div>
                                        @if($user->id === auth()->id())
                                            <span
                                                class="text-[10px] bg-blue-600 text-white px-2 py-0.5 rounded-full font-bold">YOU</span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <span
                                    class="px-3 py-1 rounded-full text-xs font-bold uppercase {{ $user->role === 'superadmin' ? 'bg-purple-100 text-purple-700' : 'bg-gray-100 text-gray-600' }}">
                                    {{ $user->role }}
                                </span>
                            </td>
                            <td class="px-8 py-6 text-gray-600 font-medium">{{ $user->email }}</td>
                            <td class="px-8 py-6 text-gray-500 text-sm italic">{{ $user->created_at->format('M d, Y') }}</td>
                            <td class="px-8 py-6 text-right flex justify-end items-center gap-2">
                                <a href="{{ route('admin.users.edit', $user) }}"
                                    class="p-2 text-blue-400 hover:text-blue-600 transition">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>
                                @if($user->id !== auth()->id())
                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-red-400 hover:text-red-600 transition"
                                            onclick="return confirm('Remove admin access for {{ $user->name }}?')">
                                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection