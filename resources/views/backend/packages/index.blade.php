@extends('backend.layouts.app')

@section('title', __('Packages Management'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Packages')
        </x-slot>

        <x-slot name="headerActions">
            <x-utils.link
                icon="c-icon cil-plus"
                class="card-header-action"
                :href="route('admin.packages.create')"
                :text="__('Create Packages')"
            />
        </x-slot>

        <x-slot name="body">
            <livewire:backend.packages.packages-table />
        </x-slot>
    </x-backend.card>
@endsection
