@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            filament form
        </x-slot>

        <x-slot name="body">
            <livewire:filament-form />
        </x-slot>
    </x-backend.card>
@endsection
