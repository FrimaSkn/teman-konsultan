@extends('frontend.layouts.app')

@section('title', __('Checkout'))

@section('content')
    <div class="min-h-[calc(100vh-350px)]">
        <div id="checout" class="container py-4 mx-auto space-y-8">
            <h1 class="text-2xl font-bold text-center">Checkout</h1>
            <div class="font-semibold">Order ID: {{ $order->order_number }}</div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Name Paket</th>
                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Category</th>
                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Subcription</th>
                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Quantity</th>
                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Price</th>
                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Subtotal</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($order->orderItems as $item )
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $item->package->title }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $item->package->category->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $item->contract_type ?? 'Package' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $item->quantity }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                        <tr>
                            <td colspan="4"></td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="font-medium">Total Amount: </div>
                                <div class="font-semibold">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</div>
                            </td>
                        </tr>
                    <!-- More rows -->
                    </tbody>
                </table>
            </div>
            <div class="flex justify-center">
                <button id="pay-button" class="px-4 pt-1 pb-1.5 uppercase bg-secondary rounded-lg hover:bg-opacity-90 text-primary font-bold text-nowrap inline-flex items-center mt-2 max-md:text-sm md:mt-4">Pay Now</button>
            </div>
        </div>
    </div>
@endsection

@push('after-scripts')
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
    <script>
        console.log('script loaded');

        const snapToken = '{{ $snapToken }}';

        window.onload = function() {

         document.getElementById('pay-button').onclick = function() {
                fetch("{{ route('frontend.order.payment.status') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        _token: '{{ csrf_token() }}',
                        order_id: '{{ $order->order_number }}',
                    }),
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);

                        snap.pay(snapToken, {
                            onSuccess: function(result) {
                                if (result.transaction_status === 'capture' || result.transaction_status === 'settlement') {

                                    document.getElementById('pay-button').style.display = 'none';

                                    fetch("{{ route('frontend.order.payment.store') }}", {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                        },
                                        body: JSON.stringify({
                                            _token: '{{ csrf_token() }}',
                                            ...result, // Kirim seluruh objek result sebagai bagian dari body
                                        }),
                                    })
                                    .then(response => response.json())
                                    .then(data => {
                                        if (data.success) {
                                            window.location.href = "{{ route('frontend.order.finish', $order->order_number) }}";
                                        } else {
                                            alert('Payment processing failed. Please contact support.');
                                        }
                                    })

                                    console.log('in if' ,result);
                                }

                                console.log('out if', result);

                                // Tangani jika pembayaran berhasil
                            },
                            onPending: function(result) {
                                // Tangani jika pembayaran pending
                                    console.log(result);
                            },
                            onError: function(result) {
                                // Tangani jika pembayaran gagal
                                    console.log(result);
                            }
                        });


                })


         };
     }
    </script>
@endpush
