@extends('layouts.auth')

@section('title', 'Verifikasi Email')

@section('content')
<div class="text-center">
    <h1 class="text-2xl font-bold mb-4">Verifikasi Email</h1>
    <p class="text-gray-600 mb-6">
        Kami sudah mengirim link verifikasi ke email kamu.
        Silakan cek inbox dan klik link tersebut.
    </p>

    @if (session('status') == 'verification-link-sent')
        <div class="text-green-600 mb-4">
            Link verifikasi baru sudah dikirim!
        </div>
    @endif

    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit"
            class="bg-secondary text-white px-6 py-3 rounded-xl">
            Kirim Ulang Email
        </button>
    </form>

    <form method="POST" action="{{ route('logout') }}" class="mt-4">
        @csrf
        <button type="submit" class="text-red-500">
            Logout
        </button>
    </form>
</div>
@endsection
