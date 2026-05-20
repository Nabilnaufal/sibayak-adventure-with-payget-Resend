@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    {{-- Header --}}
    <section class="pt-32 pb-8 bg-primary">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="font-heading text-3xl md:text-4xl font-bold text-white mb-2">Dashboard</h1>
            <p class="text-white/70">Selamat datang, {{ auth()->user()->name ?? 'User' }}!</p>
        </div>
    </section>

    {{-- Main Content --}}
    <section class="py-12 bg-sand">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-8">
                {{-- Sidebar --}}
                <aside class="lg:w-64 shrink-0">
                    <div class="glass rounded-2xl p-6 sticky top-28">
                        {{-- User Info --}}
                        <div class="text-center mb-6 pb-6 border-b border-gray-200">
                            <div class="w-20 h-20 bg-secondary rounded-full flex items-center justify-center mx-auto mb-4">
                                <span
                                    class="text-2xl font-bold text-white">{{ substr(auth()->user()->name ?? 'U', 0, 1) }}</span>
                            </div>
                            <h3 class="font-heading font-semibold text-lg text-primary">
                                {{ auth()->user()->name ?? 'User Name' }}</h3>
                            <p class="text-gray-500 text-sm">{{ auth()->user()->email ?? 'user@example.com' }}</p>
                        </div>

                        {{-- Navigation --}}
                        <nav class="space-y-2">
                            <a href="{{ route('dashboard') }}"
                                class="flex items-center gap-3 px-4 py-3 rounded-xl bg-secondary/10 text-secondary font-medium">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                                My Bookings
                            </a>
                            <a href="{{ route('profile') }}"
                                class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 hover:bg-gray-100 transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Profil
                            </a>

                            <hr class="border-gray-200 my-4">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="flex items-center gap-3 px-4 py-3 rounded-xl text-red-500 hover:bg-red-50 transition w-full">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                    Keluar
                                </button>
                            </form>
                        </nav>
                    </div>
                </aside>

                {{-- Content --}}
                <div class="flex-1">
                    @if (session('success'))
                        <div x-data="{ show: true }" x-show="show"
                            class="flex items-center justify-between bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded-xl mb-4">

                            <span>{{ session('success') }}</span>

                            <button @click="show = false" class="ml-4 text-green-700 hover:text-green-900">
                                ✕
                            </button>
                        </div>
                    @endif
                    {{-- Stats --}}
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">
                        <div class="glass rounded-2xl p-6">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-gray-500 text-sm">Total Booking</p>
                                    <p class="font-heading font-bold text-2xl text-primary">{{ $totalBookings }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="glass rounded-2xl p-6">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-gray-500 text-sm">Selesai</p>
                                    <p class="font-heading font-bold text-2xl text-primary">{{ $completedBookings }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="glass rounded-2xl p-6">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-yellow-100 rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-gray-500 text-sm">Aktif</p>
                                    <p class="font-heading font-bold text-2xl text-primary">{{ $activeBookings }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Bookings Table --}}
                    <div class="glass rounded-2xl overflow-hidden">
                        <div class="p-6 border-b border-gray-100">
                            <h2 class="font-heading font-semibold text-lg text-primary">Riwayat Booking</h2>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th
                                            class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                            Produk</th>
                                        <th
                                            class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                            Tanggal</th>
                                        <th
                                            class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                            Durasi</th>
                                        <th
                                            class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                            Total</th>
                                        <th
                                            class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                            Status</th>
                                        <th
                                            class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                            Denda
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @foreach ($bookings as $booking)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-6 py-4">
                                                <div class="flex flex-col">
                                                    @if ($booking->items->count())
                                                        @foreach ($booking->items as $item)
                                                            @if ($item->product)
                                                                <span class="font-medium text-primary">
                                                                    • {{ $item->product->name }} x{{ $item->quantity }}
                                                                </span>
                                                            @else
                                                                <span class="text-gray-400">
                                                                    Produk tidak ditemukan
                                                                </span>
                                                            @endif
                                                        @endforeach
                                                    @else
                                                        <span class="text-gray-400">
                                                            Tidak ada produk
                                                        </span>
                                                    @endif
                                                </div>
                                            </td>

                                            <td class="px-6 py-4 text-gray-600">
                                                {{ $booking->start_date->format('d M Y') }}
                                            </td>

                                            <td class="px-6 py-4 text-gray-600">
                                                {{ $booking->start_date->diffInDays($booking->end_date) + 1 }} hari
                                            </td>

                                            <td class="px-6 py-4 font-medium text-primary">
                                                Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                                            </td>

                                            <td class="px-6 py-4">
                                                @if ($booking->status === 'aktif')
                                                    <span
                                                        class="inline-flex items-center gap-1 bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-medium">
                                                        <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                                                        Aktif
                                                    </span>
                                                @elseif($booking->status === 'selesai')
                                                    <span
                                                        class="inline-flex items-center gap-1 bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm font-medium">
                                                        <span class="w-2 h-2 bg-gray-500 rounded-full"></span>
                                                        Selesai
                                                    </span>
                                                @elseif($booking->status === 'dibatalkan')
                                                    <span
                                                        class="inline-flex items-center gap-1 bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm font-medium">
                                                        <span class="w-2 h-2 bg-red-500 rounded-full"></span>
                                                        Dibatalkan
                                                    </span>
                                                @else
                                                    <span
                                                        class="inline-flex items-center gap-1 bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm font-medium">
                                                        <span class="w-2 h-2 bg-yellow-500 rounded-full"></span>
                                                        Menunggu
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4">
                                                @if ($booking->status === 'selesai')
                                                    @if ($booking->late_days > 0)
                                                        <div class="text-red-500 font-medium">
                                                            Rp {{ number_format($booking->penalty, 0, ',', '.') }}
                                                        </div>
                                                        <div class="text-xs text-gray-500">
                                                            Terlambat {{ $booking->late_days }} hari
                                                        </div>
                                                    @else
                                                        <span class="text-green-600 text-sm font-medium">
                                                            Tepat waktu
                                                        </span>
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        {{-- Pagination --}}
                        @if (isset($bookings) && $bookings->hasPages())
                            <div class="p-6 border-t border-gray-100">
                                {{ $bookings->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
