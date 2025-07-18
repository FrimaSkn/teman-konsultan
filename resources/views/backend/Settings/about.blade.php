@extends('backend.layouts.app')

@section('title', __('About us Settings'))

@section('content')
        <x-backend.card>

            <x-slot name="header">
                @lang('About us Settings')
            </x-slot>

            <x-slot name="body">
                <livewire:backend.pages.manage-about />
            </x-slot>
        </x-backend.card>
@endsection
