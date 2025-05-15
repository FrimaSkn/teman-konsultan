@extends('backend.layouts.app')

@section('title', __('Orders Management'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Orders Management')
        </x-slot>

        @if ($logged_in_user->hasAllAccess())
            <x-slot name="headerActions">
                <x-utils.link
                    icon="c-icon cil-plus"
                    class="card-header-action"
                    :href="route('admin.order.create')"
                    :text="__('Create Order')"
                />
            </x-slot>
        @endif

        <x-slot name="body">
            <livewire:backend.order-table />
        </x-slot>
    </x-backend.card>
@endsection
