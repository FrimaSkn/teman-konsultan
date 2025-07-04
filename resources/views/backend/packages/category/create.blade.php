@extends('backend.layouts.app')

@section('title', __('Package Category Management'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Create Category Packages')
        </x-slot>

        <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.packages.category.index')" :text="__('Cancel')" />
        </x-slot>

        <x-slot name="body">
            <livewire:backend.packages.category-create />
        </x-slot>
    </x-backend.card>
@endsection
