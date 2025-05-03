@extends('layouts.app')

@section('content')
<section class="py-12 max-w-6xl mx-auto px-4">
    <h2 class="text-3xl font-bold text-center mb-8">📬 Subscriber List</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded-md mb-4 text-center">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
            <thead class="bg-green-600 text-white">
                <tr>
                    <th class="text-left px-6 py-3">#</th>
                    <th class="text-left px-6 py-3">Email</th>
                    <th class="text-left px-6 py-3">Subscribed At</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($subscribers as $subscriber)
                    <tr class="border-b hover:bg-green-50 transition">
                        <td class="px-6 py-4">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4">{{ $subscriber->email }}</td>
                        <td class="px-6 py-4">{{ $subscriber->created_at->format('Y-m-d H:i') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center px-6 py-8 text-gray-500">No subscribers found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</section>
@endsection
