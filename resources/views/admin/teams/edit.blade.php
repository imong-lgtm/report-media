@extends('layouts.admin')

@section('title', 'Edit Team Member')

@section('content')
<div class="max-w-2xl bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
    <form action="{{ route('admin.teams.update', $team) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')
        <div>
            <label class="block text-sm font-bold text-gray-700 mb-2">Full Name</label>
            <input type="text" name="name" value="{{ $team->name }}" class="w-full px-4 py-3 rounded-2xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition outline-none" required>
        </div>
        <div>
            <label class="block text-sm font-bold text-gray-700 mb-2">Role / Position</label>
            <input type="text" name="role" value="{{ $team->role }}" class="w-full px-4 py-3 rounded-2xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition outline-none" required>
        </div>
        <div>
            <label class="block text-sm font-bold text-gray-700 mb-2">Profile Photo</label>
            @if($team->image)
                <img src="{{ $team->image }}" class="h-20 w-20 rounded-xl object-cover mb-4">
            @endif
            <input type="file" name="image" class="w-full px-4 py-3 rounded-2xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition outline-none">
        </div>
        <div class="flex gap-4 pt-4">
            <button type="submit" class="flex-1 py-4 bg-blue-600 text-white rounded-2xl font-bold hover:bg-blue-700 transition shadow-lg shadow-blue-600/20">
                Update Member
            </button>
            <a href="{{ route('admin.teams.index') }}" class="flex-1 py-4 bg-gray-100 text-center text-gray-700 rounded-2xl font-bold hover:bg-gray-200 transition">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
