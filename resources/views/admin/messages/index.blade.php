@extends('layouts.admin')

@section('title', 'Manage Messages')

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="px-8 py-6 border-b border-gray-100">
        <h3 class="text-lg font-bold text-gray-900">All Messages</h3>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-gray-50 text-gray-500 text-xs uppercase font-bold">
                <tr>
                    <th class="px-8 py-4">Sender</th>
                    <th class="px-8 py-4">Subject</th>
                    <th class="px-8 py-4">Date</th>
                    <th class="px-8 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($messages as $message)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-8 py-5">
                        <div class="font-bold text-gray-900">{{ $message->name }}</div>
                        <div class="text-sm text-gray-500">{{ $message->email }}</div>
                    </td>
                    <td class="px-8 py-5 text-gray-600">{{ $message->subject ?? 'No Subject' }}</td>
                    <td class="px-8 py-5 text-gray-500 text-sm">{{ $message->created_at->format('M d, Y H:i') }}</td>
                    <td class="px-8 py-5 text-right space-x-2">
                        <a href="{{ route('admin.messages.show', $message) }}" class="inline-block px-4 py-2 bg-blue-50 text-blue-600 rounded-lg text-sm font-bold hover:bg-blue-100 transition">View</a>
                        <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-4 py-2 bg-red-50 text-red-600 rounded-lg text-sm font-bold hover:bg-red-100 transition" onclick="return confirm('Delete this message?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-8 py-20 text-center text-gray-500">
                        No messages found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($messages->hasPages())
    <div class="px-8 py-4 bg-gray-50 border-t border-gray-100">
        {{ $messages->links() }}
    </div>
    @endif
</div>
@endsection
