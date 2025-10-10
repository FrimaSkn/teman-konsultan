@extends('backend.layouts.app')

@section('title', __('Subscription'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Subscriptions')
        </x-slot>

        <x-slot name="body">
            <livewire:backend.subscription-form />
        </x-slot>
    </x-backend.card>
@endsection

