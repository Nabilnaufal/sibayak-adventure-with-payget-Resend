@extends('layouts.auth')

@section('title', 'Daftar')

@section('content')
    <div>
        <h1 class="font-heading text-3xl font-bold text-primary mb-2">Buat Akun</h1>
        <p class="text-gray-500 mb-8">Daftar untuk mulai menyewa peralatan hiking</p>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 px-4 py-3 rounded-xl mb-6">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register') }}" method="POST" class="space-y-5">
            @csrf

            {{-- Name --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <input type="text" name="name" required autofocus value="{{ old('name') }}"
                        class="w-full pl-12 pr-4 py-3 rounded-xl border border-gray-200 focus:border-secondary focus:ring-secondary"
                        placeholder="naufal nabil">
                </div>
            </div>

            {{-- Email --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <input type="email" name="email" required value="{{ old('email') }}"
                        class="w-full pl-12 pr-4 py-3 rounded-xl border border-gray-200 focus:border-secondary focus:ring-secondary"
                        placeholder="email@example.com">
                </div>
            </div>



            {{-- Password --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <input type="password" name="password" required
                        class="w-full pl-12 pr-12 py-3 rounded-xl border border-gray-200 focus:border-secondary focus:ring-secondary"
                        placeholder="Min. 8 karakter">
                    <button type="button" onclick="togglePassword(this)"
                        class="absolute inset-y-0 right-0 pr-4 flex items-center">
                        <svg class="w-5 h-5 text-gray-400 hover:text-gray-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                </div>
            </div>

            {{-- Confirm Password --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <input type="password" name="password_confirmation" required
                        class="w-full pl-12 pr-4 py-3 rounded-xl border border-gray-200 focus:border-secondary focus:ring-secondary"
                        placeholder="Ulangi password">
                </div>
            </div>

            {{-- Terms --}}
            <div>
                <label class="flex items-start gap-3 cursor-pointer">
                    <input type="checkbox" name="terms" required
                        class="w-4 h-4 mt-1 text-secondary rounded border-gray-300 focus:ring-secondary">
                    <span class="text-sm text-gray-600">
                        Saya menyetujui <a href="#" class="text-secondary hover:underline">Syarat & Ketentuan</a>
                        serta
                        <a href="#" class="text-secondary hover:underline">Kebijakan Privasi</a>
                    </span>
                </label>
            </div>

            {{-- Submit --}}
            <button type="submit"
                class="w-full bg-secondary hover:bg-secondary/90 text-white py-4 rounded-xl font-semibold transition transform hover:scale-[1.02]">
                Daftar
            </button>
        </form>


        {{-- Login Link --}}
        <p class="text-center text-gray-500 mt-8">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-secondary font-semibold hover:underline">Masuk di sini</a>
        </p>
    </div>

    <script>
        function togglePassword(btn) {
            const input = btn.previousElementSibling;
            input.type = input.type === 'password' ? 'text' : 'password';
        }
    </script>
@endsection
