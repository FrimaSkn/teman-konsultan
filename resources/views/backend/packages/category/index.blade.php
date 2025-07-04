@extends('backend.layouts.app')

@section('title', __('Package Category Management'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Category Packages')
        </x-slot>

        <x-slot name="headerActions">
            <x-utils.link
                icon="c-icon cil-plus"
                class="card-header-action"
                :href="route('admin.packages.category.create')"
                :text="__('Create Category')"
            />
        </x-slot>

        <x-slot name="body">
            <livewire:backend.packages.category-table />
        </x-slot>
    </x-backend.card>
@endsection
