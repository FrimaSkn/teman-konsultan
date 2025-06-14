@extends('backend.layouts.app')

@section('title', __('Create Service'))

@section('content')
        <x-backend.card>

            <x-slot name="header">
                @lang('Create Service')
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.services.index')" :text="__('Cancel')" />
            </x-slot>


            <x-slot name="body">
                <livewire:backend.services.services-create />
            </x-slot>
        </x-backend.card>
@endsection
