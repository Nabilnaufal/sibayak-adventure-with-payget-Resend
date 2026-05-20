@extends('layouts.app')

@section('title', 'Profil')

@section('content')
    {{-- Header --}}
    <section class="pt-32 pb-8 bg-primary">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="font-heading text-3xl md:text-4xl font-bold text-white mb-2">Profil Saya</h1>
            <p class="text-white/70">Kelola informasi profil Anda</p>
        </div>
    </section>

    {{-- Main Content --}}
    <section class="py-12 bg-sand">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Alert --}}
            @if (session('success'))
                <div x-data="{ show: true }" x-show="show"
                    class="flex items-center justify-between bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded-xl mb-4">

                    <span>{{ session('success') }}</span>

                    <button @click="show = false" class="ml-4 text-green-700 hover:text-green-900">
                        ✕
                    </button>
                </div>
            @endif


            {{-- Profile Form --}}
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="glass rounded-2xl p-8 mb-8">
                    <h2 class="font-heading font-semibold text-lg text-primary mb-6">Informasi Pribadi</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                            <input type="text" name="name" value="{{ auth()->user()->name ?? old('name') }}"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-secondary focus:ring-secondary">
                            @error('name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                            <input type="email" name="email" value="{{ auth()->user()->email ?? old('email') }}"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-secondary focus:ring-secondary">
                            @error('email')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                    <div class="mt-6">
                        <button type="submit"
                            class="bg-secondary hover:bg-secondary/90 text-white px-8 py-3 rounded-xl font-medium transition">
                            Simpan Perubahan
                        </button>
                    </div>
                </div>
            </form>

            {{-- Change Password --}}
            <form action="{{ route('password.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="glass rounded-2xl p-8 mb-8">
                    <h2 class="font-heading font-semibold text-lg text-primary mb-6">Ubah Password</h2>

                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Password Saat Ini</label>
                            <input type="password" name="current_password"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-secondary focus:ring-secondary"
                                placeholder="********">
                            @error('current_password')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Password Baru</label>
                            <input type="password" name="password"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-secondary focus:ring-secondary"
                                placeholder="Min. 8 karakter">
                            @error('password')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password Baru</label>
                            <input type="password" name="password_confirmation"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-secondary focus:ring-secondary"
                                placeholder="Ulangi password baru">
                        </div>
                    </div>

                    <div class="mt-6">
                        <button type="submit"
                            class="bg-primary hover:bg-primary/90 text-white px-8 py-3 rounded-xl font-medium transition">
                            Ubah Password
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
