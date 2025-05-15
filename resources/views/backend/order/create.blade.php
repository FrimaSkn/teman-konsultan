@extends('backend.layouts.app')

@section('title', __('Orders Management'))

@section('content')

    <x-backend.card>
        <x-slot name="header">
            @lang('Create Orders')
        </x-slot>

        <x-slot name="body">

            <x-forms.post :action="route('admin.order.store')">
                {{-- User Selection --}}
                @livewire('utils.order.user-select-component')

            </x-forms.post>

        </x-slot>
    </x-backend.card>

@endsection

@push('after-styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('after-scripts')

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>



@endpush
