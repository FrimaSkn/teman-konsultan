@extends('backend.layouts.app')

@section('title', __('Subscription'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Subscriptions')
        </x-slot>

        <x-slot name="headerActions">
            <x-utils.link
                icon="c-icon cil-plus"
                class="card-header-action"
                :href="route('admin.subscription.create')"
                :text="__('Create Subscription')"
            />
        </x-slot>

        <x-slot name="body">
            <livewire:backend.subscription-table />
        </x-slot>
    </x-backend.card>
@endsection
