@extends('layouts.auth')

@section('title', 'Masuk')

@section('content')
    <div>
        <h1 class="font-heading text-3xl font-bold text-primary mb-2">Selamat Datang!</h1>
        <p class="text-gray-500 mb-8">Masuk ke akun Anda untuk melanjutkan</p>

        {{-- Alert --}}
        @if (session('status'))
            <div class="bg-green-100 text-green-700 px-4 py-3 rounded-xl mb-6">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 px-4 py-3 rounded-xl mb-6">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST" class="space-y-6">
            @csrf

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
                    <input type="email" name="email" required autofocus value="{{ old('email') }}"
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
                        placeholder="********">
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

            {{-- Remember & Forgot --}}
            <div class="flex items-center justify-between">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="remember"
                        class="w-4 h-4 text-secondary rounded border-gray-300 focus:ring-secondary">
                    <span class="text-sm text-gray-600">Ingat saya</span>
                </label>
                <a href="{{ route('password.request') }}" class="text-sm text-secondary hover:underline">Lupa password?</a>
            </div>

            {{-- Submit --}}
            <button type="submit"
                class="w-full bg-secondary hover:bg-secondary/90 text-white py-4 rounded-xl font-semibold transition transform hover:scale-[1.02]">
                Masuk
            </button>
        </form>


        {{-- Register Link --}}
        <p class="text-center text-gray-500 mt-8">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-secondary font-semibold hover:underline">Daftar sekarang</a>
        </p>
    </div>

    <script>
        function togglePassword(btn) {
            const input = btn.previousElementSibling;
            input.type = input.type === 'password' ? 'text' : 'password';
        }
    </script>
@endsection
