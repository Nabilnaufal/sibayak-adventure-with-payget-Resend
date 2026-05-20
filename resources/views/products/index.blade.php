@extends('layouts.app')

@section('title', 'Produk')

@section('content')
    {{-- Header --}}
    <section class="pt-32 pb-12 bg-primary">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="font-heading text-3xl md:text-4xl font-bold text-white mb-4">Katalog Produk</h1>
            <p class="text-white/70">Temukan peralatan hiking dan camping berkualitas untuk petualangan Anda</p>
        </div>
    </section>

    {{-- Main Content --}}
    <section class="py-12 bg-sand">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-8">
                {{-- Sidebar Filters --}}
                <aside class="lg:w-72 shrink-0">
                    <div class="glass rounded-2xl p-6 sticky top-28">
                        <h3 class="font-heading font-semibold text-lg text-primary mb-6">Filter</h3>

                        <form action="{{ route('products.index') }}" method="GET">
                            {{-- Category Filter --}}
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 mb-3">Kategori</label>
                                <div class="space-y-2">
                                    @php
                                        $categories = ['Tenda', 'Sepatu', 'Carrier', 'Sleeping Bag', 'Aksesoris'];
                                    @endphp
                                    @foreach ($categories as $cat)
                                        <label class="flex items-center gap-3 cursor-pointer">
                                            <input type="checkbox" name="category[]" value="{{ $cat }}"
                                                class="w-4 h-4 text-secondary rounded border-gray-300 focus:ring-secondary"
                                                {{ in_array($cat, request('category', [])) ? 'checked' : '' }}>
                                            <span class="text-gray-600">{{ $cat }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            {{-- Price Range --}}
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 mb-3">Harga per Hari</label>
                                <div class="space-y-3">
                                    <div>
                                        <input type="number" name="min_price" placeholder="Min"
                                            value="{{ request('min_price') }}"
                                            class="w-full px-4 py-2 rounded-xl border border-gray-200 focus:border-secondary focus:ring-secondary text-sm">
                                    </div>
                                    <div>
                                        <input type="number" name="max_price" placeholder="Max"
                                            value="{{ request('max_price') }}"
                                            class="w-full px-4 py-2 rounded-xl border border-gray-200 focus:border-secondary focus:ring-secondary text-sm">
                                    </div>
                                </div>
                            </div>

                            {{-- Availability --}}
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 mb-3">Ketersediaan</label>
                                <div class="space-y-2">
                                    <label class="flex items-center gap-3 cursor-pointer">
                                        <input type="checkbox" name="available" value="1"
                                            class="w-4 h-4 text-secondary rounded border-gray-300 focus:ring-secondary"
                                            {{ request('available') ? 'checked' : '' }}>
                                        <span class="text-gray-600">Tersedia</span>
                                    </label>
                                </div>
                            </div>

                            <button type="submit"
                                class="w-full bg-primary hover:bg-primary/90 text-white py-3 rounded-xl font-medium transition">
                                Terapkan Filter
                            </button>

                            @if (request()->hasAny(['category', 'min_price', 'max_price', 'available']))
                                <a href="{{ route('products.index') }}"
                                    class="block text-center text-gray-500 hover:text-primary mt-3 text-sm">
                                    Reset Filter
                                </a>
                            @endif
                        </form>
                    </div>
                </aside>

                {{-- Products Grid --}}
                <div class="flex-1">
                    {{-- Sort & View Options --}}
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-8">
                        <p class="text-gray-600">
                            Menampilkan <span class="font-semibold text-primary">{{ $products->total() }}</span>
                            produk
                        </p>
                    </div>

                    {{-- Products --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">
                        @forelse($products as $product)
                            <div
                                class="group glass rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                                <div class="relative overflow-hidden">
                                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}"
                                        class="w-full h-56 object-cover group-hover:scale-110 transition-transform duration-500">
                                    <div class="absolute top-4 right-4">
                                        @if ($product->stock > 5)
                                            <span
                                                class="bg-green-500 text-white text-xs font-semibold px-3 py-1 rounded-full">Available</span>
                                        @elseif($product->stock > 0)
                                            <span
                                                class="bg-yellow-500 text-white text-xs font-semibold px-3 py-1 rounded-full">Low
                                                Stock</span>
                                        @else
                                            <span
                                                class="bg-red-500 text-white text-xs font-semibold px-3 py-1 rounded-full">Out
                                                of Stock</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="p-6">
                                    <span
                                        class="text-secondary text-xs font-semibold uppercase tracking-wider">{{ $product->category }}</span>
                                    <h3 class="font-heading font-semibold text-lg text-primary mt-1 mb-2">
                                        {{ $product->name }}</h3>
                                    <p class="text-gray-500 text-sm mb-4 line-clamp-2">{{ $product->description }}</p>
                                    <div class="flex items-center justify-between">
                                        <span class="text-secondary font-bold text-xl">Rp
                                            {{ number_format($product->price_per_day, 0, ',', '.') }}<span
                                                class="text-sm font-normal text-gray-500">/hari</span></span>
                                        <a href="{{ route('products.show', $product) }}"
                                            class="bg-primary hover:bg-primary/90 text-white px-4 py-2 rounded-xl text-sm font-medium transition">
                                            Detail
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500">Produk tidak ditemukan.</p>
                        @endforelse
                    </div>

                    {{-- Pagination --}}
                    @if (isset($products) && $products->hasPages())
                        <div class="mt-12">
                            {{ $products->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
