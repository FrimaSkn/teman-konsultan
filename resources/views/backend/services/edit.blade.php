@extends('backend.layouts.app')

@section('title', __('Edit Service'))

@section('content')
        <x-backend.card>

            <x-slot name="header">
                @lang('Edit Service')
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.services.index')" :text="__('Cancel')" />
            </x-slot>


            <x-slot name="body">
                <livewire:backend.services.services-edit :record="$service"/>
            </x-slot>
        </x-backend.card>
@endsection
