@extends('backend.layouts.app')

@section('title', __('General Settings'))

@section('content')
        <x-backend.card>

            <x-slot name="header">
                @lang('General Settings')
            </x-slot>

            <x-slot name="body">
                <livewire:backend.pages.general-settings />
            </x-slot>
        </x-backend.card>
@endsection
