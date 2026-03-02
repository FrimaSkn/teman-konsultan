@extends('frontend.layouts.dashboard')

@section('title', __('Dashboard'))

@section('content')
    <div class="container py-4">
        <div class="mb-4 row justify-content-center">
            <div class="col-md-12">
                <x-frontend.card>
                    <x-slot name="header">
                        @lang('Dashboard')
                    </x-slot>

                    <x-slot name="body">
                        <div class="row">
                            <div class="col-md">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="text-center card-title">Total Transaction</h5>
                                        <p class="text-center card-text">{{ $totalTransactions }}</p>
                                        <div class="text-center">
                                            <a href="{{ route('frontend.user.transaction.index') }}" class="btn btn-primary">Transaction</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="text-center card-title">Total Subscription</h5>
                                        <p class="text-center card-text">{{ $totalSubscriptions }}</p>
                                        <div class="text-center">
                                            <a href="{{ route('frontend.user.subscription.index') }}" class="btn btn-primary">Subscription</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </x-slot>
                </x-frontend.card>
            </div><!--col-md-10-->
        </div><!--row-->

        <div class="mb-4 row justify-content-center">
            <div class="col-md-12">
                <x-frontend.card>
                    <x-slot name="header">
                        @lang('Recent Transactions')
                    </x-slot>

                    <x-slot name="body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Order number</th>
                                    <th scope="col">status</th>
                                    <th scope="col">Total Amount</th>
                                    <th scope="col">Created at</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($latestTransactions as $transaction)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $transaction->order_number }}</td>
                                        <td>
                                            @switch($transaction->status)
                                                @case('paid')
                                                    <span class="text-white badge bg-success">Paid</span>
                                                    @break
                                                @case('expired')
                                                    <span class="text-white badge bg-secondary">Expired</span>
                                                    @break
                                                @case('failed')
                                                    <span class="text-white badge bg-danger">Failed</span>
                                                    @break
                                                @default
                                                <span class="badge bg-warning text-dark">Pending</span>
                                                @break
                                            @endswitch
                                        </td>
                                        <td>Rp. {{  number_format($transaction->total_amount, 0, ',', '.') }}</td>
                                        <td>{{ $transaction->created_at->format('d M Y H:i') }}</td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </x-slot>
                </x-frontend.card>
            </div><!--col-md-10-->
        </div><!--row-->

        <div class="row justify-content-center">
            <div class="col-md-12">
                <x-frontend.card>
                    <x-slot name="header">
                        @lang('Recent Subscriptions')
                    </x-slot>

                    <x-slot name="body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Package Name</th>
                                    <th scope="col">Notes</th>
                                    <th scope="col">Subscription Number</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Contract type</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Started at</th>
                                    <th scope="col">Expired at</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($latestSubscriptions as $subscription)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $subscription->orderItem->package->category->name }}</td>
                                        <td>{{ $subscription->orderItem->package->title }}</td>
                                        <td>{{ $subscription->note ?? 'NULL' }}</td>
                                        <td>{{ $subscription->subscription_number }}</td>
                                        <td>
                                            @if ($subscription->ended_at == null && $subscription->started_at == null)
                                                @php
                                                    $subscription->status = 'Inactive';
                                                @endphp
                                                <span class="pt-1 badge badge-pill badge-secondary">{{ $subscription->status }}</span>
                                            @else
                                                @if (\Carbon\Carbon::now()->format('Y-m-d') <= $subscription->ended_at && \Carbon\Carbon::now()->format('Y-m-d') >= $subscription->started_at)
                                                    @php
                                                    $subscription->status = 'Active';
                                                    @endphp
                                                    <span class="pt-1 badge badge-pill badge-success">{{ $subscription->status }}</span>
                                                @elseif (\Carbon\Carbon::now()->format('Y-m-d') < $subscription->started_at)
                                                    @php
                                                        $subscription->status = 'Inactive';
                                                    @endphp
                                                    <span class="pt-1 badge badge-pill badge-secondary">{{ $subscription->status }}</span>
                                                @else
                                                    @php
                                                        $subscription->status = 'Expired';
                                                    @endphp
                                                    <span class="pt-1 badge badge-pill badge-danger">{{ $subscription->status }}</span>
                                                @endif
                                            @endif
                                        </td>
                                        <td>
                                            @switch($subscription->contract_type)
                                                @case('daily')
                                                    Daily
                                                    @break
                                                @case('monthly')
                                                    Monthly
                                                    @break
                                                @case('yearly')
                                                    Yearly
                                                    @break
                                                @case('periode')
                                                    Periode
                                                    @break
                                                @case('once')
                                                    Once
                                                    @break
                                                @default
                                                    Package
                                                    @break
                                            @endswitch
                                        </td>
                                        <td>{{ $subscription->orderItem->quantity }}</td>
                                        <td>
                                            @if ($subscription->started_at)
                                                {{  date('d M Y', strtotime($subscription->started_at)) }}
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>
                                            @if ($subscription->ended_at)
                                                {{ date('d M Y' ,strtotime($subscription->ended_at)) }}
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </x-slot>
                </x-frontend.card>
            </div><!--col-md-10-->
        </div><!--row-->
    </div><!--container-->
@endsection
