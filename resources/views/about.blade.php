@extends('layouts.app')

@section('content')
<div class="bg-white">
    <!-- About Header -->
    <div class="py-16 sm:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:text-center">
                <h2 class="text-base text-blue-600 font-semibold tracking-wide uppercase">About Us</h2>
                <p class="mt-2 text-4xl leading-10 font-extrabold tracking-tight text-gray-900 sm:text-5xl">
                    Connecting People, Empowering Businesses
                </p>
                <p class="mt-4 max-w-3xl text-xl text-gray-500 lg:mx-auto">
                    TelecomProfile has been a leader in the telecommunications industry for over 20 years, providing innovative solutions that keep the world connected.
                </p>
            </div>
        </div>
    </div>

    <!-- Mission & Vision -->
    <div class="bg-gray-50 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            <div>
                <img class="rounded-3xl shadow-2xl" src="https://images.unsplash.com/photo-1573161158365-59b832b0d2f1?auto=format&fit=crop&w=800&q=80" alt="Team collaborating">
            </div>
            <div class="space-y-6">
                <h3 class="text-3xl font-bold text-gray-900">Our Mission</h3>
                <p class="text-lg text-gray-600">
                    Founded in 2005, TelecomProfile started with a simple mission: to make high-quality communication accessible to everyone. Today, we serve millions of customers across the globe, providing reliable voice, data, and internet services.
                </p>
                <h3 class="text-3xl font-bold text-gray-900 pt-4">Our Vision</h3>
                <p class="text-lg text-gray-600">
                    To be the world's most trusted partner in digital communication, bridging the gap between distances and bringing the world closer together with next-generation technology.
                </p>
            </div>
        </div>
    </div>

    <!-- Full Team Section -->
    <div class="py-16 sm:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-extrabold text-gray-900">Meet Our Dedicated Team</h2>
                <p class="mt-4 text-lg text-gray-500">The minds behind the innovation.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-x-8 gap-y-12">
                @foreach(\App\Models\Team::all() as $member)
                <div class="flex flex-col items-center">
                    <div class="relative mb-6">
                        <div class="absolute inset-0 bg-blue-100 rounded-full scale-110"></div>
                        <img class="relative h-44 w-44 rounded-full object-cover shadow-lg mb-4" src="{{ $member->photo }}" alt="{{ $member->name }}">
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">{{ $member->name }}</h3>
                    <p class="text-blue-600 font-medium mb-3">{{ $member->role }}</p>
                    <p class="text-gray-500 text-sm text-center px-4">{{ $member->bio }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
