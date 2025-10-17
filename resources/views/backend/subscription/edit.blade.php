@extends('backend.layouts.app')

@section('title', __('Edit Subscription'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Edit Subscriptions')
        </x-slot>

        <x-slot name="body">
            <div class="mb-4 text-yellow-300">Note: can update only Start Date and End Date</div>
            <livewire:backend.subscription-edit :record="$subscription" />
        </x-slot>
    </x-backend.card>
@endsection

