@extends('layouts.app')

@section('title', $product->name ?? 'Detail Produk')

@section('content')
    {{-- Breadcrumb --}}
    <section class="pt-28 pb-4 bg-sand">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex items-center gap-2 text-sm">
                <a href="{{ route('home') }}" class="text-gray-500 hover:text-primary transition">Beranda</a>
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <a href="{{ route('products.index') }}" class="text-gray-500 hover:text-primary transition">Produk</a>
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <span class="text-primary font-medium">{{ $product->name }}</span>
            </nav>
        </div>
    </section>

    {{-- Product Detail --}}
    <section class="py-8 bg-sand">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                {{-- Image Gallery --}}
                <div>
                    <div class="glass rounded-2xl overflow-hidden mb-4">
                        <div class="w-full h-96 lg:h-[500px] bg-gradient-to-br from-primary/10 to-secondary/10 flex items-center justify-center"
                            id="main-image">
                            @if (isset($product->image))
                                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}"
                                    class="w-full h-full object-cover">
                            @endif
                        </div>
                    </div>

                    {{-- Thumbnails --}}
                    <div class="grid grid-cols-4 gap-3">
                        @for ($i = 0; $i < 1; $i++)
                            <button
                                class="glass rounded-xl overflow-hidden h-20 hover:ring-2 hover:ring-secondary transition {{ $i === 0 ? 'ring-2 ring-secondary' : '' }}">
                                <div
                                    class="w-full h-full bg-gradient-to-br from-primary/10 to-secondary/10 flex items-center justify-center">
                                    <img src="{{ asset($product->image) }}" </div>
                            </button>
                        @endfor
                    </div>
                </div>

                {{-- Product Info --}}
                <div>
                    @if (session('success'))
                        <div x-data="{ show: true }" x-show="show"
                            class="flex items-center justify-between bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded-xl mb-4">

                            <span>{{ session('success') }}, <a href="{{ route('cart.index') }}"
                                    class="font-bold underline text-green-800 hover:text-green-900">Lihat
                                    keranjang</a></span>

                            <button @click="show = false" class="ml-4 text-green-700 hover:text-green-900">
                                ✕
                            </button>
                        </div>
                    @endif
                    <span
                        class="text-secondary font-semibold text-sm uppercase tracking-wider">{{ $product->category }}</span>
                    <h1 class="font-heading text-3xl md:text-4xl font-bold text-primary mt-2 mb-4">
                        {{ $product->name }}</h1>



                    {{-- Price --}}
                    <div class="mb-6">
                        <span class="text-3xl font-bold text-secondary">Rp
                            {{ number_format($product->price_per_day) }}</span>
                        <span class="text-gray-500 text-lg">/hari</span>
                    </div>

                    {{-- Stock Status --}}
                    <div class="mb-6">
                        @php $stock = $product->stock; @endphp
                        @if ($stock > 5)
                            <span
                                class="inline-flex items-center gap-2 bg-green-100 text-green-700 px-4 py-2 rounded-full font-medium">
                                <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                                Tersedia ({{ $stock }} unit)
                            </span>
                        @elseif($stock > 0)
                            <span
                                class="inline-flex items-center gap-2 bg-yellow-100 text-yellow-700 px-4 py-2 rounded-full font-medium">
                                <span class="w-2 h-2 bg-yellow-500 rounded-full"></span>
                                Stok Terbatas ({{ $stock }} unit)
                            </span>
                        @else
                            <span
                                class="inline-flex items-center gap-2 bg-red-100 text-red-700 px-4 py-2 rounded-full font-medium">
                                <span class="w-2 h-2 bg-red-500 rounded-full"></span>
                                Habis
                            </span>
                        @endif
                    </div>

                    {{-- Description --}}
                    <div class="mb-8">
                        <h3 class="font-heading font-semibold text-lg text-primary mb-3">Deskripsi</h3>
                        <p class="text-gray-600 leading-relaxed">
                            {{ $product->description ?? 'Tenda dome premium kapasitas 4 orang dengan material waterproof dan double layer. Dilengkapi dengan flysheet dan groundsheet untuk perlindungan maksimal dari hujan dan embun. Frame aluminium yang ringan namun kuat, cocok untuk berbagai kondisi cuaca.' }}
                        </p>
                    </div>



                    <hr class="border-gray-200 mb-8">

                    {{-- Booking Form --}}
                    <div class="mt-6">
                        <divclass="flex gap-4">

                        {{-- ADD TO CART --}}
                        <form action="{{ route('cart.add', $product) }}" method="POST" class="flex-1">
                            @csrf

                            <button type="submit" @disabled($product->stock <= 0)
                                class="w-full h-14 border-2 mt-5 rounded-2xl font-semibold text-lg transition flex items-center justify-center gap-2
            {{ $product->stock <= 0
                ? 'border-gray-300 text-gray-400 bg-gray-100 cursor-not-allowed'
                : 'border-secondary text-secondary hover:bg-secondary hover:text-white' }}">

                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>

                                {{ $product->stock <= 0 ? 'Stok Habis' : 'Tambah Ke Keranjang' }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>


    @push('scripts')
        <script>
            function increaseQty() {
                const input = document.getElementById('quantity');
                const max = parseInt(input.max);
                if (parseInt(input.value) < max) {
                    input.value = parseInt(input.value) + 1;
                }
            }

            function decreaseQty() {
                const input = document.getElementById('quantity');
                if (parseInt(input.value) > 1) {
                    input.value = parseInt(input.value) - 1;
                }
            }
        </script>
    @endpush
@endsection
