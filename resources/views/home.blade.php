@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
    {{-- Hero Section --}}
    <section class="relative min-h-screen flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0 overflow-hidden">
            {{-- ini kalau pakai video --}}
            <video autoplay muted loop playsinline class="w-full h-full object-cover">
                <source src="{{ asset('videos/cinematic2.mp4') }}" type="video/mp4">
            </video>

            {{-- Background Image --}}
            {{-- <div class="absolute inset-0"> <img src="{{ asset('images/hero-mountain.jpg') }}" --}}
            {{--        alt="Mountain" class="w-full h-full object-cover"> --}}
            {{--    <div class="absolute inset-0 bg-gradient-to-b from-primary/70 via-primary/50 to-primary/80"></div> --}}
            {{-- </div> --}}

            <div class="absolute inset-0 bg-gradient-to-b from-primary/70 via-primary/50 to-primary/80"></div>
        </div>

        {{-- Content --}}
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="font-heading text-4xl md:text-5xl lg:text-7xl font-bold text-white mb-6 leading-tight">
                Explore Nature with<br>
                <span class="text-secondary">Sibayak Adventure</span>
            </h1>
            <p class="text-xl md:text-2xl text-white/80 mb-10 max-w-2xl mx-auto">
                Rent high-quality hiking gear for your next journey. Peralatan terbaik untuk petualangan tak terlupakan.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('products.index') }}"
                    class="bg-secondary hover:bg-secondary/90 text-white px-8 py-4 rounded-2xl font-semibold text-lg transition transform hover:scale-105 hover:shadow-xl">
                    Browse Gear
                </a>
                <a href="#featured"
                    class="glass text-primary px-8 py-4 rounded-2xl font-semibold text-lg transition transform hover:scale-105">
                    Book Now
                </a>
            </div>
        </div>

        {{-- Scroll Indicator --}}
        <div class="absolute bottom-10 left-1/2 -translate-x-1/2 animate-bounce">
            <svg class="w-6 h-6 text-white/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
            </svg>
        </div>
    </section>

    {{-- Featured Gear Section --}}
    <section class="py-20 bg-sand" id="featured">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="text-secondary font-semibold text-sm uppercase tracking-wider">Pilihan Terbaik</span>
                <h2 class="font-heading text-3xl md:text-4xl font-bold text-primary mt-2">Featured Gear</h2>
                <p class="text-gray-600 mt-4 max-w-xl mx-auto">Peralatan hiking berkualitas tinggi yang paling sering disewa
                    oleh para petualang</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @if (isset($featuredProducts) && $featuredProducts->count())
                    @foreach ($featuredProducts as $product)
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
                                        <span class="bg-red-500 text-white text-xs font-semibold px-3 py-1 rounded-full">Out
                                            of
                                            Stock</span>
                                    @endif
                                </div>
                            </div>
                            <div class="p-6">
                                <h3 class="font-heading font-semibold text-lg text-primary mb-2">{{ $product->name }}</h3>
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
                    @endforeach
                @endif
            </div>

            <div class="text-center mt-12">
                <a href="{{ route('products.index') }}"
                    class="inline-flex items-center gap-2 text-primary font-semibold hover:text-secondary transition">
                    Lihat Semua Produk
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
            </div>
        </div>
    </section>

    {{-- Categories Section --}}
    <section class="py-20 bg-sand-dark">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="text-secondary font-semibold text-sm uppercase tracking-wider">Kategori</span>
                <h2 class="font-heading text-3xl md:text-4xl font-bold text-primary mt-2">Browse by Category</h2>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @php
                    $categories = [
                        [
                            'name' => 'Tenda',
                            'icon' =>
                                'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6',
                            'count' => 12,
                        ],
                        [
                            'name' => 'Sepatu',
                            'icon' =>
                                'M4 6h5.426a1 1 0 0 1 .863 .496l1.064 1.823a3 3 0 0 0 1.896 1.407l4.677 1.114a4 4 0 0 1 3.074 3.89v2.27a1 1 0 0 1 -1 1h-16a1 1 0 0 1 -1 -1v-10a1 1 0 0 1 1 -1',
                            'count' => 8,
                        ],
                        [
                            'name' => 'Carrier',
                            'icon' =>
                                'M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4',
                            'count' => 15,
                        ],
                        [
                            'name' => 'Aksesoris',
                            'icon' =>
                                'M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z',
                            'count' => 20,
                        ],
                    ];
                @endphp

                @foreach ($categories as $category)
                    <a href="{{ route('products.index', ['category[]' => $category['name']]) }}"
                        class="group glass rounded-2xl p-8 text-center hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 hover:bg-primary">
                        <div
                            class="w-16 h-16 mx-auto mb-4 bg-secondary/10 rounded-2xl flex items-center justify-center group-hover:bg-white/20 transition">
                            <svg class="w-8 h-8 text-secondary group-hover:text-white transition" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="{{ $category['icon'] }}" />
                            </svg>
                        </div>
                        <h3 class="font-heading font-semibold text-lg text-primary group-hover:text-white transition">
                            {{ $category['name'] }}</h3>
                        <p class="text-gray-500 text-sm mt-1 group-hover:text-white/70 transition">{{ $category['count'] }}
                            items</p>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- About Section --}}
    <section class="py-20 bg-sand" id="about">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div class="relative">
                    <div class="glass rounded-3xl overflow-hidden shadow-2xl">
                        <div
                            class="w-full h-96 bg-gradient-to-br from-primary/20 to-secondary/20 flex items-center justify-center">
                            <svg class="w-24 h-24 text-primary/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <img src="{{ asset('images/mount-sinabung.jpg') }}" alt="Mountain"
                                    class="w-full h-full object-cover">
                            </svg>
                        </div>
                    </div>
                    <div class="absolute -bottom-6 -right-6 bg-secondary text-white p-6 rounded-2xl shadow-xl">
                        <p class="font-heading text-3xl font-bold">4+</p>
                        <p class="text-sm text-white/80">Tahun Pengalaman</p>
                    </div>
                </div>

                <div>
                    <span class="text-secondary font-semibold text-sm uppercase tracking-wider">Tentang Kami</span>
                    <h2 class="font-heading text-3xl md:text-4xl font-bold text-primary mt-2 mb-6">Sibayak Adventure</h2>
                    <p class="text-gray-600 leading-relaxed mb-6">
                        Sibayak Adventure adalah UMKM lokal yang bergerak di bidang penyewaan alat hiking dan camping.
                        Berlokasi di Jalan Pembangunan Dr.Mansyur, kami menyediakan peralatan berkualitas untuk para
                        petualang
                        yang ingin menjelajahi keindahan alam Sumatera Utara.
                    </p>
                    <p class="text-gray-600 leading-relaxed mb-8">
                        Dengan pengalaman lebih dari 4 tahun, kami telah melayani ribuan pendaki dari berbagai daerah.
                        Komitmen kami adalah memberikan pelayanan terbaik dengan peralatan yang terawat dan harga yang
                        terjangkau.
                    </p>

                    <div class="grid grid-cols-3 gap-6">
                        <div class="text-center">
                            <p class="font-heading text-2xl font-bold text-primary">1000+</p>
                            <p class="text-gray-500 text-sm">Pelanggan</p>
                        </div>
                        <div class="text-center">
                            <p class="font-heading text-2xl font-bold text-primary">50+</p>
                            <p class="text-gray-500 text-sm">Produk</p>
                        </div>
                        <div class="text-center">
                            <p class="font-heading text-2xl font-bold text-primary">4.9</p>
                            <p class="text-gray-500 text-sm">Rating</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Testimonials Section --}}
    <section class="py-20 bg-primary">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="text-secondary font-semibold text-sm uppercase tracking-wider">Testimoni</span>
                <h2 class="font-heading text-3xl md:text-4xl font-bold text-white mt-2">Apa Kata Mereka?</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @php
                    $testimonials = [
                        [
                            'name' => 'Ahmad Rizki',
                            'role' => 'Pendaki Pemula',
                            'text' =>
                                'Peralatan yang disewa sangat berkualitas dan terawat dengan baik. Sangat membantu perjalanan saya ke Gunung Sibayak.',
                        ],
                        [
                            'name' => 'Sarah Putri',
                            'role' => 'Travel Vloger',
                            'text' =>
                                'Pelayanan ramah dan harga terjangkau. Tenda yang saya sewa dalam kondisi prima. Highly recommended!',
                        ],
                        [
                            'name' => 'Budi Santoso',
                            'role' => 'Karyawan',
                            'text' =>
                                'Sudah 3 kali sewa di sini dan tidak pernah kecewa. Stok lengkap dan proses booking mudah.',
                        ],
                    ];
                @endphp

                @foreach ($testimonials as $testi)
                    <div class="glass rounded-2xl p-8">
                        <div class="flex items-center gap-1 mb-4">
                            @for ($i = 0; $i < 5; $i++)
                                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                            @endfor
                        </div>
                        <p class="text-gray-700 mb-6 leading-relaxed">"{{ $testi['text'] }}"</p>
                        <div class="flex items-center gap-4">
                            <div
                                class="w-12 h-12 bg-secondary rounded-full flex items-center justify-center text-white font-semibold">
                                {{ substr($testi['name'], 0, 1) }}
                            </div>
                            <div>
                                <p class="font-semibold text-primary">{{ $testi['name'] }}</p>
                                <p class="text-gray-500 text-sm">{{ $testi['role'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="py-20 bg-secondary">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="font-heading text-3xl md:text-4xl font-bold text-white mb-6">Siap Untuk Petualangan?</h2>
            <p class="text-white/80 text-xl mb-10 max-w-2xl mx-auto">
                Booking sekarang dan dapatkan diskon 10% untuk penyewaan pertama Anda!
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('products.index') }}"
                    class="bg-white text-primary px-8 py-4 rounded-2xl font-semibold text-lg transition transform hover:scale-105 hover:shadow-xl">
                    Mulai Booking
                </a>
                <a href="https://wa.me/6289601104497?text=halo kak Saya ingin Bertanya"
                    class="border-2 border-white text-white px-8 py-4 rounded-2xl font-semibold text-lg transition hover:bg-white hover:text-primary">
                    Hubungi Kami
                </a>
            </div>
        </div>
    </section>
@endsection
