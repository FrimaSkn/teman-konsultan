@extends('backend.layouts.app')

@section('title', __('Edit Category'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Edit Category')
        </x-slot>

        <x-slot name="headerActions">
            <x-utils.link
                class="card-header-action"
                :href="route('admin.services-category.index')"
                :text="__('Back')"
            />
        </x-slot>

        <x-slot name="body">
            <livewire:backend.services.category-edit />
        </x-slot>
    </x-backend.card>
@endsection
