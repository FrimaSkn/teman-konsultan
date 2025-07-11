@extends('backend.layouts.app')

@section('title', __('Create Article'))

@section('content')
        <x-backend.card>

            <x-slot name="header">
                @lang('Create Article')
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.post.index')" :text="__('Cancel')" />
            </x-slot>


            <x-slot name="body">
                {{--  --}}
            </x-slot>
        </x-backend.card>
@endsection
