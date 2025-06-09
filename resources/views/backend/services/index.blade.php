@extends('backend.layouts.app')

@section('title', __('Services'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Services')
        </x-slot>

        <x-slot name="headerActions">
            <x-utils.link
                icon="c-icon cil-plus"
                class="card-header-action"
                :href="route('admin.services.create')"
                :text="__('Create Service')"
            />
        </x-slot>

        <x-slot name="body">
            <livewire:backend.services.services-table />
        </x-slot>
    </x-backend.card>



@endsection
