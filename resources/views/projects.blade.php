@extends('layouts.app')

@section('content')
<div class="bg-white py-16 sm:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-base text-blue-600 font-semibold tracking-wide uppercase">Portfolio</h2>
            <p class="mt-2 text-4xl font-extrabold text-gray-900 sm:text-5xl">Our Projects</p>
            <p class="mt-4 max-w-2xl text-xl text-gray-500 mx-auto">
                Discover how we've helped our clients transform their communication infrastructure and bridge digital divides.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
            @forelse($projects as $project)
            <div class="group bg-gray-50 rounded-3xl overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 border border-gray-100 flex flex-col h-full">
                <div class="relative overflow-hidden h-64">
                    <img src="{{ $project->image }}" alt="{{ $project->title }}" class="object-cover w-full h-full group-hover:scale-110 transition-transform duration-700">
                    <div class="absolute inset-0 bg-blue-600/10 group-hover:bg-transparent transition-colors duration-300"></div>
                </div>
                <div class="p-8 flex-1 flex flex-col">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-sm font-bold text-blue-600 uppercase tracking-widest">{{ $project->client }}</span>
                        <span class="text-xs font-medium text-gray-400">{{ date('M Y', strtotime($project->completion_date)) }}</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">{{ $project->title }}</h3>
                    <p class="text-gray-600 text-lg leading-relaxed flex-1">{{ $project->description }}</p>
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <a href="{{ route('contact') }}" class="inline-flex items-center text-blue-600 font-bold hover:text-blue-700 transition">
                            Project Details <svg class="ml-2 w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-3 text-center py-20 bg-gray-50 rounded-3xl">
                <h3 class="text-2xl font-bold text-gray-900">No projects yet</h3>
                <p class="mt-2 text-gray-500">We're currently working on exciting new ventures. Stay tuned!</p>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
