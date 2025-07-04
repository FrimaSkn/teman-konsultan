@extends('backend.layouts.app')

@section('title', __('Package Management'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Create Packages')
        </x-slot>

        <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.packages.index')" :text="__('Cancel')" />
        </x-slot>

        <x-slot name="body">
            <livewire:backend.packages.package-create />
        </x-slot>
    </x-backend.card>
@endsection
