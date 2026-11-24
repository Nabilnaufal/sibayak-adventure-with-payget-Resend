@extends('layouts.admin')

@section('title', 'Kelola Booking')
@section('page-title', 'Kelola Booking')

@section('content')
    @if (session('success'))
        <div x-data="{ show: true }" x-show="show"
            class="flex items-center justify-between bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded-xl mb-4">

            <span>{{ session('success') }}</span>

            <button @click="show = false" class="ml-4 text-green-700 hover:text-green-900">
                ✕
            </button>
        </div>
    @endif
    {{-- Filters --}}
    <form method="GET" action="{{ route('admin.bookings.index') }}" onchange="this.submit()">
        <div class="bg-white rounded-2xl p-4 shadow-sm mb-6">
            <div class="flex flex-col md:flex-row gap-4">
                <div class="flex-1">
                    <div class="relative">
                        <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <input type="text" placeholder="Cari booking atau pelanggan..."
                            class="w-full pl-12 pr-4 py-3 rounded-xl border border-gray-200 focus:border-secondary focus:ring-secondary"
                            value="{{ request('search') }}" name="search">
                    </div>
                </div>
                <select name="status"
                    class="px-4 py-3 rounded-xl border border-gray-200 focus:border-secondary focus:ring-secondary">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    <option value="dibatalkan" {{ request('status') == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                </select>
                <input type="date" name="date"
                    class="px-4 py-3 rounded-xl border border-gray-200 focus:border-secondary focus:ring-secondary"
                    value="{{ request('date') }}">

                <button type="submit" class="bg-secondary text-white px-4 py-2 rounded-xl">
                    Filter
                </button>
                <a href="{{ route('admin.bookings.export', request()->only(['search', 'status', 'date'])) }}"
                    class="inline-flex items-center justify-center gap-2 bg-primary text-white px-4 py-2 rounded-xl hover:bg-primary/90 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 10v6m0 0l-3-3m3 3l3-3m2 5H7a2 2 0 01-2-2V8a2 2 0 012-2h2l2-2h2l2 2h2a2 2 0 012 2v8a2 2 0 01-2 2z" />
                    </svg>
                    Export Excel
                </a>
            </div>
        </div>
    </form>
    {{-- Bookings Table --}}
    <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">ID
                            Booking</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            Pelanggan</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Produk
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Tanggal
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Total
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Denda
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">


                    @foreach ($bookings as $booking)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <span class="font-medium text-primary">{{ $booking->booking_code }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <div>
                                    <p class="font-medium text-gray-800">{{ $booking->customer_name }}</p>
                                    <p class="text-gray-500 text-sm">{{ $booking->customer_email }}</p>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-col gap-1">
                                    @if ($booking->items->count())
                                        @foreach ($booking->items as $item)
                                            @if ($item->product)
                                                <div class="flex items-center gap-2">
                                                    {{-- optional image --}}
                                                    @if ($item->product->image)
                                                        <img src="{{ asset($item->product->image) }}"
                                                            class="w-8 h-8 rounded object-cover">
                                                    @endif

                                                    <span class="text-gray-700">
                                                        {{ $item->product->name }} x{{ $item->quantity }}
                                                    </span>
                                                </div>
                                            @else
                                                <span class="text-gray-400 text-sm">
                                                    Produk tidak ditemukan
                                                </span>
                                            @endif
                                        @endforeach
                                    @else
                                        <span class="text-gray-400 text-sm">
                                            Tidak ada produk
                                        </span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div>
                                    <p class="text-gray-700">
                                        {{ \Carbon\Carbon::parse($booking->start_date)->translatedFormat('d F Y') }}</p>
                                    <p class="text-gray-500 text-sm">s/d
                                        {{ \Carbon\Carbon::parse($booking->end_date)->translatedFormat('d F Y') }}</p>
                                </div>
                            </td>
                            <td class="px-6 py-4 font-medium text-primary">Rp
                                {{ number_format($booking->total_price, 0, ',', '.') }}</td>
                            <td class="px-6 py-4">
                                @if ($booking->status === 'pending')
                                    <span
                                        class="inline-flex items-center gap-1 bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-medium">
                                        <span class="w-1.5 h-1.5 bg-yellow-500 rounded-full"></span>
                                        Menunggu
                                    </span>
                                @elseif($booking->status === 'aktif')
                                    <span
                                        class="inline-flex items-center gap-1 bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-medium">
                                        <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span>
                                        Aktif
                                    </span>
                                @elseif($booking->status === 'selesai')
                                    <span
                                        class="inline-flex items-center gap-1 bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-xs font-medium">
                                        <span class="w-1.5 h-1.5 bg-gray-500 rounded-full"></span>
                                        Selesai
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center gap-1 bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-medium">
                                        <span class="w-1.5 h-1.5 bg-red-500 rounded-full"></span>
                                        Dibatalkan
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
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">

                                    @if ($booking->status === 'pending')
                                        <form action="{{ route('admin.bookings.updateStatus', $booking) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="aktif">
                                            <button type="submit"
                                                class="p-2 text-gray-500 hover:text-green-500 hover:bg-green-50 rounded-lg transition"
                                                title="Konfirmasi">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M5 13l4 4L19 7" />
                                                </svg>
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.bookings.updateStatus', $booking) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="dibatalkan">
                                            <button type="submit"
                                                class="p-2 text-gray-500 hover:text-red-500 hover:bg-red-50 rounded-lg transition"
                                                title="Batalkan">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </form>
                                    @elseif($booking->status === 'aktif')
                                        <form action="{{ route('admin.bookings.updateStatus', $booking) }}"
                                            method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="selesai">
                                            <button type="submit"
                                                class="p-2 text-gray-500 hover:text-blue-500 hover:bg-blue-50 rounded-lg transition"
                                                title="Selesaikan">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-6 border-t border-gray-100 flex items-center justify-between">
            <p class="text-gray-500 text-sm">
                Menampilkan {{ $bookings->firstItem() }} - {{ $bookings->lastItem() }}
                dari {{ $bookings->total() }} booking
            </p>

            {{ $bookings->links() }}
        </div>

    </div>
@endsection
