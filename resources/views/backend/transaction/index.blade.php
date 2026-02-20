@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Transaction')
        </x-slot>

        <x-slot name="body">
            <div class="transaction-table">
                <livewire:backend.transaction-table />
            </div>
        </x-slot>
    </x-backend.card>
@endsection
