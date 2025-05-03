@extends('layouts.app')

@section('content')
    <section class="py-12 text-center flex flex-col items-center justify-center px-4 sm:px-8">
        <h2 class="text-3xl font-semibold mb-2">Join the Movement 🌿</h2>
        <p class="mb-4">Be the first to know when we launch. Sign up today! 💌</p>
        <form method="post" action="{{ route('subscribe') }}"
              class="flex flex-col sm:flex-row justify-center items-center gap-4 max-w-md w-full">
            @csrf
            @if (session('error'))
                <div class="bg-red-100 text-red-700 p-4 rounded-md mb-4">
                            {{session('error')}}
                </div>
            @elseif(session('success'))
                <div class="bg-green-100 text-green-700 p-4 rounded-md mb-4">
                    {{ session('success') }}
                </div>
            @else
                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="Enter your email"
                    class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500"
                    required
                />
                <button
                    type="submit"
                    class="bg-green-600 text-white px-6 py-2 rounded-md hover:bg-green-700 transition"
                >
                    Subscribe
                </button>
            @endif
        </form>
    </section>

    <section class="py-12 max-w-6xl mx-auto px-4 text-center">
        <h2 class="text-3xl font-semibold mb-8">The Problem ❌</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-lg shadow">Many housewives have limited opportunities to earn income
                without
                leaving home.
            </div>
            <div class="bg-white p-6 rounded-lg shadow">Gardening efforts at home often go unrecognized and unmonetized.
            </div>
            <div class="bg-white p-6 rounded-lg shadow">Communities lack strong, local, eco-friendly networks.</div>
        </div>
    </section>

    <section class="py-12 max-w-6xl mx-auto px-4 text-center">
        <h2 class="text-3xl font-semibold mb-8">Our Solution ✅</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-lg shadow">We provide courses and certifications in sustainable gardening
                practices. 📚
            </div>
            <div class="bg-white p-6 rounded-lg shadow">Track your CO2 offset and generate tradable carbon credits. 🌍
            </div>
            <div class="bg-white p-6 rounded-lg shadow">Sell or share your produce, seeds, and compost with your
                neighbors.
                🥕
            </div>
        </div>
    </section>

    <section class="py-12 max-w-6xl mx-auto px-4 text-center">
        <h2 class="text-3xl font-semibold mb-8">Why Cholita.app? 💡</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-xl font-semibold mb-2">💰 Earn from Dashboard</h3>
                <p>Turn your gardening skills into cash and CO2 credits.</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-xl font-semibold mb-2">🤝 Build Community</h3>
                <p>Volunteer, share, and work together with your neighbors.</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-xl font-semibold mb-2">🌿 Grow Sustainably</h3>
                <p>Access expert knowledge and tools for ecological gardening.</p>
            </div>
        </div>
    </section>

    <section class="py-12 text-center">
        <h2 class="text-3xl font-semibold mb-2">Your Garden, Your Future 🌻</h2>
        <p class="mb-4">Let’s grow a greener future together. Join Cholita.app today.</p>
        <button class="bg-pink-600 text-white py-2 px-6 rounded-lg text-lg hover:bg-pink-700 transition">Sign Up for
            Beta
            Access
        </button>
    </section>

@endsection
