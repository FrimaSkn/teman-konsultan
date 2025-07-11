@extends('backend.layouts.app')

@section('title', __('Article'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Articles')
        </x-slot>

        <x-slot name="headerActions">
            <x-utils.link
                icon="c-icon cil-plus"
                class="card-header-action"
                :href="route('admin.post.create')"
                :text="__('Create Article')"
            />
        </x-slot>

        <x-slot name="body">
            <livewire:backend.post.post-table />
        </x-slot>
    </x-backend.card>



@endsection
