@extends('frontend.layouts.app')

@section('title', __('Complete Payment'))

@section('content')
    <div>
        <div class="container mx-auto py-4">
            <button id="pay-button">Pay Now</button>
        </div>
    </div>
@endsection

@push('after-scripts')
    <script>

        const snapToken = '{{ $snapToken }}';

    document.getElementById('pay-button').onclick = function() {
        snap.pay(snapToken, {
            onSuccess: function(result) {
                // Tangani jika pembayaran berhasil
            },
            onPending: function(result) {
                // Tangani jika pembayaran pending
            },
            onError: function(result) {
                // Tangani jika pembayaran gagal
            }
        });
    };

    </script>
@endpush
