@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
        <p class="text-sm font-medium text-gray-500 uppercase tracking-widest mb-1">Services</p>
        <p class="text-3xl font-extrabold text-gray-900">{{ $stats['services'] }}</p>
    </div>
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
        <p class="text-sm font-medium text-gray-500 uppercase tracking-widest mb-1">Projects</p>
        <p class="text-3xl font-extrabold text-gray-900">{{ $stats['projects'] }}</p>
    </div>
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
        <p class="text-sm font-medium text-gray-500 uppercase tracking-widest mb-1">Team Members</p>
        <p class="text-3xl font-extrabold text-gray-900">{{ $stats['teams'] }}</p>
    </div>
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
        <p class="text-sm font-medium text-gray-500 uppercase tracking-widest mb-1">Unread Messages</p>
        <p class="text-3xl font-extrabold text-gray-900">{{ $stats['messages'] }}</p>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="px-8 py-6 border-b border-gray-100 flex justify-between items-center">
        <h3 class="text-lg font-bold text-gray-900">Recent Messages</h3>
        <a href="{{ route('admin.messages.index') }}" class="text-sm font-bold text-blue-600 hover:text-blue-700 transition">View All Messages</a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-gray-50 text-gray-500 text-xs uppercase font-bold">
                <tr>
                    <th class="px-8 py-4">From</th>
                    <th class="px-8 py-4">Subject</th>
                    <th class="px-8 py-4">Date</th>
                    <th class="px-8 py-4">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($latestMessages as $message)
                <tr>
                    <td class="px-8 py-5">
                        <div class="font-bold text-gray-900">{{ $message->name }}</div>
                        <div class="text-sm text-gray-500">{{ $message->email }}</div>
                    </td>
                    <td class="px-8 py-5 text-gray-600">{{ $message->subject ?? 'No Subject' }}</td>
                    <td class="px-8 py-5 text-gray-500 text-sm">{{ $message->created_at->format('M d, Y') }}</td>
                    <td class="px-8 py-5">
                        <a href="{{ route('admin.messages.show', $message) }}" class="inline-block px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm font-bold hover:bg-gray-200 transition">View</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-8 py-10 text-center text-gray-500">No messages found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
