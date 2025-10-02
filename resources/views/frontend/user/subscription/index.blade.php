@extends('frontend.layouts.dashboard')

@section('title', __('Subscriptions'))

@section('content')
    <div class="container py-4 transaction">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <x-frontend.card>
                    <x-slot name="header">
                        @lang('Subscriptions')
                    </x-slot>

                    <x-slot name="body">
                        <livewire:frontend.subscription-table />
                    </x-slot>
                </x-frontend.card>
            </div><!--col-md-10-->
        </div><!--row-->
    </div><!--container-->
@endsection
