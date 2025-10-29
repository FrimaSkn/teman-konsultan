@extends('frontend.layouts.dashboard')

@section('title', __('Transactions'))

@section('content')
    <div class="container py-4 transaction">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <x-frontend.card>
                    <x-slot name="header">
                        @lang('Transactions')
                    </x-slot>

                    <x-slot name="body">
                        <div>
                            <table>
                                <tr>
                                    <td>Order Number</td>
                                    <td class="p-2">:</td>
                                    <th scope="row">{{ $order->order_number }}</th>
                                </tr>
                                <tr>
                                    <td>Total Amount</td><td class="p-2">:</td><td>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td class="p-2">:</td>
                                    <td>
                                        @switch($order->status)
                                            @case('pending')
                                                <span class="badge badge-pill badge-secondary">Paid</span>
                                                @break

                                            @case('paid')
                                                <span class="badge badge-pill badge-success">Paid</span>
                                                @break

                                            @case('cancelled')
                                                <span class="badge badge-pill badge-danger">Cancelled</span>
                                                @break
                                            @default
                                            -
                                        @endswitch
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <div class="mt-5 table-responsive">
                            <div>List Items:</div>
                            <ul class="list-group">
                                @foreach ($order->orderItems as $item)
                                    @php
                                        $payload = json_decode($item->payload);
                                    @endphp
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-sm align-items-center">
                                                <div class="text-sm text-gray-500">{{ $item->package->category->name }}</div>
                                                <span class="text-lg font-semibold">
                                                    {{ $item->package->title }}
                                                </span>
                                                <span class="text-sm text-secondary">
                                                    {!! get_sub_package($item->package, $payload->type, $payload->sub_package_key) !!}
                                                </span>
                                            </div>
                                            <div class="text-center align-items-center col-sm align-self-center">
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
                                                <div class="font-semibold col-sm">{{ $item->quantity }}</div>
                                            </div>
                                            <div class="text-right col-sm align-self-center">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</div>
                                        </div>
                                    </li>
                                @endforeach
                                <li class="text-right list-group-item">
                                    <span class="font-semibold">Total:</span>
                                    <span class="font-semibold">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                                </li>
                            </ul>
                        </div>
                    </x-slot>
                </x-frontend.card>
            </div><!--col-md-10-->
        </div><!--row-->
    </div><!--container-->
@endsection
