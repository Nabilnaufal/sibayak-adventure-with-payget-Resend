@extends('layouts.app')

@section('title', 'Keranjang')

@section('content')
    <section class="pt-32 pb-12 bg-sand">
        <div class="max-w-5xl mx-auto px-4">

            <h1 class="text-3xl font-bold text-primary mb-8">Keranjang</h1>

            @if (session('cart') && count(session('cart')) > 0)
                <div class="space-y-6">

                    @foreach (session('cart') as $id => $item)
                        <div class="bg-white p-6 rounded-xl shadow flex items-center justify-between gap-6">

                            {{-- LEFT --}}
                            <div class="flex items-center gap-4">

                                {{-- IMAGE --}}
                                <div class="w-24 h-24 rounded-xl overflow-hidden bg-gray-100">
                                    @if (!empty($item['image']))
                                        <img src="{{ asset($item['image']) }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-gray-400 text-sm">
                                            No Image
                                        </div>
                                    @endif
                                </div>


                                <div>
                                    <h2 class="font-semibold text-lg">{{ $item['name'] }}</h2>
                                    <p class="text-gray-500">Rp {{ number_format($item['price']) }} / hari</p>
                                    <div class="flex items-center gap-2 mt-2">

                                        {{-- minus --}}
                                        <form action="{{ route('cart.decrease', $id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                class="w-8 h-8 rounded bg-gray-200 flex items-center justify-center">
                                                -
                                            </button>
                                        </form>

                                        {{-- quantity --}}
                                        <span class="w-10 text-center">
                                            {{ $item['quantity'] }}
                                        </span>

                                        {{-- plus --}}
                                        <form action="{{ route('cart.increase', $id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                class="w-8 h-8 rounded bg-gray-200 flex items-center justify-center">
                                                +
                                            </button>
                                        </form>

                                    </div>
                                </div>

                            </div>


                            <div class="flex items-center gap-4">
                                <p class="font-bold text-secondary">
                                    Rp {{ number_format($item['price'] * $item['quantity']) }}
                                </p>

                                <form action="{{ route('cart.remove', $id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-500 hover:underline">Hapus</button>
                                </form>
                            </div>

                        </div>
                    @endforeach


                    @php
                        $total = 0;
                        foreach (session('cart') as $item) {
                            $total += $item['price'] * $item['quantity'];
                        }
                    @endphp

                    <div class="bg-white p-6 rounded-xl shadow flex justify-between">
                        <span class="font-bold text-lg">Total</span>
                        <span class="font-bold text-secondary text-xl">
                            Rp {{ number_format($total) }}
                        </span>
                    </div>


                    <a href="{{ route('booking.create') }}"
                        class="block text-center bg-secondary text-white py-4 rounded-xl font-semibold">
                        Lanjut Checkout
                    </a>

                </div>
            @else
                <p class="text-gray-500">Keranjang kosong</p>
            @endif

        </div>
    </section>
@endsection
