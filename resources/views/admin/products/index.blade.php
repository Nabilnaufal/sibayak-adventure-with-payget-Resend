@extends('layouts.admin')

@section('title', 'Kelola Produk')
@section('page-title', 'Kelola Produk')

@section('content')
    {{-- Header --}}
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-6">
        <div>
            <p class="text-gray-500">Kelola semua produk rental Anda</p>
        </div>
        <a href="{{ route('admin.products.create') }}"
            class="bg-secondary hover:bg-secondary/90 text-white px-6 py-3 rounded-xl font-medium transition flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Tambah Produk
        </a>
    </div>

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
    <form method="GET" action="{{ route('admin.products.index') }}" onchange="this.submit()">
        <div class="bg-white rounded-2xl p-4 shadow-sm mb-6">
            <div class="flex flex-col md:flex-row gap-4">
                <div class="flex-1">
                    <div class="relative">
                        <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <input type="text" placeholder="Cari produk..." value="{{ request('search') }}" name="search"
                            class="w-full pl-12 pr-4 py-3 rounded-xl border border-gray-200 focus:border-secondary focus:ring-secondary">
                    </div>
                </div>
                <select name="kategori" class="px-4 py-3 rounded-xl border border-gray-200">
                    <option value="">Semua Kategori</option>
                    <option value="Tenda" {{ request('kategori') == 'Tenda' ? 'selected' : '' }}>Tenda</option>
                    <option value="Sepatu" {{ request('kategori') == 'Sepatu' ? 'selected' : '' }}>Sepatu</option>
                    <option value="Carrier" {{ request('kategori') == 'Carrier' ? 'selected' : '' }}>Carrier</option>
                    <option value="Aksesoris" {{ request('kategori') == 'Aksesoris' ? 'selected' : '' }}>Aksesoris</option>
                </select>

                <select name="status" class="px-4 py-3 rounded-xl border border-gray-200">
                    <option value="">Semua Status</option>
                    <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>Tersedia</option>
                    <option value="low" {{ request('status') == 'low' ? 'selected' : '' }}>Stok Menipis</option>
                    <option value="out" {{ request('status') == 'out' ? 'selected' : '' }}>Habis</option>
                </select>
                <button type="submit" class="bg-secondary text-white px-4 py-2 rounded-xl">
                    Filter
                </button>
            </div>
        </div>
    </form>
    {{-- Products Table --}}
    <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Produk
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            Kategori</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            Harga/Hari</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Stok
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach ($products as $product)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-4">
                                    <div class="w-14 h-14 bg-gray-100 rounded-xl overflow-hidden">
                                        @if ($product->image)
                                            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}"
                                                class="w-full h-full object-cover">
                                        @else
                                            <div
                                                class="w-full h-full bg-gradient-to-br from-primary/10 to-secondary/10 flex items-center justify-center">
                                                <svg class="w-6 h-6 text-primary/30" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <p class="font-medium text-primary">{{ $product->name }}</p>
                                        <p class="text-gray-500 text-sm">SKU: {{ $product->sku }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span
                                    class="px-3 py-1 bg-primary/10 text-primary text-sm font-medium rounded-full">{{ $product->category }}</span>
                            </td>
                            <td class="px-6 py-4 font-medium text-primary">Rp
                                {{ number_format($product->price_per_day, 0, ',', '.') }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">

                                    <span class="font-semibold text-primary w-8 text-center">{{ $product->stock }}</span>

                                </div>
                            </td>
                            <td class="px-6 py-4">
                                @if ($product->stock > 5)
                                    <span
                                        class="inline-flex items-center gap-1 bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-medium">
                                        <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span>
                                        In Stock
                                    </span>
                                @elseif($product->stock > 0)
                                    <span
                                        class="inline-flex items-center gap-1 bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-medium">
                                        <span class="w-1.5 h-1.5 bg-yellow-500 rounded-full"></span>
                                        Low Stock
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center gap-1 bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-medium">
                                        <span class="w-1.5 h-1.5 bg-red-500 rounded-full"></span>
                                        Out of Stock
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('admin.products.edit', $product) }}"
                                        class="p-2 text-gray-500 hover:text-primary hover:bg-gray-100 rounded-lg transition">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>
                                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="p-2 text-gray-500 hover:text-red-500 hover:bg-red-50 rounded-lg transition">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="p-6 border-t border-gray-100 flex items-center justify-between">
            <p class="text-gray-500 text-sm">
                Menampilkan {{ $products->firstItem() }} - {{ $products->lastItem() }}
                dari {{ $products->total() }} product
            </p>

            {{ $products->links() }}
        </div>
    </div>
@endsection
