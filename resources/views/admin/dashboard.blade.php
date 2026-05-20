@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-2xl p-6 shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                </div>
            </div>
            <p class="text-gray-500 text-sm mb-1">Total Produk</p>
            <p class="font-heading font-bold text-2xl text-primary">{{ $totalProducts }}</p>
        </div>

        <div class="bg-white rounded-2xl p-6 shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>

            </div>
            <p class="text-gray-500 text-sm mb-1">Total Booking</p>
            <p class="font-heading font-bold text-2xl text-primary">{{ $totalBookings }}</p>
        </div>

        <div class="bg-white rounded-2xl p-6 shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-yellow-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>

            </div>
            <p class="text-gray-500 text-sm mb-1">Rental Aktif</p>
            <p class="font-heading font-bold text-2xl text-primary">{{ $activeRentals }}</p>
        </div>

        <div class="bg-white rounded-2xl p-6 shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>

            </div>
            <p class="text-gray-500 text-sm mb-1">Pendapatan Bulan Ini</p>
            <p class="font-heading font-bold text-2xl text-primary">Rp
                {{ number_format($monthlyRevenue) }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Chart --}}
        <div class="lg:col-span-2 bg-white rounded-2xl p-6 shadow-sm">
            <div class="flex items-center justify-between mb-6">
                <h2 class="font-heading font-semibold text-lg text-primary">Statistik Booking</h2>
                <select onchange="window.location.href = this.value"
                    class="px-4 py-2 rounded-lg border border-gray-200 text-sm">

                    <option value="{{ route('admin.dashboard', ['range' => 7]) }}" {{ $range == 7 ? 'selected' : '' }}>
                        7 Hari Terakhir
                    </option>

                    <option value="{{ route('admin.dashboard', ['range' => 30]) }}" {{ $range == 30 ? 'selected' : '' }}>
                        30 Hari Terakhir
                    </option>

                    <option value="{{ route('admin.dashboard', ['range' => 90]) }}" {{ $range == 90 ? 'selected' : '' }}>
                        3 Bulan Terakhir
                    </option>
                </select>
            </div>

            {{-- Simple Chart Placeholder --}}
            <canvas id="bookingChart" height="160"></canvas>
        </div>

        {{-- Low Stock Alert --}}
        <div class="bg-white rounded-2xl p-6 shadow-sm">
            <div class="flex items-center justify-between mb-6">
                <h2 class="font-heading font-semibold text-lg text-primary">Stok Menipis</h2>
                <a href="{{ route('admin.products.index') }}" class="text-secondary text-sm hover:underline">Lihat
                    Semua</a>
            </div>

            <div class="space-y-4">

                @foreach ($lowStockItems as $item)
                    <div class="flex items-center gap-4 p-3 bg-gray-50 rounded-xl">
                        <div
                            class="w-10 h-10 bg-gradient-to-br from-primary/10 to-secondary/10 rounded-lg flex items-center justify-center">
                            <img src="{{ asset($item->image) }}" alt="{{ $item->name }}"
                                class="w-full h-full object-cover rounded-lg">
                        </div>
                        <div class="flex-1">
                            <p class="font-medium text-primary text-sm">{{ $item->name }}</p>
                            <p class="text-gray-500 text-xs">{{ $item->category }}</p>
                        </div>
                        <span
                            class="px-2 py-1 bg-red-100 text-red-600 text-xs font-semibold rounded-full">{{ $item->stock }}
                            left</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Recent Bookings --}}
    <div class="mt-6 bg-white rounded-2xl shadow-sm overflow-hidden">
        <div class="p-6 border-b border-gray-100 flex items-center justify-between">
            <h2 class="font-heading font-semibold text-lg text-primary">Booking Terbaru</h2>
            <a href="{{ route('admin.bookings.index') }}" class="text-secondary text-sm hover:underline">Lihat Semua</a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">ID
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            Pelanggan</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Produk
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            Tanggal</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Total
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">

                    @foreach ($recentBookings as $booking)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium text-primary">{{ $booking->booking_code }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $booking->customer_name }}</td>
                            <td class="px-6 py-4 text-gray-600">
                                @if ($booking->items->count())
                                    @foreach ($booking->items as $item)
                                        @if ($item->product)
                                            <div>
                                                • {{ $item->product->name }} x{{ $item->quantity }}
                                            </div>
                                        @else
                                            <div class="text-gray-400">Produk tidak ditemukan</div>
                                        @endif
                                    @endforeach
                                @else
                                    <span class="text-gray-400">Tidak ada produk</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-gray-600">{{ $booking->start_date->format('d M Y') }}</td>
                            <td class="px-6 py-4 font-medium text-primary">Rp
                                {{ number_format($booking->total_price) }}</td>
                            <td class="px-6 py-4">
                                @if ($booking['status'] === 'pending')
                                    <span
                                        class="inline-flex items-center gap-1 bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-medium">
                                        <span class="w-1.5 h-1.5 bg-yellow-500 rounded-full"></span>
                                        Pending
                                    </span>
                                @elseif($booking['status'] === 'aktif')
                                    <span
                                        class="inline-flex items-center gap-1 bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-medium">
                                        <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span>
                                        Aktif
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center gap-1 bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-xs font-medium">
                                        <span class="w-1.5 h-1.5 bg-gray-500 rounded-full"></span>
                                        Selesai
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('admin.bookings.index') }}"
                                    class="text-secondary hover:underline text-sm font-medium">Detail</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {

                const labels = @json($labels);
                const data = @json($stats);

                const ctx = document.getElementById('bookingChart');

                if (!ctx) return;

                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels,
                        datasets: [{
                            label: 'Jumlah Booking',
                            data: data,

                            backgroundColor: '#1f3d2b',
                            borderRadius: 15,
                            borderSkipped: false,
                            hoverBackgroundColor: '#6b8e23'
                        }]
                    },
                    options: {
                        responsive: true,

                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                backgroundColor: '#1f3d2b',
                                titleColor: '#fff',
                                bodyColor: '#fff',
                                padding: 10,
                                cornerRadius: 8
                            }
                        },

                        scales: {
                            x: {
                                categoryPercentage: 0.6,
                                barPercentage: 0.5
                            },
                            y: {
                                beginAtZero: true,
                                grid: {
                                    color: '#e5e7eb'
                                }
                            }
                        },

                        animation: {
                            duration: 1200,
                            easing: 'easeOutQuart'
                        }
                    }
                });

            });
        </script>
    @endpush
@endsection
