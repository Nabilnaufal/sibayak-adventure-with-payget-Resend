@extends('layouts.app')

@section('title', 'Booking')

@section('content')
    {{-- Header --}}
    <section class="pt-32 pb-8 bg-primary">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="font-heading text-3xl md:text-4xl font-bold text-white mb-4">Konfirmasi Booking</h1>
            <p class="text-white/70">Lengkapi data berikut untuk melanjutkan penyewaan</p>
        </div>
    </section>

    {{-- Booking Form --}}
    <section class="py-12 bg-sand">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                {{-- Form --}}
                <div class="lg:col-span-2">
                    <form action="{{ route('booking.store') }}" method="POST" class="space-y-8 form-booking"
                        id="booking-form">
                        @csrf
                        @php
                            $firstItem = reset($cart);
                        @endphp



                        {{-- Product Info Card --}}
                        <div class="glass rounded-2xl p-6">
                            <h2 class="font-heading font-semibold text-lg text-primary mb-6">Produk yang Disewa</h2>
                            <div class="space-y-4">
                                @foreach ($cart as $item)
                                    <div class="flex gap-6 glass rounded-2xl p-4">

                                        {{-- IMAGE --}}
                                        <div class="w-32 h-32 rounded-xl overflow-hidden shrink-0">
                                            @if (!empty($item['image']))
                                                <img src="{{ asset($item['image']) }}" class="w-full h-full object-cover">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center text-gray-400">
                                                    No Image
                                                </div>
                                            @endif
                                        </div>

                                        {{-- INFO --}}
                                        <div class="flex-1">
                                            <h3 class="font-heading font-semibold text-xl text-primary">
                                                {{ $item['name'] }}
                                            </h3>

                                            <p class="text-gray-500 mt-2">
                                                Jumlah: {{ $item['quantity'] }}
                                            </p>

                                            <p class="text-secondary font-bold text-lg mt-3">
                                                Rp {{ number_format($item['price'], 0, ',', '.') }}
                                                <span class="text-sm text-gray-500">/hari</span>
                                            </p>
                                        </div>

                                    </div>
                                @endforeach
                            </div>

                        </div>



                        {{-- Rental Details --}}
                        <div class="glass rounded-2xl p-6">
                            <h2 class="font-heading font-semibold text-lg text-primary mb-6">Detail Penyewaan</h2>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                {{-- Start Date --}}
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Mulai <span
                                            class="text-red-500">*</span></label>
                                    <input type="date" name="start_date" required min="{{ date('Y-m-d') }}"
                                        value="{{ request('start_date') }}"
                                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-secondary focus:ring-secondary"
                                        id="start_date">
                                    @error('start_date')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- End Date --}}
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Selesai <span
                                            class="text-red-500">*</span></label>
                                    <input type="date" name="end_date" required
                                        min="{{ date('Y-m-d', strtotime('+1 day')) }}" value="{{ request('end_date') }}"
                                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-secondary focus:ring-secondary"
                                        id="end_date">
                                    @error('end_date')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Quantity --}}


                                {{-- Duration Display --}}
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Durasi Sewa</label>
                                    <div class="px-4 py-3 bg-gray-50 rounded-xl border border-gray-200">
                                        <span id="duration" class="font-semibold text-primary">0</span> hari
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Customer Info --}}
                        <div class="glass rounded-2xl p-6">
                            <h2 class="font-heading font-semibold text-lg text-primary mb-6">Data Penyewa</h2>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap <span
                                            class="text-red-500">*</span></label>
                                    <input type="text" name="name" required
                                        value="{{ auth()->user()->name ?? old('name') }}"
                                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-secondary focus:ring-secondary"
                                        placeholder="Masukkan nama lengkap">
                                    @error('name')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Email <span
                                            class="text-red-500">*</span></label>
                                    <input type="email" name="email" required
                                        value="{{ auth()->user()->email ?? old('email') }}"
                                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-secondary focus:ring-secondary"
                                        placeholder="email@example.com">
                                    @error('email')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">No. Telepon <span
                                            class="text-red-500">*</span></label>
                                    <input type="tel" name="phone" required
                                        value="{{ auth()->user()->phone ?? old('phone') }}"
                                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-secondary focus:ring-secondary"
                                        placeholder="08xxxxxxxxxx">
                                    @error('phone')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">No. KTP <span
                                            class="text-red-500">*</span></label>
                                    <input type="text" name="ktp_number" required value="{{ old('ktp_number') }}"
                                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-secondary focus:ring-secondary"
                                        placeholder="Nomor KTP">
                                    @error('ktp_number')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Alamat <span
                                            class="text-red-500">*</span></label>
                                    <textarea name="address" rows="3" required
                                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-secondary focus:ring-secondary"
                                        placeholder="Alamat lengkap">{{ old('address') }}</textarea>
                                    @error('address')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Catatan (Opsional)</label>
                                    <textarea name="note" rows="2"
                                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-secondary focus:ring-secondary"
                                        placeholder="Catatan tambahan untuk penyewaan">{{ old('note') }}</textarea>
                                </div>
                            </div>
                        </div>
                        @foreach ($cart as $id => $item)
                            <input type="hidden" name="products[{{ $loop->index }}][product_id]"
                                value="{{ $id }}">
                            <input type="hidden" name="products[{{ $loop->index }}][quantity]"
                                value="{{ $item['quantity'] }}">
                        @endforeach
                        {{-- Submit Button (Mobile) --}}
                        <div class="lg:hidden">
                            <button type="submit"
                                class="w-full bg-secondary hover:bg-secondary/90 text-white py-4 rounded-2xl font-semibold text-lg transition transform hover:scale-[1.02] hover:shadow-xl">
                                Konfirmasi Booking
                            </button>
                        </div>
                    </form>
                </div>


                {{-- Price Summary --}}
                <div class="lg:col-span-1">
                    <div class="glass rounded-2xl p-6 sticky top-28">
                        <h2 class="font-heading font-semibold text-lg text-primary mb-6">Ringkasan Harga</h2>

                        <div class="space-y-4 mb-6">
                            <div class="flex justify-between">

                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Jumlah unit</span>
                                <span class="font-medium" id="summary_quantity">1</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Durasi sewa</span>
                                <span class="font-medium"><span id="summary_duration">0</span> hari</span>
                            </div>
                            <hr class="border-gray-200">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Subtotal</span>
                                <span class="font-medium">Rp <span id="subtotal">0</span></span>
                            </div>

                        </div>

                        <hr class="border-gray-200 mb-6">

                        <div class="flex justify-between items-center mb-8">
                            <span class="font-heading font-semibold text-lg text-primary">Total</span>
                            <span class="font-heading font-bold text-2xl text-secondary">Rp <span
                                    id="total">100.000</span></span>
                        </div>

                        <button type="submit" form="booking-form"
                            class="hidden lg:flex w-full bg-secondary hover:bg-secondary/90 text-white py-4 rounded-2xl font-semibold text-lg transition transform hover:scale-[1.02] hover:shadow-xl items-center justify-center gap-3">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Konfirmasi Booking
                        </button>

                        <p class="text-gray-500 text-xs text-center mt-4">
                            Dengan melakukan booking, Anda menyetujui <a href="#" onclick="showSyarat(event)"
                                class="text-secondary hover:underline">Syarat & Ketentuan</a> kami.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
        <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
        </script>

        <script>
            @if (session('snap_token'))
                window.onload = function() {
                    snap.pay('{{ session('snap_token') }}', {
                        onSuccess: function(result) {
                            window.location.href = "/booking/success/{{ session('booking_id') }}";
                        },
                        onPending: function(result) {
                            window.location.href = "/booking/success/{{ session('booking_id') }}";
                        },
                        onError: function(result) {
                            alert("Pembayaran gagal!");
                        }
                    });
                }
            @endif
        </script>
        <script>
            const cart = @json($cart);

            function formatNumber(num) {
                return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }

            function calculatePrice() {
                const startDate = document.getElementById('start_date').value;
                const endDate = document.getElementById('end_date').value;

                let duration = 0;
                if (startDate && endDate) {
                    const start = new Date(startDate);
                    const end = new Date(endDate);
                    const diffTime = Math.abs(end - start);
                    duration = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;
                }

                let subtotal = 0;
                let totalQty = 0;

                for (let id in cart) {
                    const item = cart[id];
                    subtotal += item.price * item.quantity * duration;
                    totalQty += item.quantity;
                }

                document.getElementById('duration').textContent = duration;
                document.getElementById('summary_quantity').textContent = totalQty;
                document.getElementById('summary_duration').textContent = duration;
                document.getElementById('subtotal').textContent = formatNumber(subtotal);
                document.getElementById('total').textContent = formatNumber(subtotal);
            }

            document.getElementById('start_date').addEventListener('change', calculatePrice);
            document.getElementById('end_date').addEventListener('change', calculatePrice);

            calculatePrice();
        </script>
    @endpush
@endsection
