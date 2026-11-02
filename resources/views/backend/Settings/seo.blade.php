@extends('backend.layouts.app')

@section('title', __('SEO Settings'))

@section('content')
        <x-backend.card>

            <x-slot name="header">
                @lang('SEO Settings')
            </x-slot>

            <x-slot name="body">
                <livewire:backend.pages.seo-settings />
            </x-slot>
        </x-backend.card>
@endsection
