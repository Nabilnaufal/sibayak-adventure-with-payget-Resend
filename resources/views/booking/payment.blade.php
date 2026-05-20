@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center">
    <button id="pay-button" class="bg-blue-500 text-white px-6 py-3 rounded">
        Bayar Sekarang
    </button>
</div>

<script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}"></script>

<script>
document.getElementById('pay-button').onclick = function () {
    snap.pay('{{ $snapToken }}', {
        onSuccess: function(result){
            window.location.href = '/booking/success/{{ $booking->id }}';
        },
        onPending: function(result){
            alert("Menunggu pembayaran");
        },
        onError: function(result){
            alert("Pembayaran gagal");
        }
    });
};
</script>
@endsection