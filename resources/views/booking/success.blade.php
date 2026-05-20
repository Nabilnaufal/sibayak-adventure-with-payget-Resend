@extends('layouts.app')

@section('title', 'Booking Berhasil')

@section('content')
    <section class="min-h-screen pt-32 pb-20 bg-sand flex items-center">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 text-center">

            {{-- Success Icon --}}
            <div class="w-24 h-24 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-8">
                <svg class="w-12 h-12 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            </div>

            <h1 class="font-heading text-3xl md:text-4xl font-bold text-primary mb-4">
                Booking Berhasil!
            </h1>

            <p class="text-gray-600 text-lg mb-8">
                @if (session('success'))
                    <div x-data="{ show: true }" x-show="show"
                        class="flex items-center justify-between bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded-xl mb-4">

                        <span>{{ session('success') }}</span>

                        <button @click="show = false" class="ml-4 text-green-700 hover:text-green-900">
                            ✕
                        </button>
                    </div>
                @endif
            </p>

            {{-- Booking Details Card --}}
            <div class="glass rounded-2xl p-8 text-left mb-8">

                <h2 class="font-heading font-semibold text-lg text-primary mb-6 text-center">
                    Detail Booking
                </h2>

                {{-- BOOKING INFO (1x saja) --}}
                <div class="space-y-4 mb-6">

                    <div class="flex justify-between py-3 border-b border-gray-100">
                        <span class="text-gray-600">No. Booking</span>
                        <span class="font-semibold text-primary">{{ $booking->booking_code }}</span>
                    </div>

                    <div class="flex justify-between py-3 border-b border-gray-100">
                        <span class="text-gray-600">Tanggal Sewa</span>
                        <span class="font-medium">
                            {{ $booking->start_date->format('d M Y') }}
                            -
                            {{ $booking->end_date->format('d M Y') }}
                        </span>
                    </div>

                    <div class="flex justify-between py-3 border-b border-gray-100">
                        <span class="text-gray-600">Durasi</span>
                        <span class="font-medium">
                            {{ $booking->start_date->diffInDays($booking->end_date) + 1 }} hari
                        </span>
                    </div>

                </div>

                {{-- PRODUCT LIST --}}
                <div class="space-y-3">

                    @foreach ($booking->items as $item)
                        <div class="flex justify-between py-3 border-b border-gray-100">
                            <span class="text-gray-600">
                                {{ $item->product->name }}
                            </span>

                            <span class="font-medium">
                                {{ $item->quantity }} unit
                            </span>
                        </div>
                    @endforeach

                </div>

                {{-- STATUS --}}
                <div class="flex justify-between py-3 border-b border-gray-100 mt-4">
                    <span class="text-gray-600">Status</span>
                    <span
                        class="inline-flex items-center gap-2 bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-medium">
                        <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                        Sudah Dibayar
                    </span>
                </div>

                {{-- TOTAL --}}
                <div class="flex justify-between py-3">
                    <span class="text-gray-600">Total Pembayaran</span>
                    <span class="font-bold text-xl text-secondary">
                        Rp {{ number_format($booking->total_price) }}
                    </span>
                </div>

            </div>


            {{-- Actions --}}
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('dashboard') }}"
                    class="bg-primary hover:bg-primary/90 text-white px-8 py-4 rounded-2xl font-semibold transition transform hover:scale-105">
                    Lihat Booking Saya
                </a>

                <a href="{{ route('products.index') }}"
                    class="border-2 border-primary text-primary hover:bg-primary hover:text-white px-8 py-4 rounded-2xl font-semibold transition">
                    Lanjut Belanja
                </a>
            </div>

            {{-- Contact --}}
            <p class="text-gray-500 text-sm mt-8">
                Ada pertanyaan? Hubungi kami di
                <a href="https://wa.me/6289601104497" class="text-secondary hover:underline">WhatsApp</a> atau
                <a href="mailto:faqiharif4@gmail.com" class="text-secondary hover:underline">Email</a>
            </p>

        </div>
    </section>
@endsection
