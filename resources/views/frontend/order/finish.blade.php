@extends('frontend.layouts.app')

@section('title', __('Order Finished'))

@section('content')
    <div class="min-h-[calc(100vh-350px)] container py-10">
        <div>
            <div class="flex items-center justify-center gap-4">
                <i data-lucide="circle-check-big" class="text-success size-10"></i>
                <h3 class="text-3xl font-bold text-center text-success">Payment Successful !</h3>
            </div>
            <p class="mt-4 text-center">Thank you for your purchase. Your order has been successfully processed.</p>
            <p class="text-center">We have received your membership request.</p>
        </div>
        <div class="p-8 mt-8 bg-white rounded-lg shadow-md">
            <div class="text-lg font-semibold">Order Summary</div>
            <div class="text-sm text-gray-500">#{{ $order->order_number }}</div>

            <div>
                <ul class="mt-4 space-y-2 divide-y-2">
                    @foreach ($order->orderItems as $item)
                        <li class="grid items-center justify-between grid-cols-3">
                            <div>
                                <span class="text-lg font-semibold">
                                    {{ $item->package->title }}
                                </span>
                                <div class="text-sm text-gray-500">{{ $item->package->category->name }}</div>
                            </div>
                            <div class="text-center">
                                @switch($item->contract_type)
                                    @case('daily')
                                        <span>Subscription / day:</span>
                                        @break
                                    @case('monthly')
                                        <span>Subscription / month:</span>
                                        @break
                                    @case('yearly')
                                        <span>Subscription / year:</span>
                                        @break
                                    @case('periode')
                                        <span>Subscription / Periode:</span>
                                        @break
                                    @case('once')
                                        <span>Subscription / One time:</span>
                                        @break

                                    @default
                                        <span>Subscription / Package:</span>
                                        @break
                                @endswitch
                                <div class="font-semibold">{{ $item->quantity }}</div>
                            </div>
                            <div class="justify-self-end">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</div>
                        </li>
                    @endforeach
                    <li class="flex justify-between">
                        <span class="font-semibold">Total:</span>
                        <span class="font-semibold">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="flex justify-center mt-8">
            <a href="{{ route('frontend.user.transaction.index') }}" class="px-4 pt-1 pb-1.5 uppercase bg-secondary rounded-lg hover:bg-opacity-90 text-primary font-bold text-nowrap inline-flex items-center mt-2 max-md:text-sm md:mt-4">History Transaction</a>
        </div>
    </div>
@endsection
