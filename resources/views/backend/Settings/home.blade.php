@extends('backend.layouts.app')

@section('title', __('Home Settings'))

@section('content')
        <x-backend.card>

            <x-slot name="header">
                @lang('Home Settings')
            </x-slot>

            <x-slot name="body">
                <livewire:backend.pages.manage-home />
            </x-slot>
        </x-backend.card>
@endsection
