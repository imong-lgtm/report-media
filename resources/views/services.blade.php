@extends('layouts.app')

@section('content')
<div class="bg-white py-16 sm:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-base text-blue-600 font-semibold tracking-wide uppercase">Solutions</h2>
            <p class="mt-2 text-4xl font-extrabold text-gray-900 sm:text-5xl">Our Expert Services</p>
            <p class="mt-4 max-w-2xl text-xl text-gray-500 mx-auto">
                Comprehensive telecommunications solutions tailored to drive your business forward.
            </p>
        </div>

        <div class="grid gap-10 grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
            @forelse($services as $service)
            <div class="flex flex-col rounded-3xl shadow-sm bg-gray-50 overflow-hidden transition-all duration-300 hover:shadow-2xl hover:-translate-y-2 border border-gray-100">
                <div class="flex-shrink-0 relative group">
                    <img class="h-56 w-full object-cover grayscale group-hover:grayscale-0 transition-all duration-500" src="{{ $service->image ?? 'https://images.unsplash.com/photo-1519389950473-47ba0277781c?auto=format&fit=crop&w=1350&q=80' }}" alt="{{ $service->title }}">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-6">
                        <span class="text-white font-semibold">Learn More &rarr;</span>
                    </div>
                </div>
                <div class="flex-1 p-8 flex flex-col justify-between">
                    <div class="flex-1">
                        <div class="flex items-center justify-between mb-4">
                            <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                Enterprise
                            </span>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">{{ $service->title }}</h3>
                        <p class="text-lg text-gray-600 leading-relaxed">{{ $service->description }}</p>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-3 text-center py-20 bg-gray-50 rounded-3xl">
                <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
                <h3 class="mt-4 text-xl font-bold text-gray-900">No services found</h3>
                <p class="mt-2 text-gray-500">Check back later or contact us for custom solutions.</p>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
