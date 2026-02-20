@extends('layouts.admin')

@section('title', 'View Message')

@section('content')
<div class="max-w-4xl">
    <div class="mb-6">
        <a href="{{ route('admin.messages.index') }}" class="text-blue-600 font-bold hover:underline">← Back to Messages</a>
    </div>

    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-8 py-6 border-b border-gray-100 flex justify-between items-center">
            <div>
                <h3 class="text-xl font-bold text-gray-900">{{ $message->subject ?? 'No Subject' }}</h3>
                <p class="text-sm text-gray-500">Received on {{ $message->created_at->format('M d, Y \a\t H:i') }}</p>
            </div>
            <form action="{{ route('admin.messages.destroy', $message) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-6 py-2 bg-red-50 text-red-600 rounded-xl text-sm font-bold hover:bg-red-100 transition" onclick="return confirm('Are you sure?')">Delete Message</button>
            </form>
        </div>
        <div class="p-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8 pb-8 border-b border-gray-100">
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">From</label>
                    <p class="text-lg font-bold text-gray-900">{{ $message->name }}</p>
                    <p class="text-blue-600">{{ $message->email }}</p>
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Contact Status</label>
                    <span class="inline-block px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-bold">Incoming Query</span>
                </div>
            </div>
            
            <div>
                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-3">Message Body</label>
                <div class="bg-gray-50 p-6 rounded-2xl text-gray-700 leading-relaxed whitespace-pre-wrap">{{ $message->message }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
