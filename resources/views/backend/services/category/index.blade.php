@extends('backend.layouts.app')

@section('title', __('Category Management'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Category Services')
        </x-slot>

        <x-slot name="headerActions">
            <x-utils.link
                icon="c-icon cil-plus"
                class="card-header-action"
                :href="route('admin.services-category.create')"
                :text="__('Create Category')"
            />
        </x-slot>

        <x-slot name="body">
            {{-- <livewire:backend.services-category-table /> --}}
            <livewire:backend.services.category-table />
        </x-slot>
    </x-backend.card>
@endsection
